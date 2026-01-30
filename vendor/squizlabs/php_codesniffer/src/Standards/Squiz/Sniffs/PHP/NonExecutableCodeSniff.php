<?php
/**
 * Warns about code that can never been executed.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class NonExecutableCodeSniff implements Sniff
{

    /**
     * Tokens for terminating expressions, which can be used inline.
     *
     * This is in contrast to terminating statements, which cannot be used inline
     * and would result in a parse error (which is not the concern of this sniff).
     *
     * `throw` can be used as an expression since PHP 8.0.
     * {@link https://wiki.php.net/rfc/throw_expression}
     *
     * @var array
     */
    private $expressionTokens = [
        T_EXIT  => T_EXIT,
        T_THROW => T_THROW,
    ];


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [
            T_BREAK,
            T_CONTINUE,
            T_RETURN,
            T_THROW,
            T_EXIT,
            T_GOTO,
        ];

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);

        if ($tokens[$stackPtr]['code'] === T_EXIT && $tokens[$prev]['code'] === T_NS_SEPARATOR) {
            $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($prev - 1), null, true);
        }

        if (isset($this->expressionTokens[$tokens[$stackPtr]['code']]) === true) {
            if (isset(Tokens::$booleanOperators[$tokens[$prev]['code']]) === true
                && ($tokens[$stackPtr]['code'] === T_THROW && $tokens[$prev]['code'] === T_LOGICAL_XOR) === false
            ) {
                return;
            }

            if ($tokens[$prev]['code'] === T_INLINE_THEN || $tokens[$prev]['code'] === T_INLINE_ELSE) {
                return;
            }

            if ($tokens[$prev]['code'] === T_COALESCE || $tokens[$prev]['code'] === T_COALESCE_EQUAL) {
                return;
            }

            if ($tokens[$prev]['code'] === T_FN_ARROW) {
                return;
            }
        }//end if

        if ($tokens[$prev]['code'] === T_ELSE
            || (isset($tokens[$prev]['parenthesis_owner']) === true
            && ($tokens[$tokens[$prev]['parenthesis_owner']]['code'] === T_IF
            || $tokens[$tokens[$prev]['parenthesis_owner']]['code'] === T_ELSEIF))
        ) {
            return;
        }

        if ($tokens[$stackPtr]['code'] === T_RETURN) {
            $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
            if ($tokens[$next]['code'] === T_SEMICOLON) {
                $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);
                if ($tokens[$next]['code'] === T_CLOSE_CURLY_BRACKET) {
                    $owner = $tokens[$next]['scope_condition'];
                    if ($tokens[$owner]['code'] === T_FUNCTION
                        || $tokens[$owner]['code'] === T_CLOSURE
                    ) {
                        $warning = 'Empty return statement not required here';
                        $phpcsFile->addWarning($warning, $stackPtr, 'ReturnNotRequired');
                        return;
                    }
                }
            }
        }

        if (isset($tokens[$stackPtr]['scope_opener']) === true) {
            $owner = $tokens[$stackPtr]['scope_condition'];
            if ($tokens[$owner]['code'] === T_CASE || $tokens[$owner]['code'] === T_DEFAULT) {
                $end  = $phpcsFile->findEndOfStatement($stackPtr);
                $next = $phpcsFile->findNext(
                    [
                        T_CASE,
                        T_DEFAULT,
                        T_CLOSE_CURLY_BRACKET,
                        T_ENDSWITCH,
                    ],
                    ($end + 1)
                );

                if ($next !== false) {
                    $lastLine = $tokens[$end]['line'];
                    for ($i = ($stackPtr + 1); $i < $next; $i++) {
                        if (isset(Tokens::$emptyTokens[$tokens[$i]['code']]) === true) {
                            continue;
                        }

                        $line = $tokens[$i]['line'];
                        if ($line > $lastLine) {
                            $type    = substr($tokens[$stackPtr]['type'], 2);
                            $warning = 'Code after the %s statement on line %s cannot be executed';
                            $data    = [
                                $type,
                                $tokens[$stackPtr]['line'],
                            ];
                            $phpcsFile->addWarning($warning, $i, 'Unreachable', $data);
                            $lastLine = $line;
                        }
                    }
                }//end if

                return;
            }//end if
        }//end if

        $ourConditions = array_keys($tokens[$stackPtr]['conditions']);

        if (empty($ourConditions) === false) {
            $condition = array_pop($ourConditions);

            if (isset($tokens[$condition]['scope_closer']) === false) {
                return;
            }

            if ($tokens[$condition]['code'] === T_SWITCH
                && $tokens[$stackPtr]['code'] === T_BREAK
            ) {
                return;
            }

            $closer = $tokens[$condition]['scope_closer'];

            $nextOpener = null;
            for ($i = ($stackPtr + 1); $i < $closer; $i++) {
                if (isset($tokens[$i]['scope_closer']) === true) {
                    if ($tokens[$i]['scope_closer'] === $closer) {
                        $nextOpener = $i;
                        break;
                    }
                }
            }//end for

            if ($nextOpener === null) {
                $end = $closer;
            } else {
                $end = ($nextOpener - 1);
            }
        } else {
            if ($tokens[$stackPtr]['code'] === T_BREAK) {
                return;
            }

            $end = ($phpcsFile->numTokens - 1);
        }//end if

        for ($start = ($stackPtr + 1); $start < $phpcsFile->numTokens; $start++) {
            if ($start === $end) {
                break;
            }

            if (isset($tokens[$start]['parenthesis_closer']) === true
                && $tokens[$start]['code'] === T_OPEN_PARENTHESIS
            ) {
                $start = $tokens[$start]['parenthesis_closer'];
                continue;
            }

            if (isset($tokens[$start]['bracket_closer']) === true
                && $tokens[$start]['code'] === T_OPEN_CURLY_BRACKET
            ) {
                $start = $tokens[$start]['bracket_closer'];
                continue;
            }

            if ($tokens[$start]['code'] === T_SEMICOLON || $tokens[$start]['code'] === T_CLOSE_TAG) {
                break;
            }
        }//end for

        if (isset($tokens[$start]) === false) {
            return;
        }

        $lastLine = $tokens[$start]['line'];
        for ($i = ($start + 1); $i < $end; $i++) {
            if (isset(Tokens::$emptyTokens[$tokens[$i]['code']]) === true
                || isset(Tokens::$bracketTokens[$tokens[$i]['code']]) === true
                || $tokens[$i]['code'] === T_SEMICOLON
            ) {
                continue;
            }

            if (isset(Tokens::$ooScopeTokens[$tokens[$i]['code']]) === true
                || $tokens[$i]['code'] === T_FUNCTION
                || $tokens[$i]['code'] === T_CLOSURE
            ) {
                if (isset($tokens[$i]['scope_closer']) === false) {
                    return;
                }

                $i = $tokens[$i]['scope_closer'];
                continue;
            }

            if ($tokens[$i]['code'] === T_INLINE_HTML && trim($tokens[$i]['content']) === '') {
                continue;
            }

            if ($tokens[$i]['code'] === T_OPEN_TAG) {
                continue;
            }

            $line = $tokens[$i]['line'];
            if ($line > $lastLine) {
                $type    = substr($tokens[$stackPtr]['type'], 2);
                $warning = 'Code after the %s statement on line %s cannot be executed';
                $data    = [
                    $type,
                    $tokens[$stackPtr]['line'],
                ];
                $phpcsFile->addWarning($warning, $i, 'Unreachable', $data);
                $lastLine = $line;
            }
        }//end for

    }//end process()


}//end class
