<?php
/**
 * Ensures a file declares new symbols and causes no other side effects, or executes logic with side effects, but not both.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR1\Sniffs\Files;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Tokens;

class SideEffectsSniff implements Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array<int|string>
     */
    public function register()
    {
        return [T_OPEN_TAG];

    }//end register()


    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the token stack.
     *
     * @return int
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $result = $this->searchForConflict($phpcsFile, 0, ($phpcsFile->numTokens - 1), $tokens);

        if ($result['symbol'] !== null && $result['effect'] !== null) {
            $error = 'A file should declare new symbols (classes, functions, constants, etc.) and cause no other side effects, or it should execute logic with side effects, but should not do both. The first symbol is defined on line %s and the first side effect is on line %s.';
            $data  = [
                $tokens[$result['symbol']]['line'],
                $tokens[$result['effect']]['line'],
            ];
            $phpcsFile->addWarning($error, 0, 'FoundWithSymbols', $data);
            $phpcsFile->recordMetric($stackPtr, 'Declarations and side effects mixed', 'yes');
        } else {
            $phpcsFile->recordMetric($stackPtr, 'Declarations and side effects mixed', 'no');
        }

        return $phpcsFile->numTokens;

    }//end process()


    /**
     * Searches for symbol declarations and side effects.
     *
     * Returns the positions of both the first symbol declared and the first
     * side effect in the file. A NULL value for either indicates nothing was
     * found.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $start     The token to start searching from.
     * @param int                         $end       The token to search to.
     * @param array                       $tokens    The stack of tokens that make up
     *                                               the file.
     *
     * @return array
     */
    private function searchForConflict($phpcsFile, $start, $end, $tokens)
    {
        $symbols = [
            T_CLASS     => T_CLASS,
            T_INTERFACE => T_INTERFACE,
            T_TRAIT     => T_TRAIT,
            T_ENUM      => T_ENUM,
            T_FUNCTION  => T_FUNCTION,
        ];

        $conditions = [
            T_IF     => T_IF,
            T_ELSE   => T_ELSE,
            T_ELSEIF => T_ELSEIF,
        ];

        $checkAnnotations = $phpcsFile->config->annotations;

        $firstSymbol = null;
        $firstEffect = null;
        for ($i = $start; $i <= $end; $i++) {
            if ($checkAnnotations === true
                && $tokens[$i]['code'] === T_PHPCS_DISABLE
                && (empty($tokens[$i]['sniffCodes']) === true
                || isset($tokens[$i]['sniffCodes']['PSR1']) === true
                || isset($tokens[$i]['sniffCodes']['PSR1.Files']) === true
                || isset($tokens[$i]['sniffCodes']['PSR1.Files.SideEffects']) === true
                || isset($tokens[$i]['sniffCodes']['PSR1.Files.SideEffects.FoundWithSymbols']) === true)
            ) {
                do {
                    $i = $phpcsFile->findNext(T_PHPCS_ENABLE, ($i + 1));
                } while ($i !== false
                    && empty($tokens[$i]['sniffCodes']) === false
                    && isset($tokens[$i]['sniffCodes']['PSR1']) === false
                    && isset($tokens[$i]['sniffCodes']['PSR1.Files']) === false
                    && isset($tokens[$i]['sniffCodes']['PSR1.Files.SideEffects']) === false
                    && isset($tokens[$i]['sniffCodes']['PSR1.Files.SideEffects.FoundWithSymbols']) === false);

                if ($i === false) {
                    break;
                }

                continue;
            }

            if (isset(Tokens::$emptyTokens[$tokens[$i]['code']]) === true) {
                continue;
            }

            if ($tokens[$i]['code'] === T_OPEN_TAG
                || $tokens[$i]['code'] === T_CLOSE_TAG
            ) {
                continue;
            }

            if (substr($tokens[$i]['content'], 0, 2) === '#!') {
                continue;
            }

            if (isset(Tokens::$booleanOperators[$tokens[$i]['code']]) === true) {
                continue;
            }

            if ($tokens[$i]['code'] === T_NAMESPACE
                || $tokens[$i]['code'] === T_USE
                || $tokens[$i]['code'] === T_DECLARE
                || $tokens[$i]['code'] === T_CONST
            ) {
                if (isset($tokens[$i]['scope_opener']) === true) {
                    $i = $tokens[$i]['scope_closer'];
                    if ($tokens[$i]['code'] === T_ENDDECLARE) {
                        $semicolon = $phpcsFile->findNext(Tokens::$emptyTokens, ($i + 1), null, true);
                        if ($semicolon !== false && $tokens[$semicolon]['code'] === T_SEMICOLON) {
                            $i = $semicolon;
                        }
                    }
                } else {
                    $semicolon = $phpcsFile->findNext(T_SEMICOLON, ($i + 1));
                    if ($semicolon !== false) {
                        $i = $semicolon;
                    }
                }

                continue;
            }

            if (isset(Tokens::$methodPrefixes[$tokens[$i]['code']]) === true
                || $tokens[$i]['code'] === T_READONLY
            ) {
                continue;
            }

            if ($tokens[$i]['code'] === T_ANON_CLASS) {
                $i = $tokens[$i]['scope_closer'];
                continue;
            }

            if ($tokens[$i]['code'] === T_ATTRIBUTE
                && isset($tokens[$i]['attribute_closer']) === true
            ) {
                $i = $tokens[$i]['attribute_closer'];
                continue;
            }

            if (isset($symbols[$tokens[$i]['code']]) === true
                && isset($tokens[$i]['scope_closer']) === true
            ) {
                if ($firstSymbol === null) {
                    $firstSymbol = $i;
                }

                $i = $tokens[$i]['scope_closer'];
                continue;
            } else if ($tokens[$i]['code'] === T_STRING
                && strtolower($tokens[$i]['content']) === 'define'
            ) {
                $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($i - 1), null, true);
                if ($tokens[$prev]['code'] !== T_OBJECT_OPERATOR
                    && $tokens[$prev]['code'] !== T_NULLSAFE_OBJECT_OPERATOR
                    && $tokens[$prev]['code'] !== T_DOUBLE_COLON
                    && $tokens[$prev]['code'] !== T_FUNCTION
                ) {
                    if ($firstSymbol === null) {
                        $firstSymbol = $i;
                    }

                    $semicolon = $phpcsFile->findNext(T_SEMICOLON, ($i + 1));
                    if ($semicolon !== false) {
                        $i = $semicolon;
                    }

                    continue;
                }
            }//end if

            if ($tokens[$i]['code'] === T_STRING
                && strtolower($tokens[$i]['content']) === 'defined'
            ) {
                $openBracket = $phpcsFile->findNext(Tokens::$emptyTokens, ($i + 1), null, true);
                if ($openBracket !== false
                    && $tokens[$openBracket]['code'] === T_OPEN_PARENTHESIS
                    && isset($tokens[$openBracket]['parenthesis_closer']) === true
                ) {
                    $prev = $phpcsFile->findPrevious(Tokens::$emptyTokens, ($i - 1), null, true);
                    if ($tokens[$prev]['code'] !== T_OBJECT_OPERATOR
                        && $tokens[$prev]['code'] !== T_NULLSAFE_OBJECT_OPERATOR
                        && $tokens[$prev]['code'] !== T_DOUBLE_COLON
                        && $tokens[$prev]['code'] !== T_FUNCTION
                    ) {
                        $i = $tokens[$openBracket]['parenthesis_closer'];
                        continue;
                    }
                }
            }//end if

            if (isset($conditions[$tokens[$i]['code']]) === true) {
                if (isset($tokens[$i]['scope_opener']) === false) {
                    continue;
                }

                $result = $this->searchForConflict(
                    $phpcsFile,
                    ($tokens[$i]['scope_opener'] + 1),
                    ($tokens[$i]['scope_closer'] - 1),
                    $tokens
                );

                if ($result['symbol'] !== null) {
                    if ($firstSymbol === null) {
                        $firstSymbol = $result['symbol'];
                    }

                    if ($result['effect'] !== null) {
                        $firstEffect = $result['effect'];
                        break;
                    }
                }

                if ($firstEffect === null) {
                    $firstEffect = $result['effect'];
                }

                $i = $tokens[$i]['scope_closer'];
                continue;
            }//end if

            if ($firstEffect === null) {
                $firstEffect = $i;
            }

            if ($firstSymbol !== null) {
                break;
            }
        }//end for

        return [
            'symbol' => $firstSymbol,
            'effect' => $firstEffect,
        ];

    }//end searchForConflict()


}//end class
