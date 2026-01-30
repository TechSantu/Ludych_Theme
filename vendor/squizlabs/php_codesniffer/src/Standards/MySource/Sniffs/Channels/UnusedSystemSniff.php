<?php
/**
 * Ensures that systems and asset types are used if they are included.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 *
 * @deprecated 3.9.0
 */

namespace PHP_CodeSniffer\Standards\MySource\Sniffs\Channels;

use PHP_CodeSniffer\Sniffs\DeprecatedSniff;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class UnusedSystemSniff implements Sniff, DeprecatedSniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [T_DOUBLE_COLON];

    }//end register()


    /**
     * Processes this sniff, when one of its tokens is encountered.
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

        $methodName = strtolower($tokens[($stackPtr + 1)]['content']);
        if ($methodName === 'includesystem'
            || $methodName === 'includeasset'
            || $methodName === 'includewidget'
        ) {
            $systemName = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 3), null, true);
            if ($systemName === false || $tokens[$systemName]['code'] !== T_CONSTANT_ENCAPSED_STRING) {
                return;
            }

            $systemName = trim($tokens[$systemName]['content'], " '");
        } else {
            return;
        }

        if ($methodName === 'includeasset') {
            $systemName .= 'assettype';
        } else if ($methodName === 'includewidget') {
            $systemName .= 'widgettype';
        }

        $systemName = strtolower($systemName);

        $level = $tokens[$stackPtr]['level'];
        for ($i = ($stackPtr + 1); $i < $phpcsFile->numTokens; $i++) {
            if ($tokens[$i]['level'] < $level) {
                if ($tokens[$stackPtr]['level'] === $level) {
                    $conditions = array_keys($tokens[$stackPtr]['conditions']);
                    if (empty($conditions) === false) {
                        $cond = array_pop($conditions);
                        if ($tokens[$cond]['code'] === T_IF) {
                            $i = $tokens[$cond]['scope_closer'];
                            $level--;
                            continue;
                        }
                    }
                }

                break;
            }//end if

            if ($tokens[$i]['code'] !== T_DOUBLE_COLON
                && $tokens[$i]['code'] !== T_EXTENDS
                && $tokens[$i]['code'] !== T_IMPLEMENTS
            ) {
                continue;
            }

            switch ($tokens[$i]['code']) {
            case T_DOUBLE_COLON:
                $usedName = strtolower($tokens[($i - 1)]['content']);
                if ($usedName === $systemName) {
                    return;
                }
                break;
            case T_EXTENDS:
                $classNameToken = $phpcsFile->findNext(T_STRING, ($i + 1));
                $className      = strtolower($tokens[$classNameToken]['content']);
                if ($className === $systemName) {
                    return;
                }
                break;
            case T_IMPLEMENTS:
                $endImplements = $phpcsFile->findNext([T_EXTENDS, T_OPEN_CURLY_BRACKET], ($i + 1));
                for ($x = ($i + 1); $x < $endImplements; $x++) {
                    if ($tokens[$x]['code'] === T_STRING) {
                        $className = strtolower($tokens[$x]['content']);
                        if ($className === $systemName) {
                            return;
                        }
                    }
                }
                break;
            }//end switch
        }//end for

        $error = 'Included system "%s" is never used';
        $data  = [$systemName];
        $phpcsFile->addError($error, $stackPtr, 'Found', $data);

    }//end process()


    /**
     * Provide the version number in which the sniff was deprecated.
     *
     * @return string
     */
    public function getDeprecationVersion()
    {
        return 'v3.9.0';

    }//end getDeprecationVersion()


    /**
     * Provide the version number in which the sniff will be removed.
     *
     * @return string
     */
    public function getRemovalVersion()
    {
        return 'v4.0.0';

    }//end getRemovalVersion()


    /**
     * Provide a custom message to display with the deprecation.
     *
     * @return string
     */
    public function getDeprecationMessage()
    {
        return 'The MySource standard will be removed completely in v4.0.0.';

    }//end getDeprecationMessage()


}//end class
