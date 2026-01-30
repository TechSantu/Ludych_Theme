<?php
/**
 * Processes pattern strings and checks that the code conforms to the pattern.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Sniffs;

use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Tokenizers\PHP;
use PHP_CodeSniffer\Util\Tokens;

abstract class AbstractPatternSniff implements Sniff
{

    /**
     * If true, comments will be ignored if they are found in the code.
     *
     * @var boolean
     */
    public $ignoreComments = false;

    /**
     * The current file being checked.
     *
     * @var string
     */
    protected $currFile = '';

    /**
     * The parsed patterns array.
     *
     * @var array
     */
    private $parsedPatterns = [];

    /**
     * Tokens that this sniff wishes to process outside of the patterns.
     *
     * @var int[]
     * @see registerSupplementary()
     * @see processSupplementary()
     */
    private $supplementaryTokens = [];

    /**
     * Positions in the stack where errors have occurred.
     *
     * @var array<int, bool>
     */
    private $errorPos = [];


    /**
     * Constructs a AbstractPatternSniff.
     *
     * @param boolean $ignoreComments If true, comments will be ignored.
     */
    public function __construct($ignoreComments=null)
    {
        if ($ignoreComments !== null) {
            $this->ignoreComments = $ignoreComments;
        }

        $this->supplementaryTokens = $this->registerSupplementary();

    }//end __construct()


    /**
     * Registers the tokens to listen to.
     *
     * Classes extending <i>AbstractPatternTest</i> should implement the
     * <i>getPatterns()</i> method to register the patterns they wish to test.
     *
     * @return array<int|string>
     * @see    process()
     */
    final public function register()
    {
        $listenTypes = [];
        $patterns    = $this->getPatterns();

        foreach ($patterns as $pattern) {
            $parsedPattern = $this->parse($pattern);

            $pos           = $this->getListenerTokenPos($parsedPattern);
            $tokenType     = $parsedPattern[$pos]['token'];
            $listenTypes[] = $tokenType;

            $patternArray = [
                'listen_pos'   => $pos,
                'pattern'      => $parsedPattern,
                'pattern_code' => $pattern,
            ];

            if (isset($this->parsedPatterns[$tokenType]) === false) {
                $this->parsedPatterns[$tokenType] = [];
            }

            $this->parsedPatterns[$tokenType][] = $patternArray;
        }//end foreach

        return array_unique(array_merge($listenTypes, $this->supplementaryTokens));

    }//end register()


    /**
     * Returns the token types that the specified pattern is checking for.
     *
     * Returned array is in the format:
     * <code>
     *   array(
     *      T_WHITESPACE => 0, // 0 is the position where the T_WHITESPACE token
     *                         // should occur in the pattern.
     *   );
     * </code>
     *
     * @param array $pattern The parsed pattern to find the acquire the token
     *                       types from.
     *
     * @return array<int, int>
     */
    private function getPatternTokenTypes($pattern)
    {
        $tokenTypes = [];
        foreach ($pattern as $pos => $patternInfo) {
            if ($patternInfo['type'] === 'token') {
                if (isset($tokenTypes[$patternInfo['token']]) === false) {
                    $tokenTypes[$patternInfo['token']] = $pos;
                }
            }
        }

        return $tokenTypes;

    }//end getPatternTokenTypes()


    /**
     * Returns the position in the pattern that this test should register as
     * a listener for the pattern.
     *
     * @param array $pattern The pattern to acquire the listener for.
     *
     * @return int The position in the pattern that this test should register
     *             as the listener.
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException If we could not determine a token to listen for.
     */
    private function getListenerTokenPos($pattern)
    {
        $tokenTypes = $this->getPatternTokenTypes($pattern);
        $tokenCodes = array_keys($tokenTypes);
        $token      = Tokens::getHighestWeightedToken($tokenCodes);

        if ($token === false) {
            $error = 'Could not determine a token to listen for';
            throw new RuntimeException($error);
        }

        return $tokenTypes[$token];

    }//end getListenerTokenPos()


    /**
     * Processes the test.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where the
     *                                               token occurred.
     * @param int                         $stackPtr  The position in the tokens stack
     *                                               where the listening token type
     *                                               was found.
     *
     * @return void
     * @see    register()
     */
    final public function process(File $phpcsFile, $stackPtr)
    {
        $file = $phpcsFile->getFilename();
        if ($this->currFile !== $file) {
            $this->errorPos = [];
            $this->currFile = $file;
        }

        $tokens = $phpcsFile->getTokens();

        if (in_array($tokens[$stackPtr]['code'], $this->supplementaryTokens, true) === true) {
            $this->processSupplementary($phpcsFile, $stackPtr);
        }

        $type = $tokens[$stackPtr]['code'];

        if (isset($this->parsedPatterns[$type]) === false) {
            return;
        }

        $allErrors = [];

        foreach ($this->parsedPatterns[$type] as $patternInfo) {
            $errors = $this->processPattern($patternInfo, $phpcsFile, $stackPtr);
            if ($errors === false) {
                continue;
            } else if (empty($errors) === true) {
                break;
            }

            foreach ($errors as $stackPtr => $error) {
                if (isset($this->errorPos[$stackPtr]) === false) {
                    $this->errorPos[$stackPtr] = true;
                    $allErrors[$stackPtr]      = $error;
                }
            }
        }

        foreach ($allErrors as $stackPtr => $error) {
            $phpcsFile->addError($error, $stackPtr, 'Found');
        }

    }//end process()


    /**
     * Processes the pattern and verifies the code at $stackPtr.
     *
     * @param array                       $patternInfo Information about the pattern used
     *                                                 for checking, which includes are
     *                                                 parsed token representation of the
     *                                                 pattern.
     * @param \PHP_CodeSniffer\Files\File $phpcsFile   The PHP_CodeSniffer file where the
     *                                                 token occurred.
     * @param int                         $stackPtr    The position in the tokens stack where
     *                                                 the listening token type was found.
     *
     * @return array|false
     */
    protected function processPattern($patternInfo, File $phpcsFile, $stackPtr)
    {
        $tokens      = $phpcsFile->getTokens();
        $pattern     = $patternInfo['pattern'];
        $patternCode = $patternInfo['pattern_code'];
        $errors      = [];
        $found       = '';

        $ignoreTokens = [T_WHITESPACE => T_WHITESPACE];
        if ($this->ignoreComments === true) {
            $ignoreTokens += Tokens::$commentTokens;
        }

        $origStackPtr = $stackPtr;
        $hasError     = false;

        if ($patternInfo['listen_pos'] > 0) {
            $stackPtr--;

            for ($i = ($patternInfo['listen_pos'] - 1); $i >= 0; $i--) {
                if ($pattern[$i]['type'] === 'token') {
                    if ($pattern[$i]['token'] === T_WHITESPACE) {
                        if ($tokens[$stackPtr]['code'] === T_WHITESPACE) {
                            $found = $tokens[$stackPtr]['content'].$found;
                        }

                        if ($i !== 0) {
                            if ($tokens[$stackPtr]['content'] !== $pattern[$i]['value']) {
                                $hasError = true;
                            }
                        }
                    } else {
                        $prev = $phpcsFile->findPrevious(
                            $ignoreTokens,
                            $stackPtr,
                            null,
                            true
                        );

                        if ($prev === false
                            || $tokens[$prev]['code'] !== $pattern[$i]['token']
                        ) {
                            return false;
                        }

                        $tokenContent = $phpcsFile->getTokensAsString(
                            ($prev + 1),
                            ($stackPtr - $prev - 1)
                        );

                        $found = $tokens[$prev]['content'].$tokenContent.$found;

                        if (isset($pattern[($i - 1)]) === true
                            && $pattern[($i - 1)]['type'] === 'skip'
                        ) {
                            $stackPtr = $prev;
                        } else {
                            $stackPtr = ($prev - 1);
                        }
                    }//end if
                } else if ($pattern[$i]['type'] === 'skip') {
                    if ($pattern[$i]['to'] === 'parenthesis_closer') {
                        $to = 'parenthesis_opener';
                    } else {
                        $to = 'scope_opener';
                    }

                    $next = $phpcsFile->findPrevious(
                        $ignoreTokens,
                        $stackPtr,
                        null,
                        true
                    );

                    if ($next === false || isset($tokens[$next][$to]) === false) {
                        return false;
                    }

                    if ($to === 'parenthesis_opener') {
                        $found = '{'.$found;
                    } else {
                        $found = '('.$found;
                    }

                    $found = '...'.$found;

                    $stackPtr = ($tokens[$next][$to] - 1);
                } else if ($pattern[$i]['type'] === 'string') {
                    $found = 'abc';
                } else if ($pattern[$i]['type'] === 'newline') {
                    if ($this->ignoreComments === true
                        && isset(Tokens::$commentTokens[$tokens[$stackPtr]['code']]) === true
                    ) {
                        $startComment = $phpcsFile->findPrevious(
                            Tokens::$commentTokens,
                            ($stackPtr - 1),
                            null,
                            true
                        );

                        if ($tokens[$startComment]['line'] !== $tokens[($startComment + 1)]['line']) {
                            $startComment++;
                        }

                        $tokenContent = $phpcsFile->getTokensAsString(
                            $startComment,
                            ($stackPtr - $startComment + 1)
                        );

                        $found    = $tokenContent.$found;
                        $stackPtr = ($startComment - 1);
                    }

                    if ($tokens[$stackPtr]['code'] === T_WHITESPACE) {
                        if ($tokens[$stackPtr]['content'] !== $phpcsFile->eolChar) {
                            $found = $tokens[$stackPtr]['content'].$found;

                            if (($tokens[($stackPtr - 1)]['content'] !== $phpcsFile->eolChar)
                                && ($this->ignoreComments === true
                                && isset(Tokens::$commentTokens[$tokens[($stackPtr - 1)]['code']]) === false)
                            ) {
                                $hasError = true;
                            } else {
                                $stackPtr--;
                            }
                        } else {
                            $found = 'EOL'.$found;
                        }
                    } else {
                        $found    = $tokens[$stackPtr]['content'].$found;
                        $hasError = true;
                    }//end if

                    if ($hasError === false && $pattern[($i - 1)]['type'] !== 'newline') {
                        $prev = $phpcsFile->findPrevious($ignoreTokens, ($stackPtr - 1), null, true);
                        if ($prev !== false && $tokens[$prev]['line'] !== $tokens[$stackPtr]['line']) {
                            $hasError = true;
                        }
                    }
                }//end if
            }//end for
        }//end if

        $stackPtr          = $origStackPtr;
        $lastAddedStackPtr = null;
        $patternLen        = count($pattern);

        if (($stackPtr + $patternLen - $patternInfo['listen_pos']) > $phpcsFile->numTokens) {
            return false;
        }

        for ($i = $patternInfo['listen_pos']; $i < $patternLen; $i++) {
            if (isset($tokens[$stackPtr]) === false) {
                break;
            }

            if ($pattern[$i]['type'] === 'token') {
                if ($pattern[$i]['token'] === T_WHITESPACE) {
                    if ($this->ignoreComments === true) {
                        if (isset(Tokens::$commentTokens[$tokens[$stackPtr]['code']]) === true) {
                            continue;
                        }

                        if (isset($tokens[($stackPtr + 1)]) === true
                            && isset(Tokens::$commentTokens[$tokens[($stackPtr + 1)]['code']]) === true
                        ) {
                            continue;
                        }
                    }

                    $tokenContent = '';
                    if ($tokens[$stackPtr]['code'] === T_WHITESPACE) {
                        if (isset($pattern[($i + 1)]) === false) {
                            $tokenContent = $tokens[$stackPtr]['content'];
                        } else {
                            $next = $phpcsFile->findNext(
                                Tokens::$emptyTokens,
                                $stackPtr,
                                null,
                                true
                            );

                            $tokenContent = $phpcsFile->getTokensAsString(
                                $stackPtr,
                                ($next - $stackPtr)
                            );

                            $lastAddedStackPtr = $stackPtr;
                            $stackPtr          = $next;
                        }//end if

                        if ($stackPtr !== $lastAddedStackPtr) {
                            $found .= $tokenContent;
                        }
                    } else {
                        if ($stackPtr !== $lastAddedStackPtr) {
                            $found            .= $tokens[$stackPtr]['content'];
                            $lastAddedStackPtr = $stackPtr;
                        }
                    }//end if

                    if (isset($pattern[($i + 1)]) === true
                        && $pattern[($i + 1)]['type'] === 'skip'
                    ) {
                        if (strpos($tokenContent, $pattern[$i]['value']) !== 0) {
                            $hasError = true;
                        }
                    } else {
                        if ($tokenContent !== $pattern[$i]['value']) {
                            $hasError = true;
                        }
                    }
                } else {
                    $next = $phpcsFile->findNext(
                        $ignoreTokens,
                        $stackPtr,
                        null,
                        true
                    );

                    if ($next === false
                        || $tokens[$next]['code'] !== $pattern[$i]['token']
                    ) {
                        return false;
                    }

                    if ($lastAddedStackPtr !== null) {
                        if (($tokens[$next]['code'] === T_OPEN_CURLY_BRACKET
                            || $tokens[$next]['code'] === T_CLOSE_CURLY_BRACKET)
                            && isset($tokens[$next]['scope_condition']) === true
                            && $tokens[$next]['scope_condition'] > $lastAddedStackPtr
                        ) {
                            return false;
                        }

                        if (($tokens[$next]['code'] === T_OPEN_PARENTHESIS
                            || $tokens[$next]['code'] === T_CLOSE_PARENTHESIS)
                            && isset($tokens[$next]['parenthesis_owner']) === true
                            && $tokens[$next]['parenthesis_owner'] > $lastAddedStackPtr
                        ) {
                            return false;
                        }
                    }//end if

                    if (($next - $stackPtr) > 0) {
                        $hasComment = false;
                        for ($j = $stackPtr; $j < $next; $j++) {
                            $found .= $tokens[$j]['content'];
                            if (isset(Tokens::$commentTokens[$tokens[$j]['code']]) === true) {
                                $hasComment = true;
                            }
                        }

                        if ($this->ignoreComments === false
                            || ($this->ignoreComments === true
                            && $hasComment === false)
                        ) {
                            $hasError = true;
                        }

                        if ($tokens[$next]['line'] !== $tokens[$stackPtr]['line']) {
                            $hasError = true;
                        }
                    }//end if

                    if ($next !== $lastAddedStackPtr) {
                        $found            .= $tokens[$next]['content'];
                        $lastAddedStackPtr = $next;
                    }

                    if (isset($pattern[($i + 1)]) === true
                        && $pattern[($i + 1)]['type'] === 'skip'
                    ) {
                        $stackPtr = $next;
                    } else {
                        $stackPtr = ($next + 1);
                    }
                }//end if
            } else if ($pattern[$i]['type'] === 'skip') {
                if ($pattern[$i]['to'] === 'unknown') {
                    $next = $phpcsFile->findNext(
                        $pattern[($i + 1)]['token'],
                        $stackPtr
                    );

                    if ($next === false) {
                        return false;
                    }

                    $found   .= '...';
                    $stackPtr = $next;
                } else {
                    $next = $phpcsFile->findPrevious(
                        Tokens::$blockOpeners,
                        $stackPtr
                    );

                    if ($next === false
                        || isset($tokens[$next][$pattern[$i]['to']]) === false
                    ) {
                        return false;
                    }

                    $found .= '...';
                    if ($pattern[$i]['to'] === 'parenthesis_closer') {
                        $found .= ')';
                    } else {
                        $found .= '}';
                    }

                    $stackPtr = ($tokens[$next][$pattern[$i]['to']] + 1);
                }//end if
            } else if ($pattern[$i]['type'] === 'string') {
                if ($tokens[$stackPtr]['code'] !== T_STRING) {
                    $hasError = true;
                }

                if ($stackPtr !== $lastAddedStackPtr) {
                    $found            .= 'abc';
                    $lastAddedStackPtr = $stackPtr;
                }

                $stackPtr++;
            } else if ($pattern[$i]['type'] === 'newline') {
                $newline = 0;
                for ($j = $stackPtr; $j < $phpcsFile->numTokens; $j++) {
                    if (strpos($tokens[$j]['content'], $phpcsFile->eolChar) !== false) {
                        $newline = $j;
                        break;
                    }
                }

                if ($newline === 0) {
                    $next     = ($phpcsFile->numTokens - 1);
                    $hasError = true;
                } else {
                    if ($this->ignoreComments === false) {
                        if (isset(Tokens::$commentTokens[$tokens[$newline]['code']]) === true) {
                            $hasError = true;
                        }
                    }

                    if ($newline === $stackPtr) {
                        $next = ($stackPtr + 1);
                    } else {
                        $next = $phpcsFile->findNext(
                            $ignoreTokens,
                            $stackPtr,
                            null,
                            true
                        );

                        if ($next < $newline) {
                            $hasError = true;
                        } else {
                            $next = ($newline + 1);
                        }
                    }
                }//end if

                if ($stackPtr !== $lastAddedStackPtr) {
                    $found .= $phpcsFile->getTokensAsString(
                        $stackPtr,
                        ($next - $stackPtr)
                    );

                    $lastAddedStackPtr = ($next - 1);
                }

                $stackPtr = $next;
            }//end if
        }//end for

        if ($hasError === true) {
            $error = $this->prepareError($found, $patternCode);
            $errors[$origStackPtr] = $error;
        }

        return $errors;

    }//end processPattern()


    /**
     * Prepares an error for the specified patternCode.
     *
     * @param string $found       The actual found string in the code.
     * @param string $patternCode The expected pattern code.
     *
     * @return string The error message.
     */
    protected function prepareError($found, $patternCode)
    {
        $found    = str_replace("\r\n", '\n', $found);
        $found    = str_replace("\n", '\n', $found);
        $found    = str_replace("\r", '\n', $found);
        $found    = str_replace("\t", '\t', $found);
        $found    = str_replace('EOL', '\n', $found);
        $expected = str_replace('EOL', '\n', $patternCode);

        $error = "Expected \"$expected\"; found \"$found\"";

        return $error;

    }//end prepareError()


    /**
     * Returns the patterns that should be checked.
     *
     * @return string[]
     */
    abstract protected function getPatterns();


    /**
     * Registers any supplementary tokens that this test might wish to process.
     *
     * A sniff may wish to register supplementary tests when it wishes to group
     * an arbitrary validation that cannot be performed using a pattern, with
     * other pattern tests.
     *
     * @return int[]
     * @see    processSupplementary()
     */
    protected function registerSupplementary()
    {
        return [];

    }//end registerSupplementary()


    /**
     * Processes any tokens registered with registerSupplementary().
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The PHP_CodeSniffer file where to
     *                                               process the skip.
     * @param int                         $stackPtr  The position in the tokens stack to
     *                                               process.
     *
     * @return void
     * @see    registerSupplementary()
     */
    protected function processSupplementary(File $phpcsFile, $stackPtr)
    {

    }//end processSupplementary()


    /**
     * Parses a pattern string into an array of pattern steps.
     *
     * @param string $pattern The pattern to parse.
     *
     * @return array The parsed pattern array.
     * @see    createSkipPattern()
     * @see    createTokenPattern()
     */
    private function parse($pattern)
    {
        $patterns   = [];
        $length     = strlen($pattern);
        $lastToken  = 0;
        $firstToken = 0;

        for ($i = 0; $i < $length; $i++) {
            $specialPattern = false;
            $isLastChar     = ($i === ($length - 1));
            $oldFirstToken  = $firstToken;

            if (substr($pattern, $i, 3) === '...') {
                $specialPattern = $this->createSkipPattern($pattern, ($i - 1));
                $lastToken      = ($i - $firstToken);
                $firstToken     = ($i + 3);
                $i += 2;

                if ($specialPattern['to'] !== 'unknown') {
                    $firstToken++;
                }
            } else if (substr($pattern, $i, 3) === 'abc') {
                $specialPattern = ['type' => 'string'];
                $lastToken      = ($i - $firstToken);
                $firstToken     = ($i + 3);
                $i += 2;
            } else if (substr($pattern, $i, 3) === 'EOL') {
                $specialPattern = ['type' => 'newline'];
                $lastToken      = ($i - $firstToken);
                $firstToken     = ($i + 3);
                $i += 2;
            }//end if

            if ($specialPattern !== false || $isLastChar === true) {
                if ($isLastChar === true) {
                    $str = substr($pattern, $oldFirstToken);
                } else {
                    if ($lastToken === 0) {
                        $str = '';
                    } else {
                        $str = substr($pattern, $oldFirstToken, $lastToken);
                    }
                }

                if ($str !== '') {
                    $tokenPatterns = $this->createTokenPattern($str);
                    foreach ($tokenPatterns as $tokenPattern) {
                        $patterns[] = $tokenPattern;
                    }
                }

                if ($isLastChar === false && $i === ($length - 1)) {
                    $i--;
                }
            }//end if

            if ($specialPattern !== false) {
                $patterns[] = $specialPattern;
            }
        }//end for

        return $patterns;

    }//end parse()


    /**
     * Creates a skip pattern.
     *
     * @param string $pattern The pattern being parsed.
     * @param int    $from    The token position that the skip pattern starts from.
     *
     * @return array The pattern step.
     * @see    createTokenPattern()
     * @see    parse()
     */
    private function createSkipPattern($pattern, $from)
    {
        $skip = ['type' => 'skip'];

        $nestedParenthesis = 0;
        $nestedBraces      = 0;
        for ($start = $from; $start >= 0; $start--) {
            switch ($pattern[$start]) {
            case '(':
                if ($nestedParenthesis === 0) {
                    $skip['to'] = 'parenthesis_closer';
                }

                $nestedParenthesis--;
                break;
            case '{':
                if ($nestedBraces === 0) {
                    $skip['to'] = 'scope_closer';
                }

                $nestedBraces--;
                break;
            case '}':
                $nestedBraces++;
                break;
            case ')':
                $nestedParenthesis++;
                break;
            }//end switch

            if (isset($skip['to']) === true) {
                break;
            }
        }//end for

        if (isset($skip['to']) === false) {
            $skip['to'] = 'unknown';
        }

        return $skip;

    }//end createSkipPattern()


    /**
     * Creates a token pattern.
     *
     * @param string $str The tokens string that the pattern should match.
     *
     * @return array The pattern step.
     * @see    createSkipPattern()
     * @see    parse()
     */
    private function createTokenPattern($str)
    {
        $tokenizer = new PHP('<?php '.$str.'?>', null);

        $tokens = $tokenizer->getTokens();
        $tokens = array_slice($tokens, 1, (count($tokens) - 2));

        $patterns = [];
        foreach ($tokens as $patternInfo) {
            $patterns[] = [
                'type'  => 'token',
                'token' => $patternInfo['code'],
                'value' => $patternInfo['content'],
            ];
        }

        return $patterns;

    }//end createTokenPattern()


}//end class
