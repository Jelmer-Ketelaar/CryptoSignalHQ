<?php

use ccxt\ExchangeError;
use ccxt\NetworkError;
use ccxt\yobit;

$root = dirname(dirname(dirname(__FILE__)));

include $root . '/ccxt.php';

date_default_timezone_set('UTC');

class MillisecondsNonceExchange extends yobit {
    public function nonce() {
        return $this->milliseconds();
    }
}

$exchange = new MillisecondsNonceExchange(array(
    'apiKey' => 'YOUR_API_KEY',
    'secret' => 'YOUR_SECRET',
));

try {
    $symbol = 'ETH/BTC';
    $result = $exchange->fetch_balance($symbol);
    var_dump ($result);
} catch (NetworkError $e) {
    echo '[Network Error] ' . $e->getMessage() . "\n";
} catch (ExchangeError $e) {
    echo '[Exchange Error] ' . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo '[Error] ' . $e->getMessage() . "\n";
}

?>