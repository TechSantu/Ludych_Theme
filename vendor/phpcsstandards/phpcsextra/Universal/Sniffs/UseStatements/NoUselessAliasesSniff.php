<?php
/**
 * PHPCSExtra, a collection of sniffs and standards for use with PHP_CodeSniffer.
 *
 * @package   PHPCSExtra
 * @copyright 2023 PHPCSExtra Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCSStandards/PHPCSExtra
 */

namespace PHPCSExtra\Universal\Sniffs\UseStatements;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Tokens\Collections;
use PHPCSUtils\Utils\NamingConventions;
use PHPCSUtils\Utils\UseStatements;

/**
 * Detects useless aliases for import use statements.
 *
 * Aliasing something to the same name as the original construct is considered useless.
 * Note: as OO and function names in PHP are case-insensitive, aliasing to the same name,
 * using a different case is also considered useless.
 *
 * @since 1.1.0
 */
final class NoUselessAliasesSniff implements Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 1.1.0
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [\T_USE];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 1.1.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token
     *                                               in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        if (UseStatements::isImportUse($phpcsFile, $stackPtr) === false) {
            return;
        }

        $endOfStatement = $phpcsFile->findNext([\T_SEMICOLON, \T_CLOSE_TAG], ($stackPtr + 1));
        if ($endOfStatement === false) {
            return;
        }

        $hasAliases = $phpcsFile->findNext(\T_AS, ($stackPtr + 1), $endOfStatement);
        if ($hasAliases === false) {
            return;
        }

        $useStatements = UseStatements::splitImportUseStatement($phpcsFile, $stackPtr);
        if (\count($useStatements, \COUNT_RECURSIVE) <= 3) {
            return;
        }

        $tokens = $phpcsFile->getTokens();

        $aliasPtrs = [];
        $currentAs = $hasAliases;
        do {
            $aliasPtr = $phpcsFile->findNext(Tokens::$emptyTokens, ($currentAs + 1), null, true);
            if ($aliasPtr !== false && $tokens[$aliasPtr]['code'] === \T_STRING) {
                $aliasPtrs[$currentAs] = $aliasPtr;
            }

            $currentAs = $phpcsFile->findNext(\T_AS, ($currentAs + 1), $endOfStatement);
        } while ($currentAs !== false);

        foreach ($useStatements as $type => $statements) {
            foreach ($statements as $alias => $qualifiedName) {
                $unqualifiedName = \ltrim(\substr($qualifiedName, (int) \strrpos($qualifiedName, '\\')), '\\');

                $uselessAlias = false;
                if ($type === 'const') {
                    if ($unqualifiedName === $alias) {
                        $uselessAlias = true;
                    }
                } elseif (NamingConventions::isEqual($unqualifiedName, $alias)) {
                    $uselessAlias = true;
                }

                if ($uselessAlias === false) {
                    continue;
                }

                foreach ($aliasPtrs as $asPtr => $aliasPtr) {
                    if ($tokens[$aliasPtr]['content'] !== $alias) {
                        continue;
                    }

                    $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($asPtr - 1), null, true);
                    if (isset(Collections::nameTokens()[$tokens[$prev]['code']]) === false) {
                        continue; // @codeCoverageIgnore
                    } elseif ($tokens[$prev]['code'] === \T_STRING
                        && $tokens[$prev]['content'] !== $unqualifiedName
                    ) {
                        continue;
                    } elseif ($tokens[$prev]['code'] === \T_NAME_QUALIFIED
                        && $tokens[$prev]['content'] !== $qualifiedName
                        && \substr($qualifiedName, -(\strlen($tokens[$prev]['content']))) !== $tokens[$prev]['content']
                    ) {
                        continue;
                    } elseif ($tokens[$prev]['code'] === \T_NAME_FULLY_QUALIFIED
                        && $tokens[$prev]['content'] !== '\\' . $qualifiedName
                        && \substr($qualifiedName, -(\strlen($tokens[$prev]['content']))) !== $tokens[$prev]['content']
                    ) {
                        continue;
                    }

                    $error = 'Useless alias "%s" found for import of "%s"';
                    $code  = 'Found';
                    $data  = [$alias, $qualifiedName];

                    $hasComments = $phpcsFile->findNext(Tokens::$commentTokens, ($prev + 1), $aliasPtr);
                    if ($hasComments !== false) {
                        $phpcsFile->addError($error, $aliasPtr, $code, $data);
                        break;
                    }

                    $fix = $phpcsFile->addFixableError($error, $aliasPtr, $code, $data);

                    if ($fix === true) {
                        $phpcsFile->fixer->beginChangeset();

                        for ($i = ($prev + 1); $i <= $aliasPtr; $i++) {
                            $phpcsFile->fixer->replaceToken($i, '');
                        }

                        $phpcsFile->fixer->endChangeset();
                    }

                    break;
                }
            }
        }
    }
}
