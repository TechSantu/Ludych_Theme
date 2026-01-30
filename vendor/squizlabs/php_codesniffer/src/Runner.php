<?php
/**
 * Responsible for running PHPCS and PHPCBF.
 *
 * After creating an object of this class, you probably just want to
 * call runPHPCS() or runPHPCBF().
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/HEAD/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer;

use Exception;
use InvalidArgumentException;
use PHP_CodeSniffer\Exceptions\DeepExitException;
use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Files\DummyFile;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Files\FileList;
use PHP_CodeSniffer\Util\Cache;
use PHP_CodeSniffer\Util\Common;
use PHP_CodeSniffer\Util\Standards;
use PHP_CodeSniffer\Util\Timing;
use PHP_CodeSniffer\Util\Tokens;

class Runner
{

    /**
     * The config data for the run.
     *
     * @var \PHP_CodeSniffer\Config
     */
    public $config = null;

    /**
     * The ruleset used for the run.
     *
     * @var \PHP_CodeSniffer\Ruleset
     */
    public $ruleset = null;

    /**
     * The reporter used for generating reports after the run.
     *
     * @var \PHP_CodeSniffer\Reporter
     */
    public $reporter = null;


    /**
     * Run the PHPCS script.
     *
     * @return int
     */
    public function runPHPCS()
    {
        $this->registerOutOfMemoryShutdownMessage('phpcs');

        try {
            Timing::startTiming();
            Runner::checkRequirements();

            if (defined('PHP_CODESNIFFER_CBF') === false) {
                define('PHP_CODESNIFFER_CBF', false);
            }

            $this->config = new Config();

            $this->init();

            if ($this->config->explain === true) {
                $standards = $this->config->standards;
                foreach ($standards as $standard) {
                    $this->config->standards = [$standard];
                    $ruleset = new Ruleset($this->config);
                    $ruleset->explain();
                }

                return 0;
            }

            if ($this->config->generator !== null) {
                $standards = $this->config->standards;
                foreach ($standards as $standard) {
                    $this->config->standards = [$standard];
                    $ruleset   = new Ruleset($this->config);
                    $class     = 'PHP_CodeSniffer\Generators\\'.$this->config->generator;
                    $generator = new $class($ruleset);
                    $generator->generate();
                }

                return 0;
            }

            if ($this->config->interactive === true) {
                $this->config->reports      = ['full' => null];
                $this->config->parallel     = 1;
                $this->config->showProgress = false;
            }

            if ($this->config->stdin === true) {
                $this->config->cache = false;
            }

            $numErrors = $this->run();

            $toScreen = $this->reporter->printReports();

            if ($this->config->interactive === false
                && ($toScreen === false
                || (($this->reporter->totalErrors + $this->reporter->totalWarnings) === 0 && $this->config->showProgress === true))
            ) {
                Timing::printRunTime();
            }
        } catch (DeepExitException $e) {
            echo $e->getMessage();
            return $e->getCode();
        }//end try

        if ($numErrors === 0) {
            return 0;
        } else if ($this->reporter->totalFixable === 0) {
            return 1;
        } else {
            return 2;
        }

    }//end runPHPCS()


    /**
     * Run the PHPCBF script.
     *
     * @return int
     */
    public function runPHPCBF()
    {
        $this->registerOutOfMemoryShutdownMessage('phpcbf');

        if (defined('PHP_CODESNIFFER_CBF') === false) {
            define('PHP_CODESNIFFER_CBF', true);
        }

        try {
            Timing::startTiming();
            Runner::checkRequirements();

            $this->config = new Config();

            if ($this->config->stdin === true) {
                $this->config->verbosity = 0;
            }

            $this->init();

            if ($this->config->stdin === true) {
                $this->config->parallel = 1;
            }

            $this->config->generator    = null;
            $this->config->explain      = false;
            $this->config->interactive  = false;
            $this->config->cache        = false;
            $this->config->showSources  = false;
            $this->config->recordErrors = false;
            $this->config->reportFile   = null;

            $originalReports = array_change_key_case($this->config->reports, CASE_LOWER);
            $newReports      = ['cbf' => null];
            if (array_key_exists('performance', $originalReports) === true) {
                $newReports['performance'] = $originalReports['performance'];
            }

            $this->config->reports = $newReports;

            $this->config->dieOnUnknownArg = false;

            $this->run();
            $this->reporter->printReports();

            echo PHP_EOL;
            Timing::printRunTime();
        } catch (DeepExitException $e) {
            echo $e->getMessage();
            return $e->getCode();
        }//end try

        if ($this->reporter->totalFixed === 0) {
            if ($this->reporter->totalFixable === 0) {
                return 0;
            } else {
                return 2;
            }
        }

        if ($this->reporter->totalFixable === 0) {
            return 1;
        }

        return 2;

    }//end runPHPCBF()


    /**
     * Exits if the minimum requirements of PHP_CodeSniffer are not met.
     *
     * @return void
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException If the requirements are not met.
     */
    public function checkRequirements()
    {
        if (PHP_VERSION_ID < 50400) {
            $error = 'ERROR: PHP_CodeSniffer requires PHP version 5.4.0 or greater.'.PHP_EOL;
            throw new DeepExitException($error, 3);
        }

        $requiredExtensions = [
            'tokenizer',
            'xmlwriter',
            'SimpleXML',
        ];
        $missingExtensions  = [];

        foreach ($requiredExtensions as $extension) {
            if (extension_loaded($extension) === false) {
                $missingExtensions[] = $extension;
            }
        }

        if (empty($missingExtensions) === false) {
            $last      = array_pop($requiredExtensions);
            $required  = implode(', ', $requiredExtensions);
            $required .= ' and '.$last;

            if (count($missingExtensions) === 1) {
                $missing = $missingExtensions[0];
            } else {
                $last     = array_pop($missingExtensions);
                $missing  = implode(', ', $missingExtensions);
                $missing .= ' and '.$last;
            }

            $error = 'ERROR: PHP_CodeSniffer requires the %s extensions to be enabled. Please enable %s.'.PHP_EOL;
            $error = sprintf($error, $required, $missing);
            throw new DeepExitException($error, 3);
        }

    }//end checkRequirements()


    /**
     * Init the rulesets and other high-level settings.
     *
     * @return void
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException If a referenced standard is not installed.
     */
    public function init()
    {
        if (defined('PHP_CODESNIFFER_CBF') === false) {
            define('PHP_CODESNIFFER_CBF', false);
        }

        @ini_set('auto_detect_line_endings', true);

        ini_set('pcre.jit', false);

        foreach ($this->config->standards as $standard) {
            if (Standards::isInstalledStandard($standard) === false) {
                $error = 'ERROR: the "'.$standard.'" coding standard is not installed. ';
                ob_start();
                Standards::printInstalledStandards();
                $error .= ob_get_contents();
                ob_end_clean();
                throw new DeepExitException($error, 3);
            }
        }

        if (defined('PHP_CODESNIFFER_VERBOSITY') === false) {
            define('PHP_CODESNIFFER_VERBOSITY', $this->config->verbosity);
        }

        new Tokens();

        $installedStandards = Standards::getInstalledStandardDetails();
        foreach ($installedStandards as $details) {
            Autoload::addSearchPath($details['path'], $details['namespace']);
        }

        try {
            $this->ruleset = new Ruleset($this->config);

            if ($this->ruleset->hasSniffDeprecations() === true) {
                $this->ruleset->showSniffDeprecations();
            }
        } catch (RuntimeException $e) {
            $error  = rtrim($e->getMessage(), "\r\n").PHP_EOL.PHP_EOL;
            $error .= $this->config->printShortUsage(true);
            throw new DeepExitException($error, 3);
        }

    }//end init()


    /**
     * Performs the run.
     *
     * @return int The number of errors and warnings found.
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException
     */
    private function run()
    {
        $this->reporter = new Reporter($this->config);

        foreach ($this->config->bootstrap as $bootstrap) {
            include $bootstrap;
        }

        if ($this->config->stdin === true) {
            $fileContents = $this->config->stdinContent;
            if ($fileContents === null) {
                $handle = fopen('php://stdin', 'r');
                stream_set_blocking($handle, true);
                $fileContents = stream_get_contents($handle);
                fclose($handle);
            }

            $todo  = new FileList($this->config, $this->ruleset);
            $dummy = new DummyFile($fileContents, $this->ruleset, $this->config);
            $todo->addFile($dummy->path, $dummy);
        } else {
            if (empty($this->config->files) === true) {
                $error  = 'ERROR: You must supply at least one file or directory to process.'.PHP_EOL.PHP_EOL;
                $error .= $this->config->printShortUsage(true);
                throw new DeepExitException($error, 3);
            }

            if (PHP_CODESNIFFER_VERBOSITY > 0) {
                echo 'Creating file list... ';
            }

            $todo = new FileList($this->config, $this->ruleset);

            if (PHP_CODESNIFFER_VERBOSITY > 0) {
                $numFiles = count($todo);
                echo "DONE ($numFiles files in queue)".PHP_EOL;
            }

            if ($this->config->cache === true) {
                if (PHP_CODESNIFFER_VERBOSITY > 0) {
                    echo 'Loading cache... ';
                }

                Cache::load($this->ruleset, $this->config);

                if (PHP_CODESNIFFER_VERBOSITY > 0) {
                    $size = Cache::getSize();
                    echo "DONE ($size files in cache)".PHP_EOL;
                }
            }
        }//end if

        set_error_handler([$this, 'handleErrors']);

        if (PHP_CODESNIFFER_VERBOSITY > 1) {
            $this->config->parallel = 1;
        }

        if (function_exists('pcntl_fork') === false) {
            $this->config->parallel = 1;
        }

        $lastDir  = '';
        $numFiles = count($todo);

        if ($this->config->parallel === 1) {
            $numProcessed = 0;
            foreach ($todo as $path => $file) {
                if ($file->ignored === false) {
                    $currDir = dirname($path);
                    if ($lastDir !== $currDir) {
                        if (PHP_CODESNIFFER_VERBOSITY > 0) {
                            echo 'Changing into directory '.Common::stripBasepath($currDir, $this->config->basepath).PHP_EOL;
                        }

                        $lastDir = $currDir;
                    }

                    $this->processFile($file);
                } else if (PHP_CODESNIFFER_VERBOSITY > 0) {
                    echo 'Skipping '.basename($file->path).PHP_EOL;
                }

                $numProcessed++;
                $this->printProgress($file, $numFiles, $numProcessed);
            }
        } else {
            $childProcs  = [];
            $numPerBatch = ceil($numFiles / $this->config->parallel);

            for ($batch = 0; $batch < $this->config->parallel; $batch++) {
                $startAt = ($batch * $numPerBatch);
                if ($startAt >= $numFiles) {
                    break;
                }

                $endAt = ($startAt + $numPerBatch);
                if ($endAt > $numFiles) {
                    $endAt = $numFiles;
                }

                $childOutFilename = tempnam(sys_get_temp_dir(), 'phpcs-child');
                $pid = pcntl_fork();
                if ($pid === -1) {
                    throw new RuntimeException('Failed to create child process');
                } else if ($pid !== 0) {
                    $childProcs[$pid] = $childOutFilename;
                } else {
                    $todo->rewind();
                    for ($i = 0; $i < $startAt; $i++) {
                        $todo->next();
                    }

                    $this->reporter->totalFiles    = 0;
                    $this->reporter->totalErrors   = 0;
                    $this->reporter->totalWarnings = 0;
                    $this->reporter->totalFixable  = 0;
                    $this->reporter->totalFixed    = 0;

                    $pathsProcessed = [];
                    ob_start();
                    for ($i = $startAt; $i < $endAt; $i++) {
                        $path = $todo->key();
                        $file = $todo->current();

                        if ($file->ignored === true) {
                            $todo->next();
                            continue;
                        }

                        $currDir = dirname($path);
                        if ($lastDir !== $currDir) {
                            if (PHP_CODESNIFFER_VERBOSITY > 0) {
                                echo 'Changing into directory '.Common::stripBasepath($currDir, $this->config->basepath).PHP_EOL;
                            }

                            $lastDir = $currDir;
                        }

                        $this->processFile($file);

                        $pathsProcessed[] = $path;
                        $todo->next();
                    }//end for

                    $debugOutput = ob_get_contents();
                    ob_end_clean();

                    $childOutput = [
                        'totalFiles'    => $this->reporter->totalFiles,
                        'totalErrors'   => $this->reporter->totalErrors,
                        'totalWarnings' => $this->reporter->totalWarnings,
                        'totalFixable'  => $this->reporter->totalFixable,
                        'totalFixed'    => $this->reporter->totalFixed,
                    ];

                    $output  = '<'.'?php'."\n".' $childOutput = ';
                    $output .= var_export($childOutput, true);
                    $output .= ";\n\$debugOutput = ";
                    $output .= var_export($debugOutput, true);

                    if ($this->config->cache === true) {
                        $childCache = [];
                        foreach ($pathsProcessed as $path) {
                            $childCache[$path] = Cache::get($path);
                        }

                        $output .= ";\n\$childCache = ";
                        $output .= var_export($childCache, true);
                    }

                    $output .= ";\n?".'>';
                    file_put_contents($childOutFilename, $output);
                    exit();
                }//end if
            }//end for

            $success = $this->processChildProcs($childProcs);
            if ($success === false) {
                throw new RuntimeException('One or more child processes failed to run');
            }
        }//end if

        restore_error_handler();

        if (PHP_CODESNIFFER_VERBOSITY === 0
            && $this->config->interactive === false
            && $this->config->showProgress === true
        ) {
            echo PHP_EOL.PHP_EOL;
        }

        if ($this->config->cache === true) {
            Cache::save();
        }

        $ignoreWarnings = Config::getConfigData('ignore_warnings_on_exit');
        $ignoreErrors   = Config::getConfigData('ignore_errors_on_exit');

        $return = ($this->reporter->totalErrors + $this->reporter->totalWarnings);
        if ($ignoreErrors !== null) {
            $ignoreErrors = (bool) $ignoreErrors;
            if ($ignoreErrors === true) {
                $return -= $this->reporter->totalErrors;
            }
        }

        if ($ignoreWarnings !== null) {
            $ignoreWarnings = (bool) $ignoreWarnings;
            if ($ignoreWarnings === true) {
                $return -= $this->reporter->totalWarnings;
            }
        }

        return $return;

    }//end run()


    /**
     * Converts all PHP errors into exceptions.
     *
     * This method forces a sniff to stop processing if it is not
     * able to handle a specific piece of code, instead of continuing
     * and potentially getting into a loop.
     *
     * @param int    $code    The level of error raised.
     * @param string $message The error message.
     * @param string $file    The path of the file that raised the error.
     * @param int    $line    The line number the error was raised at.
     *
     * @return bool
     * @throws \PHP_CodeSniffer\Exceptions\RuntimeException
     */
    public function handleErrors($code, $message, $file, $line)
    {
        if ((error_reporting() & $code) === 0) {
            return true;
        }

        throw new RuntimeException("$message in $file on line $line");

    }//end handleErrors()


    /**
     * Processes a single file, including checking and fixing.
     *
     * @param \PHP_CodeSniffer\Files\File $file The file to be processed.
     *
     * @return void
     * @throws \PHP_CodeSniffer\Exceptions\DeepExitException
     */
    public function processFile($file)
    {
        if (PHP_CODESNIFFER_VERBOSITY > 0) {
            $startTime = microtime(true);
            echo 'Processing '.basename($file->path).' ';
            if (PHP_CODESNIFFER_VERBOSITY > 1) {
                echo PHP_EOL;
            }
        }

        try {
            $file->process();

            if (PHP_CODESNIFFER_VERBOSITY > 0) {
                $timeTaken = ((microtime(true) - $startTime) * 1000);
                if ($timeTaken < 1000) {
                    $timeTaken = round($timeTaken);
                    echo "DONE in {$timeTaken}ms";
                } else {
                    $timeTaken = round(($timeTaken / 1000), 2);
                    echo "DONE in $timeTaken secs";
                }

                if (PHP_CODESNIFFER_CBF === true) {
                    $errors = $file->getFixableCount();
                    echo " ($errors fixable violations)".PHP_EOL;
                } else {
                    $errors   = $file->getErrorCount();
                    $warnings = $file->getWarningCount();
                    echo " ($errors errors, $warnings warnings)".PHP_EOL;
                }
            }
        } catch (Exception $e) {
            $error = 'An error occurred during processing; checking has been aborted. The error message was: '.$e->getMessage();

            $sniffStack = null;
            $nextStack  = null;
            foreach ($e->getTrace() as $step) {
                if (isset($step['file']) === false) {
                    continue;
                }

                if (empty($sniffStack) === false) {
                    $nextStack = $step;
                    break;
                }

                if (substr($step['file'], -9) === 'Sniff.php') {
                    $sniffStack = $step;
                    continue;
                }
            }

            if (empty($sniffStack) === false) {
                $sniffCode = '';
                try {
                    if (empty($nextStack) === false
                        && isset($nextStack['class']) === true
                        && substr($nextStack['class'], -5) === 'Sniff'
                    ) {
                        $sniffCode = 'the '.Common::getSniffCode($nextStack['class']).' sniff';
                    }
                } catch (InvalidArgumentException $e) {
                }

                if ($sniffCode === '') {
                    $sniffCode = substr(strrchr(str_replace('\\', '/', $sniffStack['file']), '/'), 1);
                }

                $error .= sprintf(PHP_EOL.'The error originated in %s on line %s.', $sniffCode, $sniffStack['line']);
            }

            $file->addErrorOnLine($error, 1, 'Internal.Exception');
        }//end try

        $this->reporter->cacheFileReport($file);

        if ($this->config->interactive === true) {
            /*
                Running interactively.
                Print the error report for the current file and then wait for user input.
            */

            $numErrors = null;
            while ($numErrors !== 0) {
                $numErrors = ($file->getErrorCount() + $file->getWarningCount());
                if ($numErrors === 0) {
                    continue;
                }

                $this->reporter->printReport('full');

                echo '<ENTER> to recheck, [s] to skip or [q] to quit : ';
                $input = fgets(STDIN);
                $input = trim($input);

                switch ($input) {
                case 's':
                    break(2);
                case 'q':
                    throw new DeepExitException('', 0);
                default:
                    $file->ruleset->populateTokenListeners();
                    $file->reloadContent();
                    $file->process();
                    $this->reporter->cacheFileReport($file);
                    break;
                }
            }//end while
        }//end if

        $file->cleanUp();

    }//end processFile()


    /**
     * Waits for child processes to complete and cleans up after them.
     *
     * The reporting information returned by each child process is merged
     * into the main reporter class.
     *
     * @param array<int, string> $childProcs An array of child processes to wait for.
     *
     * @return bool
     */
    private function processChildProcs($childProcs)
    {
        $numProcessed = 0;
        $totalBatches = count($childProcs);

        $success = true;

        while (count($childProcs) > 0) {
            $pid = pcntl_waitpid(0, $status);
            if ($pid <= 0 || isset($childProcs[$pid]) === false) {
                continue;
            }

            $childProcessStatus = pcntl_wexitstatus($status);
            if ($childProcessStatus !== 0) {
                $success = false;
            }

            $out = $childProcs[$pid];
            unset($childProcs[$pid]);
            if (file_exists($out) === false) {
                continue;
            }

            include $out;
            unlink($out);

            $numProcessed++;

            if (isset($childOutput) === false) {
                $file = new DummyFile('', $this->ruleset, $this->config);
                $file->setErrorCounts(1, 0, 0, 0);
                $this->printProgress($file, $totalBatches, $numProcessed);
                $success = false;
                continue;
            }

            $this->reporter->totalFiles    += $childOutput['totalFiles'];
            $this->reporter->totalErrors   += $childOutput['totalErrors'];
            $this->reporter->totalWarnings += $childOutput['totalWarnings'];
            $this->reporter->totalFixable  += $childOutput['totalFixable'];
            $this->reporter->totalFixed    += $childOutput['totalFixed'];

            if (isset($debugOutput) === true) {
                echo $debugOutput;
            }

            if (isset($childCache) === true) {
                foreach ($childCache as $path => $cache) {
                    Cache::set($path, $cache);
                }
            }

            $file = new DummyFile('', $this->ruleset, $this->config);
            $file->setErrorCounts(
                $childOutput['totalErrors'],
                $childOutput['totalWarnings'],
                $childOutput['totalFixable'],
                $childOutput['totalFixed']
            );
            $this->printProgress($file, $totalBatches, $numProcessed);
        }//end while

        return $success;

    }//end processChildProcs()


    /**
     * Print progress information for a single processed file.
     *
     * @param \PHP_CodeSniffer\Files\File $file         The file that was processed.
     * @param int                         $numFiles     The total number of files to process.
     * @param int                         $numProcessed The number of files that have been processed,
     *                                                  including this one.
     *
     * @return void
     */
    public function printProgress(File $file, $numFiles, $numProcessed)
    {
        if (PHP_CODESNIFFER_VERBOSITY > 0
            || $this->config->showProgress === false
        ) {
            return;
        }

        $showColors  = $this->config->colors;
        $colorOpen   = '';
        $progressDot = '.';
        $colorClose  = '';

        if ($file->ignored === true) {
            $progressDot = 'S';
        } else {
            $errors   = $file->getErrorCount();
            $warnings = $file->getWarningCount();
            $fixable  = $file->getFixableCount();
            $fixed    = $file->getFixedCount();

            if (PHP_CODESNIFFER_CBF === true) {
                if ($fixable > 0) {
                    $progressDot = 'E';

                    if ($showColors === true) {
                        $colorOpen  = "\033[31m";
                        $colorClose = "\033[0m";
                    }
                } else if ($fixed > 0) {
                    $progressDot = 'F';

                    if ($showColors === true) {
                        $colorOpen  = "\033[32m";
                        $colorClose = "\033[0m";
                    }
                }//end if
            } else {
                if ($errors > 0) {
                    $progressDot = 'E';

                    if ($showColors === true) {
                        if ($fixable > 0) {
                            $colorOpen = "\033[32m";
                        } else {
                            $colorOpen = "\033[31m";
                        }

                        $colorClose = "\033[0m";
                    }
                } else if ($warnings > 0) {
                    $progressDot = 'W';

                    if ($showColors === true) {
                        if ($fixable > 0) {
                            $colorOpen = "\033[32m";
                        } else {
                            $colorOpen = "\033[33m";
                        }

                        $colorClose = "\033[0m";
                    }
                }//end if
            }//end if
        }//end if

        echo $colorOpen.$progressDot.$colorClose;

        $numPerLine = 60;
        if ($numProcessed !== $numFiles && ($numProcessed % $numPerLine) !== 0) {
            return;
        }

        $percent = round(($numProcessed / $numFiles) * 100);
        $padding = (strlen($numFiles) - strlen($numProcessed));
        if ($numProcessed === $numFiles
            && $numFiles > $numPerLine
            && ($numProcessed % $numPerLine) !== 0
        ) {
            $padding += ($numPerLine - ($numFiles - (floor($numFiles / $numPerLine) * $numPerLine)));
        }

        echo str_repeat(' ', $padding)." $numProcessed / $numFiles ($percent%)".PHP_EOL;

    }//end printProgress()


    /**
     * Registers a PHP shutdown function to provide a more informative out of memory error.
     *
     * @param string $command The command which was used to initiate the PHPCS run.
     *
     * @return void
     */
    private function registerOutOfMemoryShutdownMessage($command)
    {
        $errorMsg    = PHP_EOL.'The PHP_CodeSniffer "%1$s" command ran out of memory.'.PHP_EOL;
        $errorMsg   .= 'Either raise the "memory_limit" of PHP in the php.ini file or raise the memory limit at runtime'.PHP_EOL;
        $errorMsg   .= 'using "%1$s -d memory_limit=512M" (replace 512M with the desired memory limit).'.PHP_EOL;
        $errorMsg    = sprintf($errorMsg, $command);
        $memoryError = 'Allowed memory size of';
        $errorArray  = [
            'type'    => 42,
            'message' => 'Some random dummy string to take up memory and take up some more memory and some more and more and more and more',
            'file'    => 'Another random string, which would be a filename this time. Should be relatively long to allow for deeply nested files',
            'line'    => 31427,
        ];

        register_shutdown_function(
            static function () use (
                $errorMsg,
                $memoryError,
                $errorArray
            ) {
                $errorArray = error_get_last();
                if (is_array($errorArray) === true && strpos($errorArray['message'], $memoryError) !== false) {
                    echo $errorMsg;
                }
            }
        );

    }//end registerOutOfMemoryShutdownMessage()


}//end class
