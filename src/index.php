<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Get all headers and store them in an array
$headers = getallheaders();

// Initialize an array to store request data
$requestDataArray = array();

// Check if there's any data in the request body (for POST requests)
if ($requestMethod === 'POST' && isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    // Get the request data from the request body
    $requestData = file_get_contents('php://input');

    // Decode the JSON data
    $requestDataArray = json_decode($requestData, true);

    // Check if JSON data was successfully decoded
    if ($requestDataArray === null) {
        // JSON decoding failed, log the raw request data
        $requestDataArray = array('Raw Data' => $requestData);
    }
}

// Merge POST and GET data with precedence given to GET data
$requestDataArray = array_merge($_GET, $requestDataArray);

// Get $_SERVER data
$serverData = $_SERVER;

// Create a structured array for logging
$logData = [
    'timestamp' => date('Y-m-d H:i:s'),
    'requestMethod' => $requestMethod,
    'url' => $requestUri,
    'headers' => $headers,
    'requestData' => $requestDataArray,
    'serverData' => $serverData
];

// Encode log data to JSON with pretty print
$logMessage = json_encode($logData, JSON_PRETTY_PRINT);

// Function to apply ANSI color coding for console output
function colorize($text, $status = 'INFO') {
    $out = "";
    switch($status) {
        case "INFO":
            $out = "[42m"; // Green background
            break;
        case "ERROR":
            $out = "[41m"; // Red background
            break;
        case "WARNING":
            $out = "[43m"; // Yellow background
            break;
        default:
            $out = "[0m"; // No color
            break;
    }
    return "\033" . $out . "$text \033[0m";
}

// Apply color coding if running in a console that supports ANSI colors
if (php_sapi_name() == 'cli') {
    $logMessage = colorize($logMessage);
}

file_put_contents('php://stdout', $logMessage . "\n");

?>
