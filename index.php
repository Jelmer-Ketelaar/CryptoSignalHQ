<?php

// Set up the bot
$botToken = '6210861627:AAEpc33rfScvwihZrhTnHhOcfqY3_ohATag';
$chatId = '@CryptoSignalHQ_VIP';
$apiUrl = "https://api.telegram.org/bot$botToken/sendMessage";

// Set up the API endpoint for getting the current price of the cryptocurrency
$cryptocurrency = 'bitcoin';
$currency = 'usd';
$apiEndpoint = "https://api.coingecko.com/api/v3/simple/price?ids=$cryptocurrency&vs_currencies=$currency";
$maxRetries = 3;
$retryDelay = 5; // in seconds
$response = null; // Initialize $response with null

for ($i = 0; $i < $maxRetries; $i++) {
    $response = file_get_contents($apiEndpoint);
    if ($response !== false) {
        break;
    }
    sleep($retryDelay);
}

// Decode the API response
$data = json_decode($response, true);

if ($data === null || !isset($data[$cryptocurrency][$currency])) {
    echo "Error: Failed to get current price";
    var_dump($response);
} else {
    $currentPrice = $data[$cryptocurrency][$currency];
}


// Set up the moving average parameters
$shortMA = 20;
$longMA = 50;
$ma = 0;

// Set up the thresholds
$buyThreshold = 1.01;
$sellThreshold = 0.99;

// Set up the message limit
$messagesPerDay = rand(3, 10);
$messagesSentToday = 0;

// Set up the variables
$currentPrice = 0;

$signalsSent = 0;

/// Send a message function
function sendSignal($chatId, $message)
{
    global $apiUrl, $botToken;

    $data = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    return file_get_contents($apiUrl, false, $context);
}

// Fetch historical price data function
function fetchHistoricalPriceData($cryptocurrency, $currency, $days): array
{
    $endTime = time();
    $startTime = strtotime("-$days days");
    $apiEndpoint = "https://api.coingecko.com/api/v3/coins/$cryptocurrency/market_chart/range?vs_currency=$currency&from=$startTime&to=$endTime";
    $response = file_get_contents($apiEndpoint);
    $data = json_decode($response, true);

    if ($data === null) {
        return [];
    } else {
        return array_map(function ($priceData) {
            return $priceData[4];
        }, $data['prices']);
    }
}


// Fetch historical price data for the past 60 days
$priceData = fetchHistoricalPriceData($cryptocurrency, $currency, 60);

if (isset($data->$cryptocurrency) && $data[$cryptocurrency] !== null) {
    $currentPrice = $data[$cryptocurrency][$currency];
} else {
    echo "Error: Invalid cryptocurrency in API response";
    var_dump($response);
}

// Calculate the moving averages
$shortMAValues = movingAverage($priceData, $shortMA);
$longMAValues = movingAverage($priceData, $longMA);

// Calculate the moving average function
function movingAverage($array, $period): array
{
    $output = array();
    for ($i = $period; $i < count($array); $i++) {
        $sum = 0;
        for ($j = $i - $period; $j < $i; $j++) {
            if (isset($array[$j])) {
                $sum += $array[$j];
            }
        }
        if (isset($array[$i]) && isset($array[$i - $period]) && $i - $period - 1 >= 0 && isset($output[$i - $period - 1])) {
            $output[] = $output[$i - $period - 1] + ($array[$i] - $array[$i - $period]) / $period;
        } else {
            $output[] = null;
        }
    }
    return $output;
}


$lastSignal = $shortMAValues[count($shortMAValues) - 1] > $longMAValues[count($longMAValues) - 1] ? 1 : -1;

// Main loop
while (true) {
// Get the current price from the API
    $response = file_get_contents($apiEndpoint);
// Decode the API response
    $data = json_decode($response);

// Calculate the moving averages
    $prices = array_merge($priceData, [$currentPrice]);
    $shortPrices = array_slice($prices, -$shortMA);
    $longPrices = array_slice($prices, -$longMA);
    $shortMAValues = movingAverage($shortPrices, $shortMA);
    $longMAValues = movingAverage($longPrices, $longMA);

// Check if the short MA is above or below the long MA
    if (!empty($shortMAValues) && !empty($longMAValues)) {
        $shortMA = end($shortMAValues);
        $longMA = end($longMAValues);
        if ($shortMA > $longMA) {
            $ma = 1;
        } elseif ($shortMA < $longMA) {
            $ma = -1;
        }
    }

// Check if a signal should be sent
    if ($ma != $lastSignal && ($ma == 1 && $currentPrice >= $buyThreshold * $longMAValues[count($longMAValues) - 1] ||
            $ma == -1 && $currentPrice <= $sellThreshold * $longMAValues[count($longMAValues) - 1])) {

        // Calculate moving averages
        $shortPeriod = 20;
        $longPeriod = 50;

        $shortMA = movingAverage($prices, $shortPeriod);
        $longMA = movingAverage($prices, $longPeriod);

        // Get the last value of the calculated moving averages
        $lastShortMA = end($shortMA);
        $lastLongMA = end($longMA);

        // Define entry and exit zones based on moving averages
        // Define entry and exit zones based on the current price
        $entryZoneStart = round($currentPrice * 0.995, 2);
        $entryZoneEnd = round($currentPrice * 1.005, 2);
        $takeProfitTargets = round($currentPrice * 0.997, 2);
        $stopTargets = round($currentPrice * 1.007, 2);

        $signalType = $shortMAValues[count($shortMAValues) - 1] > $longMAValues[count($longMAValues) - 1] ? "Bullish" : "Bearish";

// Create the new signal message using the variables
        $newSignalMessage = "💲| Pair: #BTCUSDT\n";
        $newSignalMessage .= "🚀| Entry Zone: $entryZoneStart - $entryZoneEnd\n";
        $newSignalMessage .= "———————————————\n";
        $newSignalMessage .= "📍| Take-Profit Targets: $takeProfitTargets\n";
        $newSignalMessage .= "💢| Stop Targets: $stopTargets\n";
        $newSignalMessage .= "——————————————\n";
        $newSignalMessage .= "⬆️| Signal Type: $signalType\n";

// Send the signal message
        sendSignal($chatId, $newSignalMessage);

        $buyPrice = round($currentPrice * $buyThreshold, 2);
        $sellPrice = round($currentPrice * $sellThreshold, 2);

// Wait for the price to hit the entry zone
        while ($currentPrice < $entryZoneStart || $currentPrice > $entryZoneEnd) {
            usleep(60000000);
            $response = file_get_contents($apiEndpoint);
            $data = json_decode($response);
            $currentPrice = $data->$cryptocurrency->$currency;
        }

// Check if the buy price or sell price has been reached
        if ($currentPrice >= $buyPrice || $currentPrice <= $sellPrice) {
// Determine the type of signal
            if ($ma == 1) {
                $signal = '🔥| Take Profit!';
            } else {
                $signal = '⚠️| Stop Loss Hit!';
            }
            // Create the signal message
            $message = "Signal: $signal
            ———————————————
            🟢| Buy bitcoin at: $buyPrice
            ———————————————
            🔴| Sell bitcoin at: $sellPrice
            ———————————————\n";
            // Calculate the profit/loss and add it to the message
            $entryPrice = $ma == 1 ? $buyPrice : $sellPrice;
            $exitPrice = $ma == 1 ? $sellPrice : $buyPrice;
            $profit = round((($exitPrice - $entryPrice) / $entryPrice) * 100, 2);
            if ($profit > 0) {
                $message .= "✅| Profit: $profit%";
            } else {
                $message .= "❌| Loss: " . abs($profit) . "%";
            }

// Send the signal message
            sendSignal($chatId, $message);

// Update the last signal and increment the number of signals sent
            $lastSignal = $ma;
            $signalsSent++;
        }
    }
}