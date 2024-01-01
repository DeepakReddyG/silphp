<?php

include_once __DIR__ . '/../config.php';

$conn = new mysqli($db_config['host'], $db_config['username'], $db_config['password'], $db_config['database']);

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

// Function to sanitize input data
function sanitizeInput($data)
{
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

return $db_status;
