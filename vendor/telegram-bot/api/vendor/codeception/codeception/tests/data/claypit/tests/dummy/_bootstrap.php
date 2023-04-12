<?php
// Here you can initialize variables that will for your tests
use Codeception\Configuration;

require_once Configuration::dataDir().'DummyClass.php';
$overload = Configuration::dataDir().'DummyOverloadableClass.php';
if (file_exists($overload)) {
    require_once($overload);
}
$codeception = 'codeception.yml';
