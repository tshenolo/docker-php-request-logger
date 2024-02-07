<?php
// Define the log file path
$logFilePath = 'request_log.txt';

// Open or create the log file in append mode
$logFile = fopen($logFilePath, 'a');

// Check if the log file could be opened
if ($logFile) {
    // Get the request method and URL
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];

    // Get all headers and store them in an array
    $headers = getallheaders();

    // Get the request data ($_REQUEST)
    $requestData = print_r($_REQUEST, true);

    // Create a log message with date/time, request method, URL, headers, and request data
    $logMessage = "[" . date('Y-m-d H:i:s') . "] Request Method: $requestMethod, URL: $requestUri\n";
    $logMessage .= "Headers:\n" . print_r($headers, true) . "\n";
    $logMessage .= "Request Data:\n$requestData\n\n";

    // Write the log message to the log file
    fwrite($logFile, $logMessage);

    // Close the log file
    fclose($logFile);
} else {
    // If the log file could not be opened, display an error message
    echo "Unable to open or create the log file.";
}

// Rest of your PHP code goes here

?>