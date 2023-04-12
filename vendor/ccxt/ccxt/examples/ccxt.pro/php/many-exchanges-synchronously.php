<?php

use ccxt\pro\binance;
use ccxt\pro\bittrex;
use function React\Async\coroutine;

$root = dirname(dirname(dirname(dirname(__FILE__))));
include $root . '/ccxt.php';


$config = array('enableRateLimit' => true);
$binance = new binance($config);
$bittrex = new bittrex($config);
$symbol = "BTC/USDT";

$loop = function($exchange, $symbol) {
    echo 'got inside' . PHP_EOL;
    for ($i = 0; $i < 5; $i++) {
        $ticker = yield $exchange->watch_ticker($symbol);
        print_ticker($ticker, $exchange->id, $symbol);
    }
};

function print_ticker($ticker, $exchange_name, $symbol) {
    $bid = $ticker['bid'];
    $ask = $ticker['ask'];
    echo "$exchange_name $symbol - bid: $bid <> ask: $ask" . PHP_EOL;
}

coroutine($loop, $bittrex, $symbol);
coroutine($loop, $binance, $symbol);
