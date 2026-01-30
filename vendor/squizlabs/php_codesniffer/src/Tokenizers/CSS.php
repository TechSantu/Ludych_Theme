<?php
/**
 * Tokenizes CSS code.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tokenizers;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Exceptions\TokenizerException;
use PHP_CodeSniffer\Util;

class CSS extends PHP
{


    /**
     * Initialise the tokenizer.
     *
     * Pre-checks the content to see if it looks minified.
     *
     * @param string                  $content The content to tokenize.
     * @param \PHP_CodeSniffer\Config $config  The config data for the run.
     * @param string                  $eolChar The EOL char used in the content.
     *
     * @return void
     * @throws \PHP_CodeSniffer\Exceptions\TokenizerException If the file appears to be minified.
     */
    public function __construct($content, Config $config, $eolChar='\n')
    {
        if ($this->isMinifiedContent($content, $eolChar) === true) {
            throw new TokenizerException('File appears to be minified and cannot be processed');
        }

        parent::__construct($content, $config, $eolChar);

    }//end __construct()


    /**
     * Creates an array of tokens when given some CSS code.
     *
     * Uses the PHP tokenizer to do all the tricky work
     *
     * @param string $string The string to tokenize.
     *
     * @return array
     */
    public function tokenize($string)
    {
        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo "\t*** START CSS TOKENIZING 1ST PASS ***".PHP_EOL;
        }

        $eolAdded = false;
        if (substr($string, (strlen($this->eolChar) * -1)) !== $this->eolChar) {
            $string  .= $this->eolChar;
            $eolAdded = true;
        }

        $string = str_replace('<?php', '^PHPCS_CSS_T_OPEN_TAG^', $string);
        $string = str_replace('?>', '^PHPCS_CSS_T_CLOSE_TAG^', $string);
        $tokens = parent::tokenize('<?php '.$string.'?>');

        $finalTokens    = [];
        $finalTokens[0] = [
            'code'    => T_OPEN_TAG,
            'type'    => 'T_OPEN_TAG',
            'content' => '',
        ];

        $newStackPtr      = 1;
        $numTokens        = count($tokens);
        $multiLineComment = false;
        for ($stackPtr = 1; $stackPtr < $numTokens; $stackPtr++) {
            $token = $tokens[$stackPtr];

            if ($token['code'] === T_BREAK
                || $token['code'] === T_LIST
                || $token['code'] === T_DEFAULT
                || $token['code'] === T_SWITCH
                || $token['code'] === T_FOR
                || $token['code'] === T_FOREACH
                || $token['code'] === T_WHILE
                || $token['code'] === T_DEC
                || $token['code'] === T_NEW
            ) {
                $token['type'] = 'T_STRING';
                $token['code'] = T_STRING;
            }

            $token['content'] = str_replace('^PHPCS_CSS_T_OPEN_TAG^', '<?php', $token['content']);
            $token['content'] = str_replace('^PHPCS_CSS_T_CLOSE_TAG^', '?>', $token['content']);

            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                $type    = $token['type'];
                $content = Util\Common::prepareForOutput($token['content']);
                echo "\tProcess token $stackPtr: $type => $content".PHP_EOL;
            }

            if ($token['code'] === T_BITWISE_XOR
                && $tokens[($stackPtr + 1)]['content'] === 'PHPCS_CSS_T_OPEN_TAG'
            ) {
                $content = '<?php';
                for ($stackPtr += 3; $stackPtr < $numTokens; $stackPtr++) {
                    if ($tokens[$stackPtr]['code'] === T_BITWISE_XOR
                        && $tokens[($stackPtr + 1)]['content'] === 'PHPCS_CSS_T_CLOSE_TAG'
                    ) {
                        $content  .= '?>';
                        $stackPtr += 2;
                        break;
                    } else {
                        $content .= $tokens[$stackPtr]['content'];
                    }
                }

                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo "\t\t=> Found embedded PHP code: ";
                    $cleanContent = Util\Common::prepareForOutput($content);
                    echo $cleanContent.PHP_EOL;
                }

                $finalTokens[$newStackPtr] = [
                    'type'    => 'T_EMBEDDED_PHP',
                    'code'    => T_EMBEDDED_PHP,
                    'content' => $content,
                ];

                $newStackPtr++;
                continue;
            }//end if

            if ($token['code'] === T_GOTO_LABEL) {
                $finalTokens[$newStackPtr] = [
                    'type'    => 'T_STRING',
                    'code'    => T_STRING,
                    'content' => substr($token['content'], 0, -1),
                ];
                $newStackPtr++;
                $finalTokens[$newStackPtr] = [
                    'type'    => 'T_COLON',
                    'code'    => T_COLON,
                    'content' => ':',
                ];
                $newStackPtr++;
                continue;
            }

            if ($token['code'] === T_FUNCTION) {
                $finalTokens[$newStackPtr] = [
                    'type'    => 'T_STRING',
                    'code'    => T_STRING,
                    'content' => $token['content'],
                ];

                $newStackPtr++;
                continue;
            }

            if ($token['code'] === T_COMMENT
                && substr($token['content'], 0, 2) === '/*'
            ) {
                $multiLineComment = true;
            }

            if ($token['code'] === T_COMMENT
                && $multiLineComment === false
                && (substr($token['content'], 0, 2) === '//'
                || $token['content'][0] === '#')
            ) {
                $content = ltrim($token['content'], '#/');

                $leadingZero = false;
                if ($content[0] === '0') {
                    $content     = '1'.$content;
                    $leadingZero = true;
                }

                $commentTokens = parent::tokenize('<?php '.$content.'?>');

                array_shift($commentTokens);
                $closeTag = array_pop($commentTokens);

                while ($closeTag['content'] !== '?'.'>') {
                    $closeTag = array_pop($commentTokens);
                }

                if ($leadingZero === true) {
                    $commentTokens[0]['content'] = substr($commentTokens[0]['content'], 1);
                    $content = substr($content, 1);
                }

                if ($token['content'][0] === '#') {
                    $firstContent = $commentTokens[0]['content'];

                    if (($commentTokens[0]['code'] === T_LNUMBER
                        || $commentTokens[0]['code'] === T_DNUMBER)
                        && $commentTokens[1]['code'] === T_STRING
                    ) {
                        $firstContent .= $commentTokens[1]['content'];
                        array_shift($commentTokens);
                    }

                    if (preg_match('/^[ABCDEF0-9]+$/i', $firstContent) === 1
                        && $commentTokens[1]['content'] !== '-'
                    ) {
                        array_shift($commentTokens);
                        $trimmed = substr($token['content'], 0, (strlen($token['content']) - strlen($content)));
                        $finalTokens[$newStackPtr] = [
                            'type'    => 'T_COLOUR',
                            'code'    => T_COLOUR,
                            'content' => $trimmed.$firstContent,
                        ];
                    } else {
                        $finalTokens[$newStackPtr] = [
                            'type'    => 'T_HASH',
                            'code'    => T_HASH,
                            'content' => '#',
                        ];
                    }
                } else {
                    $finalTokens[$newStackPtr] = [
                        'type'    => 'T_STRING',
                        'code'    => T_STRING,
                        'content' => '//',
                    ];
                }//end if

                $newStackPtr++;

                array_splice($tokens, $stackPtr, 1, $commentTokens);
                $numTokens = count($tokens);
                $stackPtr--;
                continue;
            }//end if

            if ($token['code'] === T_COMMENT
                && substr($token['content'], -2) === '*/'
            ) {
                $multiLineComment = false;
            }

            $finalTokens[$newStackPtr] = $token;
            $newStackPtr++;
        }//end for

        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo "\t*** END CSS TOKENIZING 1ST PASS ***".PHP_EOL;
            echo "\t*** START CSS TOKENIZING 2ND PASS ***".PHP_EOL;
        }

        $inStyleDef = false;

        $asperandStart = false;

        $numTokens = count($finalTokens);
        for ($stackPtr = 0; $stackPtr < $numTokens; $stackPtr++) {
            $token = $finalTokens[$stackPtr];

            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                $type    = $token['type'];
                $content = Util\Common::prepareForOutput($token['content']);
                echo "\tProcess token $stackPtr: $type => $content".PHP_EOL;
            }

            switch ($token['code']) {
            case T_OPEN_CURLY_BRACKET:
                if ($asperandStart === true) {
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        if ($inStyleDef === true) {
                            echo "\t\t* style definition closed *".PHP_EOL;
                        }

                        if ($asperandStart === true) {
                            echo "\t\t* at-rule definition closed *".PHP_EOL;
                        }
                    }

                    $inStyleDef    = false;
                    $asperandStart = false;
                } else {
                    $inStyleDef = true;
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo "\t\t* style definition opened *".PHP_EOL;
                    }
                }
                break;
            case T_CLOSE_CURLY_BRACKET:
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    if ($inStyleDef === true) {
                        echo "\t\t* style definition closed *".PHP_EOL;
                    }

                    if ($asperandStart === true) {
                        echo "\t\t* at-rule definition closed *".PHP_EOL;
                    }
                }

                $inStyleDef    = false;
                $asperandStart = false;
                break;
            case T_MINUS:
                if ($finalTokens[($stackPtr + 1)]['code'] === T_STRING) {
                    if ($finalTokens[($stackPtr - 1)]['code'] === T_STRING) {
                        $newContent = $finalTokens[($stackPtr - 1)]['content'].'-'.$finalTokens[($stackPtr + 1)]['content'];

                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            echo "\t\t* token is a string joiner; ignoring this and previous token".PHP_EOL;
                            $old = Util\Common::prepareForOutput($finalTokens[($stackPtr + 1)]['content']);
                            $new = Util\Common::prepareForOutput($newContent);
                            echo "\t\t=> token ".($stackPtr + 1)." content changed from \"$old\" to \"$new\"".PHP_EOL;
                        }

                        $finalTokens[($stackPtr + 1)]['content'] = $newContent;
                        unset($finalTokens[$stackPtr]);
                        unset($finalTokens[($stackPtr - 1)]);
                    } else {
                        $newContent = '-'.$finalTokens[($stackPtr + 1)]['content'];

                        $finalTokens[($stackPtr + 1)]['content'] = $newContent;
                        unset($finalTokens[$stackPtr]);
                    }
                } else if ($finalTokens[($stackPtr + 1)]['code'] === T_LNUMBER) {
                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        echo "\t\t* token is part of a negative number; adding content to next token and ignoring *".PHP_EOL;
                        $content = Util\Common::prepareForOutput($finalTokens[($stackPtr + 1)]['content']);
                        echo "\t\t=> token ".($stackPtr + 1)." content changed from \"$content\" to \"-$content\"".PHP_EOL;
                    }

                    $finalTokens[($stackPtr + 1)]['content'] = '-'.$finalTokens[($stackPtr + 1)]['content'];
                    unset($finalTokens[$stackPtr]);
                }//end if
                break;
            case T_COLON:
                if ($inStyleDef === false) {
                    break;
                }

                for ($x = ($stackPtr - 1); $x >= 0; $x--) {
                    if (isset(Util\Tokens::$emptyTokens[$finalTokens[$x]['code']]) === false) {
                        break;
                    }
                }

                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    $type = $finalTokens[$x]['type'];
                    echo "\t\t=> token $x changed from $type to T_STYLE".PHP_EOL;
                }

                $finalTokens[$x]['type'] = 'T_STYLE';
                $finalTokens[$x]['code'] = T_STYLE;
                break;
            case T_STRING:
                if (strtolower($token['content']) === 'url') {
                    for ($x = ($stackPtr + 1); $x < $numTokens; $x++) {
                        if (isset(Util\Tokens::$emptyTokens[$finalTokens[$x]['code']]) === false) {
                            break;
                        }
                    }

                    if ($finalTokens[$x]['code'] !== T_OPEN_PARENTHESIS) {
                        continue 2;
                    }

                    for ($y = ($x + 1); $y < $numTokens; $y++) {
                        if (isset(Util\Tokens::$emptyTokens[$finalTokens[$y]['code']]) === false) {
                            break;
                        }
                    }

                    if ($finalTokens[$y]['code'] === T_CLOSE_PARENTHESIS) {
                        continue 2;
                    }

                    if (PHP_CODESNIFFER_VERBOSITY > 1) {
                        for ($i = ($stackPtr + 1); $i <= $y; $i++) {
                            $type    = $finalTokens[$i]['type'];
                            $content = Util\Common::prepareForOutput($finalTokens[$i]['content']);
                            echo "\tProcess token $i: $type => $content".PHP_EOL;
                        }

                        echo "\t\t* token starts a URL *".PHP_EOL;
                    }

                    $newContent = '';
                    for ($i = ($x + 2); $i < $numTokens; $i++) {
                        if ($finalTokens[$i]['code'] === T_CLOSE_PARENTHESIS) {
                            break;
                        }

                        $newContent .= $finalTokens[$i]['content'];
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            $content = Util\Common::prepareForOutput($finalTokens[$i]['content']);
                            echo "\t\t=> token $i added to URL string and ignored: $content".PHP_EOL;
                        }

                        unset($finalTokens[$i]);
                    }

                    $stackPtr = $i;

                    $finalTokens[($x + 1)]['type'] = 'T_URL';
                    $finalTokens[($x + 1)]['code'] = T_URL;

                    if ($newContent !== '') {
                        $finalTokens[($x + 1)]['content'] .= $newContent;
                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            $content = Util\Common::prepareForOutput($finalTokens[($x + 1)]['content']);
                            echo "\t\t=> token content changed to: $content".PHP_EOL;
                        }
                    }
                } else if ($finalTokens[$stackPtr]['content'][0] === '-'
                    && $finalTokens[($stackPtr + 1)]['code'] === T_STRING
                ) {
                    if (isset($finalTokens[($stackPtr - 1)]) === true
                        && $finalTokens[($stackPtr - 1)]['code'] === T_STRING
                    ) {
                        $newContent = $finalTokens[($stackPtr - 1)]['content'].$finalTokens[$stackPtr]['content'].$finalTokens[($stackPtr + 1)]['content'];

                        if (PHP_CODESNIFFER_VERBOSITY > 1) {
                            echo "\t\t* token is a string joiner; ignoring this and previous token".PHP_EOL;
                            $old = Util\Common::prepareForOutput($finalTokens[($stackPtr + 1)]['content']);
                            $new = Util\Common::prepareForOutput($newContent);
                            echo "\t\t=> token ".($stackPtr + 1)." content changed from \"$old\" to \"$new\"".PHP_EOL;
                        }

                        $finalTokens[($stackPtr + 1)]['content'] = $newContent;
                        unset($finalTokens[$stackPtr]);
                        unset($finalTokens[($stackPtr - 1)]);
                    } else {
                        $newContent = $finalTokens[$stackPtr]['content'].$finalTokens[($stackPtr + 1)]['content'];

                        $finalTokens[($stackPtr + 1)]['content'] = $newContent;
                        unset($finalTokens[$stackPtr]);
                    }
                }//end if
                break;
            case T_ASPERAND:
                $asperandStart = true;
                if (PHP_CODESNIFFER_VERBOSITY > 1) {
                    echo "\t\t* at-rule definition opened *".PHP_EOL;
                }
                break;
            default:
                break;
            }//end switch
        }//end for

        $finalTokens = array_values($finalTokens);
        $numTokens   = count($finalTokens);

        $finalTokens[($numTokens - 1)]['content'] = '';

        if ($eolAdded === true) {
            $finalTokens[($numTokens - 2)]['content'] = substr(
                $finalTokens[($numTokens - 2)]['content'],
                0,
                (strlen($this->eolChar) * -1)
            );

            if ($finalTokens[($numTokens - 2)]['content'] === '') {
                unset($finalTokens[($numTokens - 2)]);
                $finalTokens = array_values($finalTokens);
                $numTokens   = count($finalTokens);
            }
        }

        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            echo "\t*** END CSS TOKENIZING 2ND PASS ***".PHP_EOL;
        }

        return $finalTokens;

    }//end tokenize()


    /**
     * Performs additional processing after main tokenizing.
     *
     * @return void
     */
    public function processAdditional()
    {
        /*
            We override this method because we don't want the PHP version to
            run during CSS processing because it is wasted processing time.
        */

    }//end processAdditional()


}//end class
