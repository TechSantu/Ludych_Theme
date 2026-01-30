<?php
/**
 * Ensures long conditions have a comment at the end.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\Commenting;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class LongConditionClosingCommentSniff implements Sniff
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
     * The openers that we are interested in.
     *
     * @var array<int|string>
     */
    private static $openers = [
        T_SWITCH,
        T_IF,
        T_FOR,
        T_FOREACH,
        T_WHILE,
        T_TRY,
        T_CASE,
        T_MATCH,
    ];

    /**
     * The length that a code block must be before
     * requiring a closing comment.
     *
     * @var integer
     */
    public $lineLimit = 20;

    /**
     * The format the end comment should be in.
     *
     * The placeholder %s will be replaced with the type of condition opener.
     *
     * @var string
     */
    public $commentFormat = '//end %s';


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [T_CLOSE_CURLY_BRACKET];

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

        if (isset($tokens[$stackPtr]['scope_condition']) === false) {
            return;
        }

        $startCondition = $tokens[$tokens[$stackPtr]['scope_condition']];
        $startBrace     = $tokens[$tokens[$stackPtr]['scope_opener']];
        $endBrace       = $tokens[$stackPtr];

        if (in_array($startCondition['code'], self::$openers, true) === false) {
            return;
        }

        if ($startCondition['code'] === T_IF) {
            $else = $phpcsFile->findPrevious(T_WHITESPACE, ($tokens[$stackPtr]['scope_condition'] - 1), null, true);
            if ($tokens[$else]['code'] === T_ELSE) {
                return;
            }

            do {
                $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
                if ($tokens[$nextToken]['code'] === T_ELSE || $tokens[$nextToken]['code'] === T_ELSEIF) {
                    if ($tokens[$nextToken]['code'] === T_ELSE
                        && isset($tokens[$nextToken]['scope_closer']) === false
                    ) {
                        $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($nextToken + 1), null, true);
                        if ($tokens[$nextToken]['code'] !== T_IF
                            || isset($tokens[$nextToken]['scope_closer']) === false
                        ) {
                            break;
                        }
                    }

                    if (isset($tokens[$nextToken]['scope_closer']) === false) {
                        return;
                    }

                    $stackPtr = $tokens[$nextToken]['scope_closer'];
                    $endBrace = $tokens[$stackPtr];
                } else {
                    break;
                }//end if
            } while (isset($tokens[$nextToken]['scope_closer']) === true);
        }//end if

        if ($startCondition['code'] === T_TRY) {
            do {
                $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
                if ($tokens[$nextToken]['code'] === T_CATCH
                    || $tokens[$nextToken]['code'] === T_FINALLY
                ) {
                    $stackPtr = $tokens[$nextToken]['scope_closer'];
                    $endBrace = $tokens[$stackPtr];
                } else {
                    break;
                }
            } while (isset($tokens[$nextToken]['scope_closer']) === true);
        }

        if ($startCondition['code'] === T_MATCH) {
            $nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
            if ($nextToken !== false
                && ($tokens[$nextToken]['code'] === T_SEMICOLON
                || $tokens[$nextToken]['code'] === T_COMMA)
            ) {
                $stackPtr = $nextToken;
            }
        }

        $lineDifference = ($endBrace['line'] - $startBrace['line']);

        $expected = sprintf($this->commentFormat, $startCondition['content']);
        $comment  = $phpcsFile->findNext([T_COMMENT], $stackPtr, null, false);

        if (($comment === false) || ($tokens[$comment]['line'] !== $endBrace['line'])) {
            if ($lineDifference >= $this->lineLimit) {
                $error = 'End comment for long condition not found; expected "%s"';
                $data  = [$expected];
                $fix   = $phpcsFile->addFixableError($error, $stackPtr, 'Missing', $data);

                if ($fix === true) {
                    $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
                    if ($next !== false && $tokens[$next]['line'] === $tokens[$stackPtr]['line']) {
                        $expected .= $phpcsFile->eolChar;
                    }

                    $phpcsFile->fixer->addContent($stackPtr, $expected);
                }
            }

            return;
        }

        if (($comment - $stackPtr) !== 1) {
            $error = 'Space found before closing comment; expected "%s"';
            $data  = [$expected];
            $phpcsFile->addError($error, $stackPtr, 'SpacingBefore', $data);
        }

        if (trim($tokens[$comment]['content']) !== $expected) {
            $found = trim($tokens[$comment]['content']);
            $error = 'Incorrect closing comment; expected "%s" but found "%s"';
            $data  = [
                $expected,
                $found,
            ];

            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'Invalid', $data);
            if ($fix === true) {
                $phpcsFile->fixer->replaceToken($comment, $expected.$phpcsFile->eolChar);
            }

            return;
        }

    }//end process()


}//end class
