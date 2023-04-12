<?php

use ccxt\AuthenticationError;
use ccxt\DDoSProtection;
use ccxt\Exchange;
use ccxt\ExchangeError;
use ccxt\ExchangeNotAvailable;
use ccxt\NetworkError;
use ccxt\NotSupported;
use ccxt\RequestTimeout;

$root = dirname(dirname(dirname(__FILE__)));

include $root . '/ccxt.php';

date_default_timezone_set('UTC');

$exchanges = Exchange::$exchanges;

foreach ($exchanges as $exchange) {
    $id = "\\ccxt\\".$exchange;
    $exchange = new $id();
    echo "--------------------------------------------\n";
    echo $exchange->id . "\n";

    try {
        $markets = $exchange->load_markets ();
        echo count (array_values ($exchange->markets)) . " markets: " .
            implode (', ', array_slice ($exchange->symbols, 0, 5)) . "...\n";
    } catch (RequestTimeout $e) {
        echo '[Timeout Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (DDoSProtection $e) {
        echo '[DDoS Protection Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (AuthenticationError $e) {
        echo '[Authentication Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (ExchangeNotAvailable $e) {
        echo '[Exchange Not Available] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (NotSupported $e) {
        echo '[Not Supported] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (NetworkError $e) {
        echo '[Network Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (ExchangeError $e) {
        echo '[Exchange Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (Exception $e) {
        echo '[Error] ' . $e->getMessage() . "\n";
    }
    echo "\n";
}


?>