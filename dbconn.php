<?php

$host = 'localhost'; 
$username = 'root';
$password = '';
$database = 'phpsil';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    $db_status = [
        'connected' => false,
        'error_message' => 'Connection failed: ' . $conn->connect_error
    ];
} else {
    $conn->set_charset("utf8");
    $db_status = [
        'connected' => true,
        'error_message' => null
    ];
}

return $db_status;
?>
