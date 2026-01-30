<?php
/**
 * Detects unnecessary overridden methods that simply call their parent.
 *
 * This rule is based on the PMD rule catalogue. The Useless Overriding Method
 * sniff detects the use of methods that only call their parent class's method
 * with the same name and arguments. These methods are not required.
 *
 * <code>
 * class FooBar {
 *   public function __construct($a, $b) {
 *     parent::__construct($a, $b);
 *   }
 * }
 * </code>
 *
 * @author    Manuel Pichler <mapi@manuel-pichler.de>
 * @copyright 2007-2014 Manuel Pichler. All rights reserved.
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class UselessOverridingMethodSniff implements Sniff
{

    /**
     * Object-Oriented scopes in which a call to parent::method() can exist.
     *
     * @var array<int|string, bool> Keys are the token constants, value is irrelevant.
     */
    private $validOOScopes = [
        T_CLASS      => true,
        T_ANON_CLASS => true,
        T_TRAIT      => true,
    ];


    /**
     * Registers the tokens that this sniff wants to listen for.
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [T_FUNCTION];

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
        $token  = $tokens[$stackPtr];

        if (isset($token['scope_opener'], $token['scope_closer']) === false) {
            return;
        }

        $conditions    = $token['conditions'];
        $lastCondition = end($conditions);

        if (isset($this->validOOScopes[$lastCondition]) === false) {
            return;
        }

        $methodName = $phpcsFile->getDeclarationName($stackPtr);

        $signature = [];
        foreach ($phpcsFile->getMethodParameters($stackPtr) as $param) {
            $signature[] = $param['name'];
        }

        $next = ++$token['scope_opener'];
        $end  = --$token['scope_closer'];

        for (; $next <= $end; ++$next) {
            $code = $tokens[$next]['code'];

            if (isset(Tokens::$emptyTokens[$code]) === true) {
                continue;
            } else if ($code === T_RETURN) {
                continue;
            }

            break;
        }

        if ($tokens[$next]['code'] !== T_PARENT) {
            return;
        }

        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);

        if ($tokens[$next]['code'] !== T_DOUBLE_COLON) {
            return;
        }

        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);

        if (strcasecmp($tokens[$next]['content'], $methodName) !== 0) {
            return;
        }

        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);

        if ($tokens[$next]['code'] !== T_OPEN_PARENTHESIS || isset($tokens[$next]['parenthesis_closer']) === false) {
            return;
        }

        $parameters       = [''];
        $parenthesisCount = 1;
        for (++$next; $next < $phpcsFile->numTokens; ++$next) {
            $code = $tokens[$next]['code'];

            if ($code === T_OPEN_PARENTHESIS) {
                ++$parenthesisCount;
            } else if ($code === T_CLOSE_PARENTHESIS) {
                --$parenthesisCount;
            } else if ($parenthesisCount === 1 && $code === T_COMMA) {
                $parameters[] = '';
            } else if (isset(Tokens::$emptyTokens[$code]) === false) {
                $parameters[(count($parameters) - 1)] .= $tokens[$next]['content'];
            }

            if ($parenthesisCount === 0) {
                break;
            }
        }//end for

        $next = $phpcsFile->findNext(Tokens::$emptyTokens, ($next + 1), null, true);
        if ($tokens[$next]['code'] !== T_SEMICOLON && $tokens[$next]['code'] !== T_CLOSE_TAG) {
            return;
        }

        $nonContent = Tokens::$emptyTokens;
        $nonContent[T_OPEN_TAG]  = T_OPEN_TAG;
        $nonContent[T_CLOSE_TAG] = T_CLOSE_TAG;

        for (++$next; $next <= $end; ++$next) {
            $code = $tokens[$next]['code'];
            if (isset($nonContent[$code]) === false) {
                return;
            }
        }

        $parameters = array_map('trim', $parameters);
        $parameters = array_filter($parameters);

        if (count($parameters) === count($signature) && $parameters === $signature) {
            $phpcsFile->addWarning('Possible useless method overriding detected', $stackPtr, 'Found');
        }

    }//end process()


}//end class
