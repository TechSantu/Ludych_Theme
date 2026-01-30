<?php
/**
 * Checks that calls to methods and functions are spaced correctly.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class FunctionCallArgumentSpacingSniff implements Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array<int|string>
     */
    public function register()
    {
        return[
            T_STRING,
            T_ISSET,
            T_UNSET,
            T_SELF,
            T_STATIC,
            T_PARENT,
            T_VARIABLE,
            T_CLOSE_CURLY_BRACKET,
            T_CLOSE_PARENTHESIS,
        ];

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $functionName    = $stackPtr;
        $ignoreTokens    = Tokens::$emptyTokens;
        $ignoreTokens[]  = T_BITWISE_AND;
        $functionKeyword = $phpcsFile->findPrevious($ignoreTokens, ($stackPtr - 1), null, true);
        if ($tokens[$functionKeyword]['code'] === T_FUNCTION || $tokens[$functionKeyword]['code'] === T_CLASS) {
            return;
        }

        if ($tokens[$stackPtr]['code'] === T_CLOSE_CURLY_BRACKET
            && isset($tokens[$stackPtr]['scope_condition']) === true
        ) {
            return;
        }

        $openBracket = $phpcsFile->findNext(Tokens::$emptyTokens, ($functionName + 1), null, true);
        if ($tokens[$openBracket]['code'] !== T_OPEN_PARENTHESIS) {
            return;
        }

        if (isset($tokens[$openBracket]['parenthesis_closer']) === false) {
            return;
        }

        $this->checkSpacing($phpcsFile, $stackPtr, $openBracket);

    }//end process()


    /**
     * Checks the spacing around commas.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile   The file being scanned.
     * @param int                         $stackPtr    The position of the current token in the
     *                                                 stack passed in $tokens.
     * @param int                         $openBracket The position of the opening bracket
     *                                                 in the stack passed in $tokens.
     *
     * @return void
     */
    public function checkSpacing(File $phpcsFile, $stackPtr, $openBracket)
    {
        $tokens = $phpcsFile->getTokens();

        $closeBracket  = $tokens[$openBracket]['parenthesis_closer'];
        $nextSeparator = $openBracket;

        $find = [
            T_COMMA,
            T_CLOSURE,
            T_FN,
            T_ANON_CLASS,
            T_OPEN_SHORT_ARRAY,
            T_MATCH,
        ];

        while (($nextSeparator = $phpcsFile->findNext($find, ($nextSeparator + 1), $closeBracket)) !== false) {
            if ($tokens[$nextSeparator]['code'] === T_CLOSURE
                || $tokens[$nextSeparator]['code'] === T_ANON_CLASS
                || $tokens[$nextSeparator]['code'] === T_MATCH
            ) {
                $nextSeparator = $tokens[$nextSeparator]['scope_closer'];
                continue;
            } else if ($tokens[$nextSeparator]['code'] === T_FN) {
                $nextSeparator = ($tokens[$nextSeparator]['scope_closer'] - 1);
                continue;
            } else if ($tokens[$nextSeparator]['code'] === T_OPEN_SHORT_ARRAY) {
                $nextSeparator = $tokens[$nextSeparator]['bracket_closer'];
                continue;
            }

            $brackets    = $tokens[$nextSeparator]['nested_parenthesis'];
            $lastBracket = array_pop($brackets);
            if ($lastBracket !== $closeBracket) {
                continue;
            }

            if ($tokens[$nextSeparator]['code'] === T_COMMA) {
                if ($tokens[($nextSeparator - 1)]['code'] === T_WHITESPACE) {
                    $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($nextSeparator - 2), null, true);
                    if (isset(Tokens::$heredocTokens[$tokens[$prev]['code']]) === false) {
                        $error = 'Space found before comma in argument list';
                        $fix   = $phpcsFile->addFixableError($error, $nextSeparator, 'SpaceBeforeComma');
                        if ($fix === true) {
                            $phpcsFile->fixer->beginChangeset();

                            if ($tokens[$prev]['line'] !== $tokens[$nextSeparator]['line']) {
                                $phpcsFile->fixer->addContent($prev, ',');
                                $phpcsFile->fixer->replaceToken($nextSeparator, '');
                            } else {
                                $phpcsFile->fixer->replaceToken(($nextSeparator - 1), '');
                            }

                            $phpcsFile->fixer->endChangeset();
                        }
                    }//end if
                }//end if

                if ($tokens[($nextSeparator + 1)]['code'] !== T_WHITESPACE) {
                    if (($nextSeparator + 1) !== $closeBracket) {
                        $error = 'No space found after comma in argument list';
                        $fix   = $phpcsFile->addFixableError($error, $nextSeparator, 'NoSpaceAfterComma');
                        if ($fix === true) {
                            $phpcsFile->fixer->addContent($nextSeparator, ' ');
                        }
                    }
                } else {
                    $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($nextSeparator + 1), null, true);
                    if ($tokens[$next]['line'] === $tokens[$nextSeparator]['line']) {
                        $space = $tokens[($nextSeparator + 1)]['length'];
                        if ($space > 1) {
                            $error = 'Expected 1 space after comma in argument list; %s found';
                            $data  = [$space];
                            $fix   = $phpcsFile->addFixableError($error, $nextSeparator, 'TooMuchSpaceAfterComma', $data);
                            if ($fix === true) {
                                $phpcsFile->fixer->replaceToken(($nextSeparator + 1), ' ');
                            }
                        }
                    }
                }//end if
            }//end if
        }//end while

    }//end checkSpacing()


}//end class
