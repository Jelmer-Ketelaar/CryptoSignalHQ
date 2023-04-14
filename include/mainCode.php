<?php
$signalsSent = 0;
$maxRetries = 5;

$apiUrl = "https://api.telegram.org/bot$botToken/sendMessage";

$apiKey = "nHiBNHtobep1o3bQwo"; // Replace with your actual API key

// Fetch API response
$apiEndpoint = "https://api.bybit.com/v2/public/tickers?symbol=BTCUSD";

// Retry the API request up to a maximum number of times
$maxAttempts = 5;
$attempts = 0;
$retryDelay = 30; // in seconds

$shortPrices = array(10, 12, 15, 14, 16);
$longPrices = array(20, 22, 25, 24, 26);
$prices = array_merge($shortPrices, $longPrices);
do {

    error_log("Do statement started");
    sleep($retryDelay);
    $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
    $attempts++;
} while ($response === false && $attempts < $maxAttempts);

// If the response is still false after retrying, exit the script
if ($response === false) {
    error_log("Error: Unable to retrieve valid API response after {$maxAttempts} attempts.");
    exit;
}

function getApiResponseWithExponentialBackoff($url, $apiKey = null): false|string
{
    $attempts = 5;
    $delay = 5000000; // 1 second in microseconds

    for ($i = 0; $i < $attempts; $i++) {
        // Add API key to headers if provided
        $options = [
            'http' => [
                'method' => "GET"
            ]
        ];
        if ($apiKey !== null) {
            $options['http']['header'] = "api_key: $apiKey";
        }
        $context = stream_context_create($options);

        $response = @file_get_contents($url, false, $context);

        if ($response !== false) {
            return $response;
        }

        usleep($delay); // Wait before trying again
        $delay *= 2; // Double the delay for the next attempt
    }

    error_log("Error: Unable to retrieve valid API response after {$attempts} attempts.");
    return false;
}


error_log("Script started.");

$data = json_decode($response, true);
$data = is_array($data) ? $data : [];

if (array_key_exists('result', $data)) {
    $ticker = $data['result'][0];
    if (isset($ticker['last_price'])) {
        $currentPrice = $ticker['last_price'];
    } else {
        error_log("Error: Invalid API response");
        var_dump($response);
        return;
    }
} else {
    error_log("Error: Invalid API response");
    var_dump($response);
    return;
}

// Set up the moving average parameters
error_log("Setting up the moving average parameters");
$shortMA = 20;
$longMA = 50;
$ma = 0;
$lastSignal = null; // Initialize $lastSignal with null

// Set up the thresholds
$buyThreshold = 1.01;
$sellThreshold = 0.99;

// Send a message function
function sendSignal($chatId, $message): false|string
{
    error_log("message function");
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
    $apiEndpoint = "https://api.bybit.com/v2/public/tickers?symbol=BTCUSD";
    $response = getApiResponseWithExponentialBackoff($apiEndpoint);

    // Log the API response
    file_put_contents('log.txt', date('Y-m-d H:i:s') . " API Response: ", "Response content $response\n", FILE_APPEND);

    $options = stream_context_create($options);
    $maxAttempts = 5;

    for ($attempts = 1; $attempts <= $maxAttempts; $attempts++) {
        $response = @file_get_contents($apiUrl, false, $options);

        if ($response !== false) {
            error_log("Response is not false");
            return $response;
        }

        error_log("Error: Unable to send message on attempt {$attempts}. Retrying...\n");
    }

    error_log("Error: Unable to send message after {$maxAttempts} attempts.\n");
    return false;
}

function movingAverage($array, $period): array
{
    error_log("Started movingAverage");
    if ($period <= 0) {
        return [];
    }

    $output = array();
    for ($i = $period; $i < count($array); $i++) {
        if (isset($array[$i]) && isset($array[$i - $period]) && $i - $period - 1 >= 0 && isset($output[$i - $period - 1])) {
            $output[] = $output[$i - $period - 1] + ($array[$i] - $array[$i - $period]) / $period;
        } else {
            $output[] = null;
        }
    }
    // Add logging statement to identify the output of the function
    error_log("Moving average output: " . print_r($output, true));

    return $output;
}

// Fetch historical price data function
function fetchHistoricalPriceData($symbol, $interval, $dataPoints): array
{
    error_log("Started fetchHistoricalPriceData");
    $apiEndpoint = "https://api.bybit.com/v2/public/kline/list?symbol=$symbol&interval=$interval&from=0&limit=$dataPoints";
    $response = getApiResponseWithExponentialBackoff($apiEndpoint);

    if (!isset($response) || $response === '') {
        error_log("Error: Empty API response received. $response");
        return [];
    }

    $data = json_decode($response, true);

    if ($data === null || !isset($data['result'])) {
        error_log("Error: Unable to retrieve valid API response. " .
            "API response content: " . $response);
        return [];
    } else {
        return array_map(function ($priceData) use ($response) {
            return isset($priceData['close']) ? (float)$priceData['close'] : 0;
        }, $data['result']);
    }
}

while (true) {
// Get the current price from the API
    error_log("Get the current price from the API");
    $response = null; // Initialize $response with null
    for ($i = 0; $i < $maxRetries; $i++) {
        $response = getApiResponseWithExponentialBackoff($apiEndpoint);
        if ($response !== false) {
            break;
        }
        sleep($retryDelay); // Add a delay between API requests
    }
    // Decode the API response
    $data = json_decode($response);

    // Check if the API response is valid
    if ($response !== false) {
        error_log("");
        $data = json_decode($response, true);
        if (isset($data['result'][0]['last_price'])) {
            $currentPrice = $data['result'][0]['last_price'];
        } else {
            error_log("Error: Invalid trading symbol in API response \n");
            var_dump($response);
        }
    } else {
        error_log("Error: Failed to fetch data from the Bybit API \n");
    }

// Calculate the moving averages
    error_log("Calculate the moving averages");
    $priceData = fetchHistoricalPriceData('BTCUSD', '30', $longMA + 1);
    error_log("Pricedata" . print_r($priceData, true));

    if (!empty($priceData)) {
        $prices = array_merge($priceData, [$currentPrice]);
        error_log("priceData is not empty");
    } else {
        $prices = [$currentPrice];
        error_log("priceData is empty");
    }

    $shortPrices = array_slice($prices, -$shortMA);
    $longPrices = array_slice($prices, -$longMA);
    $shortMAValues = movingAverage($shortPrices, $ma);
    $longMAValues = movingAverage($longPrices, $ma);


// Calculate the potential profit and loss for different target levels
    error_log("Calculating the potential profit and loss for different target levels");
    $targets = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $potentialProfits = [];
    $potentialLosses = [];

    foreach ($targets as $target) {
        $buyPrice = 0;
        if ($ma == 1) {
            // Buy signal
            error_log("Buy signal");
            $sellPrice = round($currentPrice * (1 + $target / 100), 2);
            $stopPrice = round($currentPrice * (1 - $target / 100), 2);
            $buyPrice = $currentPrice;
            $potentialProfit = round(($sellPrice - $buyPrice) / $buyPrice * 100, 2);
            $potentialLoss = round(($stopPrice - $buyPrice) / $buyPrice * 100, 2);
        } else {
            // Sell signal
            error_log("Sell signal");
            $sellPrice = round($currentPrice * (1 - $target / 100), 2);
            $stopPrice = round($currentPrice * (1 + $target / 100), 2);
            $buyPrice = $currentPrice;
            $potentialProfit = round(($buyPrice - $sellPrice) / $sellPrice * 100, 2);
            $potentialLoss = round(($buyPrice - $stopPrice) / $buyPrice * 100, 2);
        }
        $potentialProfits[$target] = $potentialProfit;
        $potentialLosses[$target] = $potentialLoss;
    }

    // Choose the target levels that maximize the potential profit and minimize the potential loss
    error_log("Choose the target levels that maximize the potential profit and minimize the potential loss");
    $maxProfitTarget = array_keys($potentialProfits, max($potentialProfits))[0];
    $minLossTarget = array_keys($potentialLosses, min($potentialLosses))[0];


    // Use the chosen target levels in the signal message
    error_log("Use the chosen target levels in the signal message");
    $takeProfitTargets = "$maxProfitTarget%, " . ($maxProfitTarget + 1) . "%, " . ($maxProfitTarget + 2) . "%";
    $stopTargets = "$minLossTarget%, " . ($minLossTarget + 1) . "%, " . ($minLossTarget + 2) . "%";

    // Check if a signal should be sent
    error_log("Check if a signal should be sent");
    if (count($shortMAValues) > 0 && $shortMAValues[count($shortMAValues) - 1] != $lastSignal && ($ma == 1 && $currentPrice >= $buyThreshold * $longMAValues[count($longMAValues) - 1] ||
            $ma == -1 && $currentPrice <= $sellThreshold * $longMAValues[count($longMAValues) - 1])) {
        // Calculate moving averages
        error_log("Calculate moving averages\n");
        $shortPeriod = 50;
        $longPeriod = 100;

        $shortMA = movingAverage($prices, $shortPeriod);
        $longMA = movingAverage($prices, $longPeriod);

        // Get the last value of the calculated moving averages
        error_log("Get the last value of the calculated moving averages\n");
        $lastShortMA = end($shortMA);
        $lastLongMA = end($longMA);

        // Define entry and exit zones based on the current price
        error_log(" Define entry and exit zones based on the current price\n");
        $entryZoneStart = round($currentPrice * 0.995, 2);
        $entryZoneEnd = round($currentPrice * 1.005, 2);
        $signalType = $shortMAValues[count($shortMAValues) - 1] > $longMAValues[count($longMAValues) - 1] ? "Bullish" : "Bearish";

        // Create the new signal message using the variables
        error_log("Create the new signal message using the variables\n");
        $newSignalMessage = "💲| Pair: #BTCUSDT\n";
        $newSignalMessage .= "🚀| Entry Zone: $entryZoneStart - $entryZoneEnd\n";
        $newSignalMessage .= "———————————————\n";
        $newSignalMessage .= "📍| Take-Profit Targets: $takeProfitTargets\n";
        $newSignalMessage .= "💢| Stop Targets: $stopTargets\n";
        $newSignalMessage .= "——————————————\n";
        $newSignalMessage .= "⬆️| Signal Type: $signalType\n";

        // Send the signal message
        error_log("Sending the signal message \n");
        sendSignal($chatId, $newSignalMessage);

        $buyPrice = round($currentPrice * $buyThreshold, 2);
        $sellPrice = round($currentPrice * $sellThreshold, 2);

        // Wait for the price to hit the entry zone
        while ($currentPrice < $entryZoneStart || $currentPrice > $entryZoneEnd) {
            error_log("Wait for the price to hit the entry zone\n");
            usleep(60000000);
            $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
            $data = json_decode($response, true);
            $currentPrice = $data['result'][0]['last_price'] ?? null;
        }

        // Check if the buy price or sell price has been reached
        if ($currentPrice >= $buyPrice || $currentPrice <= $sellPrice) {
            // Determine the type of signal
            error_log("Determine the type of signal\n");
            if ($ma == 1) {
                $signal = '🔥| Take Profit!';
            } else {
                $signal = '⚠️| Stop Loss Hit!';
            }
            // Create the signal message
            $message = "Signal: $signal\n";
            $message .= "———————————————\n";
            $message .= "🟢| Buy bitcoin at: $buyPrice\n";
            $message .= "———————————————\n";
            $message .= "🔴| Sell bitcoin at: $sellPrice\n";
            $message .= "———————————————\n";

            // Calculate the profit/loss and add it to the message
            error_log("Calculate the profit/loss and add it to the message\n");
            $entryPrice = $ma == 1 ? $buyPrice : $sellPrice;
            $exitPrice = $ma == 1 ? $sellPrice : $buyPrice;
            $profit = round((($exitPrice - $entryPrice) / $entryPrice) * 100, 2);

            if ($profit > 0) {
                $message .= "✅| Profit: $profit%\n";
            } else {
                $message .= "❌| Loss: " . abs($profit) . "%\n";
            }

            // Send the signal message
            error_log("Sending the signal message \n");
            sendSignal($chatId, $message);
            $lastSignal = $shortMAValues[count($shortMAValues) - 1];
            $signalsSent++;
        }
    }
    if ($signalsSent >= $maxRetries) {
        error_log("Reached maximum number of retries. Exiting the script.\n");
        break;
    }

// Sleep for a while before the next iteration
    sleep(60);
}

error_log("Script ended.");
