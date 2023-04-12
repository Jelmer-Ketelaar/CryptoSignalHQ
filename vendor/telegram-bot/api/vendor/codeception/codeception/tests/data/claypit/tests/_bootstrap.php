<?php

use Codeception\Configuration;

require_once __DIR__.'/_data/MyGroupHighlighter.php';
require_once __DIR__.'/_data/VerbosityLevelOutput.php';
require_once __DIR__.'/_data/MyReportPrinter.php';

@unlink(Configuration::outputDir().'order.txt');
$fh = fopen(Configuration::outputDir().'order.txt', 'a');
fwrite($fh, 'B');
