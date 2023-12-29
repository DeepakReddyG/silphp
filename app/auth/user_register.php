<?php
//display even the minute errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . '/../dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assume that the form fields are named 'username', 'password', and 'role'
    $username = sanitizeInput($_POST["username"]);
    $password = password_hash(sanitizeInput($_POST["password"]), PASSWORD_DEFAULT);
    $role = sanitizeInput($_POST["role"]);

    try {
        // Use prepared statement to prevent SQL injection
        $insertQuery = "INSERT INTO users (username, password, role, created_at) VALUES (?, ?, ?, NOW())";

        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sss", $username, $password, $role);

        if ($stmt->execute()) {
            echo "User registered successfully!";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>
