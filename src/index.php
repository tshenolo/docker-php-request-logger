<?php

function colorize($text, $status) {
    $out = "";
    switch($status) {
        case "SUCCESS":
            $out = "\033[32m"; // Green
            break;
        case "ERROR":
            $out = "\033[31m"; // Red
            break;
        case "WARNING":
            $out = "\033[33m"; // Yellow
            break;
        case "NOTE":
            $out = "\033[34m"; // Blue
            break;
        default:
            $out = "\033[0m"; // No Color
            break;
    }
    return $out . $text . "\033[0m";
}

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

// Convert the request data array to a string for logging
$requestDataString = print_r($requestDataArray, true);

// Get $_SERVER data
$serverData = print_r($_SERVER, true);

// GET Full Request
$requestFullData = file_get_contents('php://input');

// Create a log message with date/time, request method, URL, headers, request data, and $_SERVER data
$logMessage = colorize("[" . date('Y-m-d H:i:s') . "] Request Method: $requestMethod, URL: $requestUri\n", "NOTE");
$logMessage .= colorize("Headers:\n", "NOTE") . print_r($headers, true) . "\n";
$logMessage .= colorize("Request Data:\n", "NOTE") . print_r($requestDataArray, true) . "\n\n";
$logMessage .= colorize("\$_SERVER Data:\n", "NOTE") . print_r($serverData, true) . "\n\n";
$logMessage .= colorize("Full Request Data:\n", "NOTE") . print_r($requestFullData, true) . "\n\n";

file_put_contents('php://stdout', $logMessage . "\n");

?>
