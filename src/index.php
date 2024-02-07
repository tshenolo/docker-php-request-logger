<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Get all headers and store them in an array
$headers = getallheaders();

// Get the request data ($_REQUEST)
$requestData = print_r($_REQUEST, true);

// Get $_SERVER data
$serverData = print_r($_SERVER, true);

// Create a log message with date/time, request method, URL, headers, request data, and $_SERVER data
$logMessage = "[" . date('Y-m-d H:i:s') . "] Request Method: $requestMethod, URL: $requestUri\n";
$logMessage .= "Headers:\n" . print_r($headers, true) . "\n";
$logMessage .= "\$_REQUEST data:\n$requestData\n\n";
$logMessage .= "\$_SERVER Data:\n$serverData\n\n";

file_put_contents('php://stdout', $logMessage . "\n");

?>
