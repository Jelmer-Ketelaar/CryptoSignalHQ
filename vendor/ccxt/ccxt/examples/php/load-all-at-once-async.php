<?php

use ccxt\AuthenticationError;
use ccxt\DDoSProtection;
use ccxt\Exchange;
use ccxt\ExchangeError;
use ccxt\ExchangeNotAvailable;
use ccxt\NetworkError;
use ccxt\NotSupported;
use ccxt\RequestTimeout;
use React\EventLoop\Factory;
use Recoil\React\ReactKernel;
use Recoil\Recoil;

$root = dirname(dirname(dirname(__FILE__)));

include $root . '/ccxt.php';

date_default_timezone_set('UTC');

function loadMarkets($exchange) {
    try {
        echo "Querying " . $exchange->id . "...\n";
        $markets = yield $exchange->load_markets ();
        $msg = count (array_values ($markets)) . " markets: " .
            implode (', ', array_slice ($exchange->symbols, 0, 5)) . "...\n";
    } catch (RequestTimeout $e) {
        $msg = '[Timeout Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (DDoSProtection $e) {
        $msg = '[DDoS Protection Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (AuthenticationError $e) {
        $msg = '[Authentication Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (ExchangeNotAvailable $e) {
        $msg = '[Exchange Not Available] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (NotSupported $e) {
        $msg = '[Not Supported] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (NetworkError $e) {
        $msg = '[Network Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (ExchangeError $e) {
        $msg = '[Exchange Error] ' . $e->getMessage() . ' (ignoring)' . "\n";
    } catch (Exception $e) {
        $msg = '[Error] ' . $e->getMessage() . "\n";
    }
    echo "--------------------------------------------\n";
    echo $exchange->id . "\n";
    echo $msg;
    echo "\n";
}

$loop = Factory::create();
$kernel = ReactKernel::create($loop);

$kernel->execute(function() use ($loop, $kernel) {
    $exchanges = Exchange::$exchanges;

    $yields = [];

    foreach ($exchanges as $exchange) {
        $id = "\\ccxt_async\\".$exchange;
        $exchange = new $id(array('loop' => $loop, 'kernel' => $kernel));

        $yields[] = loadMarkets($exchange);
    }
    yield $yields;

}, $loop);

$kernel->run();