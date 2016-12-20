<?php
$db = new SQLite3('/database/request_logger.db');

$requestBody = json_decode(file_get_contents('php://input'));

if (!isset($requestBody->hostname)) {
    throw new Exception("No hostname given in post request");
}

if (!isset($requestBody->os)) {
    throw new Exception("No os information given in post request");
}

if (!isset($requestBody->request_type)) {
    throw new Exception("No request thype given in post request");
}

$requestDetails = [
    'ip_address' => $_SERVER['REMOTE_ADDR'],
    'hostname' => $requestBody->hostname,
    'request_type' => $requestBody->request_type,
    'os' => $requestBody->os
];

$query = "INSERT INTO request (
    ip_address, hostname, request_type, os
) VALUES (
    \"" . $requestDetails['ip_address'] . "\",
    \"" . $requestDetails['hostname'] . "\",
    \"" . $requestDetails['request_type'] . "\",
    \"" . $requestDetails['os'] . "\"
)";

$db->exec($query);

echo json_encode($requestDetails);
