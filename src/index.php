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

// Convert the request data array to a string for logging
$requestDataString = print_r($requestDataArray, true);

// Get $_SERVER data
$serverData = print_r($_SERVER, true);

// GET Full Request
$requestFullData = file_get_contents('php://input');
$requestFullDataString = print_r($requestFullData, true);

// Create a log message with date/time, request method, URL, headers, request data, and $_SERVER data
$logMessage = "[" . date('Y-m-d H:i:s') . "] Request Method: $requestMethod, URL: $requestUri\n";
$logMessage .= "Headers:\n" . print_r($headers, true) . "\n";
$logMessage .= "Request Data:\n$requestDataString\n\n";
$logMessage .= "\$_SERVER Data:\n$serverData\n\n";
$logMessage .= "Full Request Data:\$requestFullDataString\n\n";

file_put_contents('php://stdout', $logMessage . "\n");

?>
