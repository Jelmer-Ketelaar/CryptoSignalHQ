<?php
namespace Codeception\Module;

// here you can define custom functions for CliGuy

use Codeception\Configuration;
use Codeception\Module;
use Codeception\TestCase;

class CliHelper extends Module
{
    public function _before(TestCase $test) {
        $this->getModule('Filesystem')->copyDir(Configuration::dataDir().'claypit', Configuration::dataDir().'sandbox');
    }

    public function _after(TestCase $test) {
        $this->getModule('Filesystem')->deleteDir(Configuration::dataDir().'sandbox');
        chdir(Configuration::projectDir());
    }

    public function executeCommand($command) {
        $this->getModule('Cli')->runShellCommand('php '. Configuration::projectDir().'codecept '.$command.' -n');
    }

    public function seeDirFound($dir)
    {
        $this->assertTrue(is_dir($dir) && file_exists($dir), "Directory does not exist");
    }
}
