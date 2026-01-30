<?php
/**
 * Ensures that constant names are all uppercase.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class UpperCaseConstantNameSniff implements Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [
            T_STRING,
            T_CONST,
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

        if ($tokens[$stackPtr]['code'] === T_CONST) {
            $assignmentOperator = $phpcsFile->findNext([T_EQUAL, T_SEMICOLON], ($stackPtr + 1));
            if ($assignmentOperator === false || $tokens[$assignmentOperator]['code'] !== T_EQUAL) {
                return;
            }

            $constant = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($assignmentOperator - 1), ($stackPtr + 1), true);
            if ($constant === false) {
                return;
            }

            $constName = $tokens[$constant]['content'];

            if (strtoupper($constName) !== $constName) {
                if (strtolower($constName) === $constName) {
                    $phpcsFile->recordMetric($constant, 'Constant name case', 'lower');
                } else {
                    $phpcsFile->recordMetric($constant, 'Constant name case', 'mixed');
                }

                $error = 'Class constants must be uppercase; expected %s but found %s';
                $data  = [
                    strtoupper($constName),
                    $constName,
                ];
                $phpcsFile->addError($error, $constant, 'ClassConstantNotUpperCase', $data);
            } else {
                $phpcsFile->recordMetric($constant, 'Constant name case', 'upper');
            }

            return;
        }//end if

        if (strtolower($tokens[$stackPtr]['content']) !== 'define') {
            return;
        }

        $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);
        if ($tokens[$prev]['code'] === T_OBJECT_OPERATOR
            || $tokens[$prev]['code'] === T_DOUBLE_COLON
            || $tokens[$prev]['code'] === T_NULLSAFE_OBJECT_OPERATOR
            || $tokens[$prev]['code'] === T_NEW
        ) {
            return;
        }

        if (empty($tokens[$stackPtr]['nested_attributes']) === false) {
            return;
        }

        $openBracket = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if ($openBracket === false || $tokens[$openBracket]['code'] !== T_OPEN_PARENTHESIS) {
            return;
        }

        $constPtr = $phpcsFile->findNext(Tokens::$emptyTokens, ($openBracket + 1), null, true);
        if ($constPtr === false || $tokens[$constPtr]['code'] !== T_CONSTANT_ENCAPSED_STRING) {
            return;
        }

        $constName = $tokens[$constPtr]['content'];
        $prefix    = '';

        $splitPos = strrpos($constName, '\\');
        if ($splitPos !== false) {
            $prefix    = substr($constName, 0, ($splitPos + 1));
            $constName = substr($constName, ($splitPos + 1));
        }

        if (strtoupper($constName) !== $constName) {
            if (strtolower($constName) === $constName) {
                $phpcsFile->recordMetric($constPtr, 'Constant name case', 'lower');
            } else {
                $phpcsFile->recordMetric($constPtr, 'Constant name case', 'mixed');
            }

            $error = 'Constants must be uppercase; expected %s but found %s';
            $data  = [
                $prefix.strtoupper($constName),
                $prefix.$constName,
            ];
            $phpcsFile->addError($error, $constPtr, 'ConstantNotUpperCase', $data);
        } else {
            $phpcsFile->recordMetric($constPtr, 'Constant name case', 'upper');
        }

    }//end process()


}//end class
