<?php

use ccxt\bitmex;

$root = dirname(dirname(dirname(__FILE__)));

include $root . '/ccxt.php';

date_default_timezone_set('UTC');

$exchange = new bitmex(array(
    'apiKey' => 'YOUR_API_KEY', // ←------------ replace with your keys
    'secret' => 'YOUR_SECRET',
));

$symbol = 'BTC/USD:BTC-220624';
$type = 'StopLimit'; // # or 'market', or 'Stop' or 'StopLimit'
$side = 'sell'; // or 'buy'
$amount = 1.0;
$price = 6500.0; // or None

// extra params and overrides
$params = array(
    'stopPx' => 6000.0, // if needed
);

$order = $exchange->create_order($symbol, $type, $side, $amount, $price, $params);

print_r($order);
