<?php

// Initialize variables
$shortMAValues = [];
$longMAValues = [];

$lastSignal = null; // Initialize $lastSignal with null

// Set up the moving average parameters
$shortMA = 20;
$longMA = 50;
$ma = 0;

// Set up the bot
error_log("Set up the bot");
$botToken = '6210861627:AAEpc33rfScvwihZrhTnHhOcfqY3_ohATag';
$apiUrl = "https://api.telegram.org/bot$botToken/sendMessage";
$chatId = '@CryptoSignalHQ_VIP';

$apiKey = "nHiBNHtobep1o3bQwo"; // Replace with your actual API key
$apiEndpoint = "https://api.bybit.com/v2/public/tickers?symbol=BTCUSDT";

// Set up the message limit
error_log("Set up the message limit");
$messagesPerDay = rand(3, 10);

// Send a message function
$signalsSent = 0;
$maxRetries = 5;

// Retry the API request up to a maximum number of times
$maxAttempts = 5;
$attempts = 0;
$retryDelay = 30; // in seconds

function getApiResponseWithExponentialBackoff($url, $apiKey = null)
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

        $response = file_get_contents($url, false, $context);

        if ($response !== false) {
            return $response;
        }

        usleep($delay); // Wait before trying again
        $delay *= 2; // Double the delay for the next attempt
    }

    error_log("Error: Unable to retrieve valid API response after {$attempts} attempts.");
    return false;
}

do {
    error_log("Do statement started");
    sleep($retryDelay);
    $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
    $attempts++;
} while ($response === false && $attempts < $maxAttempts);

// If the response is still false after retrying, exit the script
if ($response === false) {
    error_log("Error: Unable to retrieve valid API response after {$maxAttempts} attempts.");
}

error_log("Script started.");

// Decode the JSON response into an associative array
$data = json_decode($response, true);

// Check if the API returned an error
if (isset($data['error'])) {
    error_log("API Error: {$data['error']}");
    exit;
}

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
// Send a message function
function sendSignal($chatId, $message)
{
    error_log("message function");
    $botToken = '6210861627:AAEpc33rfScvwihZrhTnHhOcfqY3_ohATag';
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
    ];
    error_log("data: " . print_r($data, true));

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $maxAttempts = 5;

    for ($attempts = 1; $attempts <= $maxAttempts; $attempts++) {
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 200) {
            return $response;
        } elseif ($httpCode == 400) {
            error_log("Error: Telegram API response on attempt {$attempts}: HTTP code {$httpCode}");
            error_log("Error: Bad request. Please check the chat_id, message, and bot token.");
            break;
        } else {
            // Show the API response even if there is an error
            error_log("Error: Telegram API response on attempt {$attempts}: HTTP code {$httpCode}");
            error_log("Error: Unable to send message on attempt {$attempts}. Retrying...\n");
        }
    }

    curl_close($ch);
    return false;
}

/**
 * Calculates the moving average of an array over a period of time.
 *
 * @param array $array The input array.
 * @param int $shortPeriod The period over which to calculate the short moving average.
 * @param int $longPeriod The period over which to calculate the long moving average.
 * @return array The short and long moving average arrays.
 */
function movingAverage(array $array, int $shortPeriod, int $longPeriod)
{
    if (!is_array($array) || !count($array) || count($array) < max($shortPeriod, $longPeriod)) {
        error_log("Error: Insufficient data for calculating moving averages. Please provide a larger dataset.");
        return array(array(), array());
    }

    error_log("Started movingAverage");
    if (count($array) < $longPeriod) {
        return [[], []];
    }

    $shortOutput = array();
    $longOutput = array();
    for ($i = 0; $i < count($array); $i++) {
        if ($i >= $shortPeriod && $shortPeriod != 0) {
            $shortSum = 0;
            for ($j = $i - $shortPeriod + 1; $j <= $i; $j++) {
                $shortSum += $array[$j];
            }
            $shortOutput[] = $shortSum / $shortPeriod;
        }
        if ($i >= $longPeriod && $longPeriod != 0) {
            $longSum = 0;
            for ($j = $i - $longPeriod + 1; $j <= $i; $j++) {
                $longSum += $array[$j];
            }
            $longOutput[] = $longSum / $longPeriod;
        }
    }


    // Log the output of the function
    error_log("Short moving average output: " . print_r($shortOutput, true));
    error_log("Long moving average output: " . print_r($longOutput, true));

    return [$shortOutput, $longOutput];
}


function fetchHistoricalPriceData($symbol, $interval, $dataPoints)
{
    global $shortMA, $longMA, $shortMAValues, $longMAValues, $historicalData, $shortPeriod, $longPeriod;

    error_log("Started fetchHistoricalPriceData");
    $now = time(); // Get the current timestamp
//    $fromTimestamp = $now - $interval * $dataPoints;
    $apiEndpoint = "https://api.bybit.com/v2/public/kline/list?symbol=$symbol&interval=$interval&from=0&limit=$dataPoints";
    $response = getApiResponseWithExponentialBackoff($apiEndpoint);

    if (empty($response)) {
        error_log("Error: Empty API response received. Response: $response");
        return ['prices' => [], 'shortMAValues' => [], 'longMAValues' => []];
    }

    $data = json_decode($response, true);

    if (isset($data['result']) && is_array($data['result']) && count($data['result']) > 0) {
        $prices = array_map(function ($priceData) {
            return isset($priceData['close']) ? (float)$priceData['close'] : 0;
        }, $data['result']);
    } else {
        error_log("Error: Unable to retrieve valid API response. API response content: " . $response);
        return ['prices' => [], 'shortMAValues' => [], 'longMAValues' => []];
    }

    error_log("Price data: " . print_r($prices, true)); // Debug output

    // Check if there are enough data points
    if (count($prices) < max($shortPeriod, $longPeriod)) {
        error_log("Warning: Not enough data points to calculate moving averages. Short MA count: {$shortMA}, Long MA count: {$longMA}, Data points available: " . count($prices));
        return ['prices' => [], 'shortMAValues' => [], 'longMAValues' => []];
    }

    // Calculate the moving averages
    $shortMAValues = $longMAValues = array();

    if (!empty($prices)) {
        list($shortMAValues, $longMAValues) = calculateMovingAverages($prices, $shortPeriod, $longPeriod);
    }
    // Debug output
    error_log("Short MA values: " . print_r($shortMAValues, true));
    error_log("Long MA values: " . print_r($longMAValues, true));
    error_log("Short MA count: " . count($shortMAValues));
    error_log("Long MA count: " . count($longMAValues));

    return array('prices' => $prices, 'shortMAValues' => $shortMAValues, 'longMAValues' => $longMAValues);
}


$shortPeriod = 20; // Define your short period value
$longPeriod = 50; // Define your long period value

$historicalData = fetchHistoricalPriceData("BTCUSD", 30, $shortPeriod + $longPeriod + 200);
list($shortMAValues, $longMAValues) = movingAverage($historicalData['prices'], $shortPeriod, $longPeriod);


if (count($shortMAValues) < $shortPeriod || count($longMAValues) < $longPeriod) {
    echo "Error: Insufficient data for calculating moving averages. Please provide a larger dataset.\n";
}
function calculateVolatility($symbol, $interval, $dataPoints)
{
    if ($interval <= 0 || $dataPoints <= 0) {
        return 0.01; // Set a default value for $volatility
    }
    $historicalData = fetchHistoricalPriceData($symbol, $interval, $dataPoints);
    $prices = $historicalData['prices'];

    if (empty($prices)) {
        return 0.01; // Set a default value for $volatility if prices array is empty
    }

    // Calculate standard deviation of price changes
    $changes = array();
    for ($i = 1; $i < count($prices); $i++) {
        $change = log($prices[$i] / $prices[$i - 1]);
        $changes[] = $change;
    }
    $stddev = calculateStandardDeviation($changes);

    // Debug output
    error_log("Prices: " . print_r($prices, true));
    error_log("Changes: " . print_r($changes, true));
    error_log("Standard deviation: " . $stddev);

    // Calculate volatility based on standard deviation
    return $stddev * sqrt(365 / $interval);
}

$volatility = calculateVolatility("BTCUSD", 30, 50);

if ($volatility === null) {
    $volatility = 0.01; // Set a default value for $volatility
}

$buyThreshold = 1.0000 + $volatility * 2;
$sellThreshold = 1.0000 - $volatility * 2;


function calculateStandardDeviation($arr)
{
    $num_of_elements = count($arr);

    if ($num_of_elements === 0) {
        return null; // or whatever value you want to return in this case
    }

    $variance = 0.0;
    $average = array_sum($arr) / $num_of_elements;

    foreach ($arr as $i) {
        $variance += pow(($i - $average), 2);
    }

    return sqrt($variance / $num_of_elements);
}

function calculateTradingSignal($prices)
{
    $combinedIndicator = 0;
    $maLength = 10;
    $macdFastLength = 12;
    $macdSlowLength = 26;
    $bbLength = 20;
    $bbMultiplier = 2;
    $rsiPeriod = 14;
    $tenkanLength = 9;
    $kijunLength = 26;
    $senkouLength = 52;

    $combinedIndicator = null;
    if (count($prices) >= max($maLength, $macdFastLength, $macdSlowLength, $bbLength, $rsiPeriod, $tenkanLength, $kijunLength, $senkouLength)) {
        // Calculate the moving averages
        $ma = array_sum(array_slice($prices, -$maLength)) / $maLength;

        // Calculate the RSI
        $avgGain = 0;
        $avgLoss = 0;
        for ($i = 1; $i < count($prices); $i++) {
            $diff = $prices[$i] - $prices[$i - 1];
            if ($diff > 0) {
                $avgGain = ($avgGain * ($rsiPeriod - 1) + $diff) / $rsiPeriod;
            } else if ($diff < 0) {
                $avgLoss = ($avgLoss * ($rsiPeriod - 1) - $diff) / $rsiPeriod;
            }
        }
        $rs = ($avgLoss == 0) ? 1 : ($avgGain / $avgLoss);
        $rsi = 100 - (100 / (1 + $rs));

        // Calculate the MACD
        $ema1 = array_sum(array_slice($prices, -$macdFastLength)) / $macdFastLength;
        $ema2 = array_sum(array_slice($prices, -$macdSlowLength)) / $macdSlowLength;
        $macd = $ema1 - $ema2;

        // Calculate the Bollinger Bands
        $sma = array_sum(array_slice($prices, -$bbLength)) / $bbLength;
        $sd = 0;
        foreach (array_slice($prices, -$bbLength) as $price) {
            $sd += pow($price - $sma, 2);
        }
        $sd = sqrt($sd / $bbLength);
        $bbUpper = $sma + $bbMultiplier * $sd;
        $bbLower = $sma - $bbMultiplier * $sd;

        // Calculate the Ichimoku Kinko Hyo
        $tenkan = (max(array_slice($prices, -$tenkanLength)) + min(array_slice($prices, -$tenkanLength))) / 2;
        $kijun = (max(array_slice($prices, -$kijunLength)) + min(array_slice($prices, -$kijunLength))) / 2;
        $senkouA = ($tenkan + $kijun) / 2;
        $senkouB = (max(array_slice($prices, -$senkouLength)) + min(array_slice($prices, -$senkouLength))) / 2;

        // Combine the technical indicators
        $combinedIndicator = (float)($ma + $rsi + $macd + $bbUpper + $bbLower + $senkouA + $senkouB);
    }

    return $combinedIndicator;
}

function calculateMovingAverages($prices, $shortPeriod, $longPeriod)
{
    global $shortMA, $longMA;
    $shortMAValues = $longMAValues = array();

    if (count($prices) >= $longPeriod) {
        $shortMAValues = array_slice(movingAverage($prices, $shortMA, $shortPeriod), -$longPeriod);
        $longMAValues = array_slice(movingAverage($prices, $longMA, $longPeriod), -$longPeriod);
    }

    // Check if the moving averages array is not empty before returning
    if (!empty($shortMAValues) && !empty($longMAValues)) {
        $ma = end($shortMAValues) - end($longMAValues);
    } else {
        $ma = 0;
    }

    return array($shortMAValues, $longMAValues, $ma);
}


// Fetch historical price data
$priceData = fetchHistoricalPriceData("BTCUSD", 30, max($shortMA, $longMA));

// Call the function with three arguments
list($shortMAValues, $longMAValues, $ma) = calculateMovingAverages($priceData['prices'], $shortPeriod, $longPeriod);

if (!empty($shortMAValues)) {
    $lastShortMA = end($shortMAValues);
}

if (!empty($longMAValues)) {
    $lastLongMA = end($longMAValues);
}

$loopCounter = 0;
while (true) {
    error_log("Main loop iteration: " . ++$loopCounter); // Log the current iteration
    // Get the current price from the API
    $response = getApiResponseWithExponentialBackoff($apiEndpoint, $apiKey);
    $data = json_decode($response, true);
    $currentPrice = $data['result'][0]['last_price'] ?? null;

    if ($currentPrice !== null) {
        error_log("Current price: $currentPrice");

        // Store the current price in the prices array
        $prices[] = $currentPrice;

        // Calculate the trading signal
        $combinedIndicator = calculateTradingSignal($prices);

        // Calculate the potential profit and loss for different target levels
        error_log("Calculating the potential profit and loss for different target levels");
        $targets = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $potentialProfits = [];
        $potentialLosses = [];

        // Update the value of $ma based on the moving averages
        if (!empty($shortMAValues) && !empty($longMAValues) && end($shortMAValues) > end($longMAValues)) {
            error_log("Update the value of ma based on the moving averages");
            $ma = 1; // Buy signal
        } else {
            $ma = -1; // Sell signal
        }

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
        $minProfitThreshold = 5; // 5% minimum profit threshold
        $maxProfitTarget = array_keys($potentialProfits, max($potentialProfits))[0];
        $minLossTarget = array_keys($potentialLosses, min($potentialLosses))[0];


// Use the chosen target levels in the signal message
        error_log("Use the chosen target levels in the signal message");
        $maxProfitTarget = 0.1; // 10%
        $minLossTarget = 0.1; // 10%

        $takeProfitTargets = round($currentPrice * (1 + $maxProfitTarget), 2);
        $stopTargets = round($currentPrice * (1 - $minLossTarget), 2);

// Check if a signal should be sent
        error_log("Check if a signal should be sent");
        $details = '';
        if (count($shortMAValues) > 0 && count($longMAValues) > 0 &&
            $shortMAValues[count($shortMAValues) - 1] != $ma &&
            (($ma == 1 && $currentPrice >= $buyThreshold * $longMAValues[count($longMAValues) - 1]) ||
                ($shortMAValues[count($shortMAValues) - 1] > $longMAValues[count($longMAValues) - 1] && $currentPrice >= $buyThreshold * $longMAValues[count($longMAValues) - 1]) ||
                ($ma == -1 && $currentPrice <= $sellThreshold * $longMAValues[count($longMAValues) - 1])) &&
            ($maxProfitTarget > 0 || $minLossTarget < 0) && $maxProfitTarget >= $minProfitThreshold) {

            // Calculate moving averages
            error_log("Setting variables\n");
            $shortPeriod = 50;
            $longPeriod = 100;

            error_log("Calculating moving averages\n");
            // Calculate moving averages
            $shortMAValues[] = calculateMovingAverages($prices, $shortPeriod, $longPeriod)[0];
            $longMAValues[] = calculateMovingAverages($prices, $longPeriod, $shortPeriod)[1];


            // Get the last value of the calculated moving averages
            error_log("Get the last value of the calculated moving averages\n");
            $lastShortMA = end($shortMAValues);
            $lastLongMA = end($longMAValues);

            // Define entry and exit zones based on the current price
            error_log(" Define entry and exit zones based on the current price\n");
            $entryZoneStart = round($currentPrice * 0.995, 2);
            $entryZoneEnd = round($currentPrice * 1.005, 2);

            $startTime = time(); // current time
            $periodDays = 1;
            $periodHours = 18;
            $periodMinutes = 1;
            $periodSeconds = ($periodDays * 24 * 60 * 60) + ($periodHours * 60 * 60) + ($periodMinutes * 60);

            $endTime = $startTime + $periodSeconds;
            $endTimeFormatted = date('Y-m-d H:i:s', $endTime); // format end time as a string
            echo "Period ends at: " . $endTimeFormatted;

            // Create the new signal message using the variables
            error_log("Create the new signal message using the variables\n");
            $newSignalMessage = "💲| Pair: #BTCUSDT\n";
            $newSignalMessage .= "🚀| Entry Zone: $entryZoneStart - $entryZoneEnd\n";
            $newSignalMessage .= "———————————————\n";
            $newSignalMessage .= "📍| Take-Profit Targets: $takeProfitTargets\n";
            $newSignalMessage .= "💢| Stop Targets: $stopTargets\n";
            $newSignalMessage .= "———————————————\n";
            $newSignalMessage .= "Period ends at: " . $endTimeFormatted . "⏰";

            // Send the signal message
            echo("Sending the newSignalMessage \n");

            // Call the sendSignal function with the appropriate arguments
            sendSignal($chatId, $newSignalMessage);

            if ($response === false) {
                error_log("Failed to send message.");
            } else {
                error_log("Message sent successfully.");
            }

            $buyPrice = round($currentPrice * $buyThreshold, 2);
            $sellPrice = round($currentPrice * $sellThreshold, 2);

            // Wait for the price to hit the entry zone
            while ($currentPrice < $entryZoneStart || $currentPrice > $entryZoneEnd) {
                error_log("Wait for the price to hit the entry zone\n");
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
                    $signal = '⚠️| Stop Loss!';
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

        } else {
            $details .= "Short MA count: " . count($shortMAValues) . ", Long MA count: " . count($longMAValues) . ". ";

            if (isset($shortMAValues[count($shortMAValues) - 1])) {
                $details .= "Last short MA value: " . $shortMAValues[count($shortMAValues) - 1] . ". ";
            }

            if (isset($longMAValues[count($longMAValues) - 1])) {
                $details .= "Last long MA value: " . $longMAValues[count($longMAValues) - 1] . ". ";
            }

            if ($ma == 1 && $currentPrice < $buyThreshold * $longMAValues[count($longMAValues) - 1]) {
                $details .= "The current price (" . $currentPrice . ") is below the buy threshold (" . ($buyThreshold * $longMAValues[count($longMAValues) - 1]) . "). ";
            }

            if (!empty($longMAValues)) {
                if ($ma == -1 && $currentPrice > $sellThreshold * $longMAValues[count($longMAValues) - 1]) {
                    $details .= "The current price (" . $currentPrice . ") is above the sell threshold (" . ($sellThreshold * $longMAValues[count($longMAValues) - 1]) . "). ";
                }
            }

            if ($maxProfitTarget <= 0 && $minLossTarget >= 0) {
                $details .= "The target levels do not maximize potential profit or minimize potential loss. ";
                $details .= "Max profit target: " . $maxProfitTarget . ", Min loss target: " . $minLossTarget . ". ";
            }

            error_log("Signal not met. Details: " . $details);
        }
    }
    sleep(30);
}


