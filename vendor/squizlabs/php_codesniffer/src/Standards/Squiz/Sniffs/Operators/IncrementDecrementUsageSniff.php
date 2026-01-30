<?php
/**
 * Ensures that the ++ operators are used when possible.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Operators;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class IncrementDecrementUsageSniff implements Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [
            T_EQUAL,
            T_PLUS_EQUAL,
            T_MINUS_EQUAL,
            T_INC,
            T_DEC,
        ];

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[$stackPtr]['code'] === T_INC || $tokens[$stackPtr]['code'] === T_DEC) {
            $this->processIncDec($phpcsFile, $stackPtr);
        } else {
            $this->processAssignment($phpcsFile, $stackPtr);
        }

    }//end process()


    /**
     * Checks to ensure increment and decrement operators are not confusing.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return void
     */
    protected function processIncDec($phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[($stackPtr - 1)]['code'] === T_VARIABLE
            || ($tokens[($stackPtr - 1)]['code'] === T_STRING
            && ($tokens[($stackPtr - 2)]['code'] === T_OBJECT_OPERATOR
            || $tokens[($stackPtr - 2)]['code'] === T_NULLSAFE_OBJECT_OPERATOR))
        ) {
            $start = ($stackPtr + 1);
        } else {
            $start = ($stackPtr + 2);
        }

        $next = $phpcsFile->findNext(Tokens::$emptyTokens, $start, null, true);
        if ($next === false) {
            return;
        }

        if (isset(Tokens::$arithmeticTokens[$tokens[$next]['code']]) === true) {
            $error = 'Increment and decrement operators cannot be used in an arithmetic operation';
            $phpcsFile->addError($error, $stackPtr, 'NotAllowed');
            return;
        }

        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($start - 3), null, true);
        if ($prev === false) {
            return;
        }

        if ($tokens[$next]['code'] === T_STRING_CONCAT || $tokens[$prev]['code'] === T_STRING_CONCAT) {
            $error = 'Increment and decrement operators must be bracketed when used in string concatenation';
            $phpcsFile->addError($error, $stackPtr, 'NoBrackets');
        }

    }//end processIncDec()


    /**
     * Checks to ensure increment and decrement operators are used.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return void
     */
    protected function processAssignment($phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $assignedVar = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        if ($tokens[$assignedVar]['code'] !== T_VARIABLE) {
            return;
        }

        $statementEnd = $phpcsFile->findNext([T_SEMICOLON, T_CLOSE_PARENTHESIS, T_CLOSE_SQUARE_BRACKET, T_CLOSE_CURLY_BRACKET], $stackPtr);

        $find   = Tokens::$emptyTokens;
        $find[] = T_LNUMBER;
        $find[] = T_VARIABLE;
        $find[] = T_PLUS;
        $find[] = T_MINUS;
        $find[] = T_OPEN_PARENTHESIS;

        $noiseTokens = $phpcsFile->findNext($find, ($stackPtr + 1), $statementEnd, true);
        if ($noiseTokens !== false) {
            return;
        }

        if ($tokens[$stackPtr]['code'] !== T_EQUAL) {
            $nextVar = $phpcsFile->findNext(T_VARIABLE, ($stackPtr + 1), $statementEnd);
            if ($nextVar !== false) {
                return;
            }
        }

        if ($tokens[$stackPtr]['code'] === T_EQUAL) {
            $nextVar          = $stackPtr;
            $previousVariable = $stackPtr;
            $variableCount    = 0;
            while (($nextVar = $phpcsFile->findNext(T_VARIABLE, ($nextVar + 1), $statementEnd)) !== false) {
                $previousVariable = $nextVar;
                $variableCount++;
            }

            if ($variableCount !== 1) {
                return;
            }

            $nextVar = $previousVariable;
            if ($tokens[$nextVar]['content'] !== $tokens[$assignedVar]['content']) {
                return;
            }
        }

        $nextNumber     = $stackPtr;
        $previousNumber = $stackPtr;
        $numberCount    = 0;
        while (($nextNumber = $phpcsFile->findNext([T_LNUMBER], ($nextNumber + 1), $statementEnd, false)) !== false) {
            $previousNumber = $nextNumber;
            $numberCount++;
        }

        if ($numberCount !== 1) {
            return;
        }

        $nextNumber = $previousNumber;
        if ($tokens[$nextNumber]['content'] === '1') {
            if ($tokens[$stackPtr]['code'] === T_EQUAL) {
                $opToken = $phpcsFile->findNext([T_PLUS, T_MINUS], ($nextVar + 1), $statementEnd);
                if ($opToken === false) {
                    return;
                }

                $operator = $tokens[$opToken]['content'];
            } else {
                $operator = substr($tokens[$stackPtr]['content'], 0, 1);
            }

            if ($tokens[$stackPtr]['code'] !== T_EQUAL) {
                $negative = $phpcsFile->findPrevious(T_MINUS, ($nextNumber - 1), $stackPtr);
                if ($negative !== false) {
                    if ($operator === '+') {
                        $operator = '-';
                    } else {
                        $operator = '+';
                    }
                }
            }

            $expected = $operator.$operator.$tokens[$assignedVar]['content'];
            $found    = $phpcsFile->getTokensAsString($assignedVar, ($statementEnd - $assignedVar + 1));

            if ($operator === '+') {
                $error = 'Increment';
            } else {
                $error = 'Decrement';
            }

            $error .= " operators should be used where possible; found \"$found\" but expected \"$expected\"";
            $phpcsFile->addError($error, $stackPtr, 'Found');
        }//end if

    }//end processAssignment()


}//end class
