<?php
/**
 * A Sniff to enforce the use of IDENTICAL type operators rather than EQUAL operators.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Operators;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class ComparisonOperatorUsageSniff implements Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = [
        'PHP',
        'JS',
    ];

    /**
     * A list of valid comparison operators.
     *
     * @var array
     */
    private static $validOps = [
        T_IS_IDENTICAL        => true,
        T_IS_NOT_IDENTICAL    => true,
        T_LESS_THAN           => true,
        T_GREATER_THAN        => true,
        T_IS_GREATER_OR_EQUAL => true,
        T_IS_SMALLER_OR_EQUAL => true,
        T_INSTANCEOF          => true,
    ];

    /**
     * A list of invalid operators with their alternatives.
     *
     * @var array<string, array<int|string, string>>
     */
    private static $invalidOps = [
        'PHP' => [
            T_IS_EQUAL     => '===',
            T_IS_NOT_EQUAL => '!==',
            T_BOOLEAN_NOT  => '=== FALSE',
        ],
        'JS'  => [
            T_IS_EQUAL     => '===',
            T_IS_NOT_EQUAL => '!==',
        ],
    ];


    /**
     * Registers the token types that this sniff wishes to listen to.
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [
            T_IF,
            T_ELSEIF,
            T_INLINE_THEN,
            T_WHILE,
            T_FOR,
        ];

    }//end register()


    /**
     * Process the tokens that this sniff is listening for.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where the token was found.
     * @param int                         $stackPtr  The position in the stack where the token
     *                                               was found.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens    = $phpcsFile->getTokens();
        $tokenizer = $phpcsFile->tokenizerType;

        if ($tokens[$stackPtr]['code'] === T_INLINE_THEN) {
            $end = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
            if ($tokens[$end]['code'] !== T_CLOSE_PARENTHESIS) {
                for ($i = ($end - 1); $i >= 0; $i--) {
                    if ($tokens[$i]['code'] === T_SEMICOLON) {
                        break;
                    } else if ($tokens[$i]['code'] === T_OPEN_TAG) {
                        break;
                    } else if ($tokens[$i]['code'] === T_CLOSE_CURLY_BRACKET) {
                        if (isset($tokens[$i]['scope_opener']) === true) {
                            break;
                        }
                    } else if ($tokens[$i]['code'] === T_OPEN_CURLY_BRACKET) {
                        if (isset($tokens[$i]['scope_closer']) === true) {
                            break;
                        }
                    } else if ($tokens[$i]['code'] === T_OPEN_PARENTHESIS) {
                        if (isset($tokens[$i]['parenthesis_closer']) === true
                            && $tokens[$i]['parenthesis_closer'] >= $stackPtr
                        ) {
                            break;
                        }
                    }//end if
                }//end for

                $start = $phpcsFile->findNext(Tokens::$emptyTokens, ($i + 1), null, true);
            } else {
                if (isset($tokens[$end]['parenthesis_opener']) === false) {
                    return;
                }

                $start = $tokens[$end]['parenthesis_opener'];
            }//end if
        } else if ($tokens[$stackPtr]['code'] === T_FOR) {
            if (isset($tokens[$stackPtr]['parenthesis_opener']) === false) {
                return;
            }

            $openingBracket = $tokens[$stackPtr]['parenthesis_opener'];
            $closingBracket = $tokens[$stackPtr]['parenthesis_closer'];

            $start = $phpcsFile->findNext(T_SEMICOLON, $openingBracket, $closingBracket);
            $end   = $phpcsFile->findNext(T_SEMICOLON, ($start + 1), $closingBracket);
            if ($start === false || $end === false) {
                return;
            }
        } else {
            if (isset($tokens[$stackPtr]['parenthesis_opener']) === false) {
                return;
            }

            $start = $tokens[$stackPtr]['parenthesis_opener'];
            $end   = $tokens[$stackPtr]['parenthesis_closer'];
        }//end if

        $requiredOps   = 0;
        $foundOps      = 0;
        $foundBooleans = 0;

        $lastNonEmpty = $start;

        for ($i = $start; $i <= $end; $i++) {
            $type = $tokens[$i]['code'];
            if (isset(self::$invalidOps[$tokenizer][$type]) === true) {
                $error = 'Operator %s prohibited; use %s instead';
                $data  = [
                    $tokens[$i]['content'],
                    self::$invalidOps[$tokenizer][$type],
                ];
                $phpcsFile->addError($error, $i, 'NotAllowed', $data);
                $foundOps++;
            } else if (isset(self::$validOps[$type]) === true) {
                $foundOps++;
            }

            if ($type === T_OPEN_PARENTHESIS
                && isset($tokens[$i]['parenthesis_closer']) === true
                && isset(Tokens::$functionNameTokens[$tokens[$lastNonEmpty]['code']]) === true
            ) {
                $i            = $tokens[$i]['parenthesis_closer'];
                $lastNonEmpty = $i;
                continue;
            }

            if ($tokens[$i]['code'] === T_TRUE || $tokens[$i]['code'] === T_FALSE) {
                $foundBooleans++;
            }

            if ($phpcsFile->tokenizerType !== 'JS'
                && ($tokens[$i]['code'] === T_BOOLEAN_AND
                || $tokens[$i]['code'] === T_BOOLEAN_OR)
            ) {
                $requiredOps++;

                if ($foundOps > $requiredOps) {
                    $foundOps = $requiredOps;
                }

                if ($requiredOps !== $foundOps) {
                    $error = 'Implicit true comparisons prohibited; use === TRUE instead';
                    $phpcsFile->addError($error, $stackPtr, 'ImplicitTrue');
                    $foundOps++;
                }
            }

            if (isset(Tokens::$emptyTokens[$type]) === false) {
                $lastNonEmpty = $i;
            }
        }//end for

        $requiredOps++;

        if ($phpcsFile->tokenizerType !== 'JS'
            && $foundOps < $requiredOps
            && ($requiredOps !== $foundBooleans)
        ) {
            $error = 'Implicit true comparisons prohibited; use === TRUE instead';
            $phpcsFile->addError($error, $stackPtr, 'ImplicitTrue');
        }

    }//end process()


}//end class
