<?php
namespace Codeception\PHPUnit;

use PHPUnit_Framework_TestResult;

/**
 * Printer implementing this interface prints output to console, thus should be marked as printer and not just a logger
 *
 * Interface ConsolePrinter
 * @package Codeception\PHPUnit
 */
interface ConsolePrinter
{
    public function write($buffer);

    public function printResult(PHPUnit_Framework_TestResult $result);
}
