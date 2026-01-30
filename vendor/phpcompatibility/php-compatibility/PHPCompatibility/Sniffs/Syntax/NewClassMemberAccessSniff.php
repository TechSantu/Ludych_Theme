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
use PHP_CodeSniffer_File as File;
use PHP_CodeSniffer_Tokens as Tokens;

/**
 * Detect class member access on object instantiation/cloning.
 *
 * PHP 5.4: Class member access on instantiation has been added, e.g. `(new Foo)->bar()`.
 * PHP 7.0: Class member access on cloning has been added, e.g. `(clone $foo)->bar()`.
 *
 * As of PHP 7.0, class member access on instantiation also works when using curly braces.
 * While unclear, this most likely has to do with the Uniform Variable Syntax changes.
 *
 * PHP version 5.4
 * PHP version 7.0
 *
 * @link https://www.php.net/manual/en/language.oop5.basic.php#example-177
 * @link https://www.php.net/manual/en/language.oop5.cloning.php#language.oop5.traits.properties.example
 * @link https://www.php.net/manual/en/migration54.new-features.php
 * @link https://wiki.php.net/rfc/instance-method-call
 * @link https://wiki.php.net/rfc/uniform_variable_syntax
 *
 * {@internal The reason for splitting the logic of this sniff into different methods is
 *            to allow re-use of the logic by the PHP 7.4 `RemovedCurlyBraceArrayAccess` sniff.}
 *
 * @since 8.2.0
 * @since 9.3.0 Now also detects class member access on instantiation using curly braces.
 */
class NewClassMemberAccessSniff extends Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 8.2.0
     *
     * @return array
     */
    public function register()
    {
        return array(
            \T_NEW,
            \T_CLONE,
        );
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 8.2.0
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in the
     *                                         stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        if ($this->supportsBelow('5.6') === false) {
            return;
        }

        $pointers = $this->isClassMemberAccess($phpcsFile, $stackPtr);
        if (empty($pointers)) {
            return;
        }

        $tokens     = $phpcsFile->getTokens();
        $supports53 = $this->supportsBelow('5.3');

        $error     = 'Class member access on object %s was not supported in PHP %s or earlier';
        $data      = array('instantiation', '5.3');
        $errorCode = 'OnNewFound';

        if ($tokens[$stackPtr]['code'] === \T_CLONE) {
            $data      = array('cloning', '5.6');
            $errorCode = 'OnCloneFound';
        }

        foreach ($pointers as $open => $close) {
            $itemData      = $data;
            $itemErrorCode = $errorCode;

            if ($tokens[$stackPtr]['code'] === \T_NEW
                && $tokens[$open]['code'] !== \T_OPEN_CURLY_BRACKET
            ) {
                if ($supports53 === true) {
                    $phpcsFile->addError($error, $open, $itemErrorCode, $itemData);
                }
                continue;
            }

            if ($tokens[$stackPtr]['code'] === \T_NEW
                && $tokens[$open]['code'] === \T_OPEN_CURLY_BRACKET
            ) {
                $itemData      = array('instantiation using curly braces', '5.6');
                $itemErrorCode = 'OnNewFoundUsingCurlies';
            }

            $phpcsFile->addError($error, $open, $itemErrorCode, $itemData);
        }
    }


    /**
     * Check if the class being instantiated/cloned is being dereferenced.
     *
     * @since 9.3.0 Logic split off from the process method.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                   $stackPtr  The position of the current token in
     *                                         the stack passed in $tokens.
     *
     * @return array Array containing the stack pointers to the object operator or
     *               the open/close braces involved in the class member access;
     *               or an empty array if no class member access was detected.
     */
    public function isClassMemberAccess(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (isset($tokens[$stackPtr]['nested_parenthesis']) === false) {
            return array();
        }

        $parenthesisCloser = end($tokens[$stackPtr]['nested_parenthesis']);
        $parenthesisOpener = key($tokens[$stackPtr]['nested_parenthesis']);

        if (isset($tokens[$parenthesisOpener]['parenthesis_owner']) === true) {
            return array();
        }

        $prevBeforeParenthesis = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($parenthesisOpener - 1), null, true);
        if ($prevBeforeParenthesis !== false && $tokens[$prevBeforeParenthesis]['code'] === \T_STRING) {
            return array();
        }

        $braces = array();
        $end    = $parenthesisCloser;

        do {
            $nextNonEmpty = $phpcsFile->findNext(Tokens::$emptyTokens, ($end + 1), null, true, null, true);
            if ($nextNonEmpty === false) {
                break;
            }

            if ($tokens[$nextNonEmpty]['code'] === \T_OBJECT_OPERATOR) {
                $braces[$nextNonEmpty] = true;
                break;
            }

            if ($tokens[$nextNonEmpty]['code'] === \T_OPEN_SQUARE_BRACKET
                || $tokens[$nextNonEmpty]['code'] === \T_OPEN_CURLY_BRACKET // PHP 7.0+.
            ) {
                if (isset($tokens[$nextNonEmpty]['bracket_closer']) === false) {
                    break;
                }

                $braces[$nextNonEmpty] = $tokens[$nextNonEmpty]['bracket_closer'];

                $end = $tokens[$nextNonEmpty]['bracket_closer'];
                continue;
            }

            break;

        } while (true);

        return $braces;
    }
}
