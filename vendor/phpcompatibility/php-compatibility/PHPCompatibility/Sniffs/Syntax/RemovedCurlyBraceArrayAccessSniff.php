<?php
/**
 * PHPCompatibility, an external standard for PHP_CodeSniffer.
 *
 * @package   PHPCompatibility
 * @copyright 2012-2019 PHPCompatibility Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCompatibility/PHPCompatibility
 */

namespace PHPCompatibility\Sniffs\Syntax;

use PHPCompatibility\Sniff;
use PHPCompatibility\Sniffs\Syntax\NewArrayStringDereferencingSniff;
use PHPCompatibility\Sniffs\Syntax\NewClassMemberAccessSniff;
use PHPCompatibility\Sniffs\Syntax\NewFunctionArrayDereferencingSniff;
use PHP_CodeSniffer_File as File;
use PHP_CodeSniffer_Tokens as Tokens;

/**
 * Using the curly brace syntax to access array or string offsets has been deprecated in PHP 7.4.
 *
 * PHP version 7.4
 *
 * @link https://www.php.net/manual/en/migration74.deprecated.php#migration74.deprecated.core.array-string-access-curly-brace
 * @link https://wiki.php.net/rfc/deprecate_curly_braces_array_access
 *
 * @since 9.3.0
 */
class RemovedCurlyBraceArrayAccessSniff extends Sniff
{

    /**
     * Instance of the NewArrayStringDereferencing sniff.
     *
     * @since 9.3.0
     *
     * @var \PHPCompatibility\Sniffs\Syntax\NewArrayStringDereferencingSniff
     */
    private $newArrayStringDereferencing;

    /**
     * Target tokens as register by the NewArrayStringDereferencing sniff.
     *
     * @since 9.3.0
     *
     * @var array
     */
    private $newArrayStringDereferencingTargets;

    /**
     * Instance of the NewClassMemberAccess sniff.
     *
     * @since 9.3.0
     *
     * @var \PHPCompatibility\Sniffs\Syntax\NewClassMemberAccessSniff
     */
    private $newClassMemberAccess;

    /**
     * Target tokens as register by the NewClassMemberAccess sniff.
     *
     * @since 9.3.0
     *
     * @var array
     */
    private $newClassMemberAccessTargets;

    /**
     * Instance of the NewFunctionArrayDereferencing sniff.
     *
     * @since 9.3.0
     *
     * @var \PHPCompatibility\Sniffs\Syntax\NewFunctionArrayDereferencingSniff
     */
    private $newFunctionArrayDereferencing;

    /**
     * Target tokens as register by the NewFunctionArrayDereferencing sniff.
     *
     * @since 9.3.0
     *
     * @var array
     */
    private $newFunctionArrayDereferencingTargets;


    /**
     * Constructor.
     *
     * @since 9.3.0
     */
    public function __construct()
    {
        $this->newArrayStringDereferencing   = new NewArrayStringDereferencingSniff();
        $this->newClassMemberAccess          = new NewClassMemberAccessSniff();
        $this->newFunctionArrayDereferencing = new NewFunctionArrayDereferencingSniff();
    }


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 9.3.0
     *
     * @return array
     */
    public function register()
    {
        $targets = array(
            array(
                \T_VARIABLE,
                \T_STRING, // Constants.
            ),
        );

        $additionalTargets                        = $this->newArrayStringDereferencing->register();
        $this->newArrayStringDereferencingTargets = array_flip($additionalTargets);
        $targets[] = $additionalTargets;

        $additionalTargets                 = $this->newClassMemberAccess->register();
        $this->newClassMemberAccessTargets = array_flip($additionalTargets);
        $targets[]                         = $additionalTargets;

        $additionalTargets = $this->newFunctionArrayDereferencing->register();
        $this->newFunctionArrayDereferencingTargets = array_flip($additionalTargets);
        $targets[] = $additionalTargets;

        return call_user_func_array('array_merge', $targets);
    }


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 9.3.0
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        if ($this->supportsAbove('7.4') === false) {
            return;
        }

        $tokens = $phpcsFile->getTokens();
        $braces = array();

        if ($tokens[$stackPtr]['code'] === \T_VARIABLE) {
            $braces = $this->isVariableArrayAccess($phpcsFile, $stackPtr);
        }

        if (isset($this->newArrayStringDereferencingTargets[$tokens[$stackPtr]['code']])) {
            $dereferencing = $this->newArrayStringDereferencing->isArrayStringDereferencing($phpcsFile, $stackPtr);
            if (isset($dereferencing['braces'])) {
                $braces = $dereferencing['braces'];
            }
        }

        if (isset($this->newClassMemberAccessTargets[$tokens[$stackPtr]['code']])) {
            $braces = $this->newClassMemberAccess->isClassMemberAccess($phpcsFile, $stackPtr);
        }

        if (isset($this->newFunctionArrayDereferencingTargets[$tokens[$stackPtr]['code']])) {
            $braces = $this->newFunctionArrayDereferencing->isFunctionArrayDereferencing($phpcsFile, $stackPtr);
        }

        if (empty($braces) && $tokens[$stackPtr]['code'] === \T_STRING) {
            $braces = $this->isConstantArrayAccess($phpcsFile, $stackPtr);
        }

        if (empty($braces)) {
            return;
        }

        foreach ($braces as $open => $close) {
            if ($tokens[$open]['code'] !== \T_OPEN_CURLY_BRACKET) {
                continue;
            }

            $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($open + 1), $close, true);
            if ($nextNonEmpty === false) {
                continue;
            }

            $snippet = $phpcsFile->getTokensAsString($stackPtr, (($close - $stackPtr) + 1));
            $fix     = $phpcsFile->addFixableWarning(
                'Curly brace syntax for accessing array elements and string offsets has been deprecated in PHP 7.4. Found: %s',
                $open,
                'Found',
                array($snippet)
            );

            if ($fix === true) {
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->replaceToken($open, '[');
                $phpcsFile->fixer->replaceToken($close, ']');
                $phpcsFile->fixer->endChangeset();
            }
        }
    }


    /**
     * Determine whether a variable is being dereferenced using curly brace syntax.
     *
     * @since 9.3.0
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return array An array with the stack pointers to the open/close braces of
     *               the curly brace array access, or an empty array if no curly
     *               brace array access was detected.
     */
    protected function isVariableArrayAccess(File $phpcsFile, $stackPtr)
    {
        $tokens  = $phpcsFile->getTokens();
        $current = $stackPtr;
        $braces  = array();

        do {
            $current = $phpcsFile->findNext(Tokens::$emptyTokens, ($current + 1), null, true);
            if ($current === false) {
                break;
            }

            if ($tokens[$current]['code'] === \T_OPEN_SQUARE_BRACKET
                && isset($tokens[$current]['bracket_closer']) === true
                && $current === $tokens[$current]['bracket_opener']
            ) {
                $current = $tokens[$current]['bracket_closer'];
                continue;
            }

            if ($tokens[$current]['code'] === \T_OBJECT_OPERATOR) {
                $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($current + 1), null, true);
                if ($nextNonEmpty === false || $tokens[$nextNonEmpty]['code'] !== \T_STRING) {
                    break;
                }

                $current = $nextNonEmpty;
                continue;
            }

            if ($tokens[$current]['code'] === \T_OPEN_CURLY_BRACKET) {
                if (isset($tokens[$current]['bracket_closer']) === false) {
                    break;
                }

                $braces[$current] = $tokens[$current]['bracket_closer'];

                $current = $tokens[$current]['bracket_closer'];
                continue;
            }

            break;

        } while (true);

        return $braces;
    }


    /**
     * Determine whether a T_STRING is a constant being dereferenced using curly brace syntax.
     *
     * {@internal Note: the first braces for array access to a constant, for some unknown reason,
     *            can never be curlies, but have to be square brackets.
     *            Subsequent braces can be curlies.}
     *
     * @since 9.3.0
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return array An array with the stack pointers to the open/close braces of
     *               the curly brace array access, or an empty array if no curly
     *               brace array access was detected.
     */
    protected function isConstantArrayAccess(File $phpcsFile, $stackPtr)
    {
        $tokens       = $phpcsFile->getTokens();
        $prevNonEmpty = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($stackPtr - 1), null, true);

        if ($this->isUseOfGlobalConstant($phpcsFile, $stackPtr) === false
            && $tokens[$prevNonEmpty]['code'] !== \T_DOUBLE_COLON // Class constant access.
        ) {
            return array();
        }

        $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if ($nextNonEmpty === false) {
            return array();
        }

        if ($tokens[$nextNonEmpty]['code'] !== \T_OPEN_SQUARE_BRACKET
            || isset($tokens[$nextNonEmpty]['bracket_closer']) === false
        ) {
            return array();
        }

        $current = $tokens[$nextNonEmpty]['bracket_closer'];
        $braces  = array();

        do {
            $current = $phpcsFile->findNext(Tokens::$emptyTokens, ($current + 1), null, true);
            if ($current === false) {
                break;
            }

            if ($tokens[$current]['code'] === \T_OPEN_SQUARE_BRACKET
                && isset($tokens[$current]['bracket_closer']) === true
                && $current === $tokens[$current]['bracket_opener']
            ) {
                $current = $tokens[$current]['bracket_closer'];
                continue;
            }

            if ($tokens[$current]['code'] === \T_OPEN_CURLY_BRACKET) {
                if (isset($tokens[$current]['bracket_closer']) === false) {
                    break;
                }

                $braces[$current] = $tokens[$current]['bracket_closer'];

                $current = $tokens[$current]['bracket_closer'];
                continue;
            }

            break;

        } while (true);

        return $braces;
    }
}
