<?php

use ccxt\NetworkError;
use ccxt\okx;

include dirname(dirname(dirname(__FILE__))) . '/ccxt.php';
date_default_timezone_set('UTC');

$exchange = new okx(array(
    // 'verbose' => true, // for debugging
    // 'timeout' => 30000,
    "apiKey" => "YOUR_API_KEY",
    "secret" => "YOUR_API_SECRET",
));

try {
	// about balance, read docs at : https://docs.ccxt.com/en/latest/manual.html?#balance-structure
    $result = $exchange->fetch_balance ();
    print_r ($result);

} catch (NetworkError $e) {
    echo '[Network Error] ' . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo '[Error] ' . $e->getMessage() . "\n";
}
