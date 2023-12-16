<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $issue_type = $_POST['issue_type'];
    $description = $_POST['description'];

    $sql = "INSERT INTO grievances (username, issue_type, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('iss', $username, $issue_type, $description);

    if ($stmt->execute()) {
        echo "Grievance submitted successfully!";
    } else {
        echo "Error submitting grievance: " . $stmt->error;
    }

    $stmt->close();
} else {
    header("Location: add_grievance.php");
    exit();
}

$conn->close();

?>
