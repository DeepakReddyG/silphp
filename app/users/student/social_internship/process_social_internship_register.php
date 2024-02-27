<?php
// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../database/dbconn.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $internship_domain = $_POST['internship_domain'];

    // Check if the user has already registered
    $check_query = "SELECT id FROM social_internship_registration WHERE user_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // User has already registered, set alert and redirect
        header("Location: social_internship_register.php?status=already_registered");
        exit();
    }

    // Insert data into the database
    $insert_query = "INSERT INTO social_internship_registration (user_id, internship_domain) VALUES (?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("is", $user_id, $internship_domain);

    if ($insert_stmt->execute()) {
        // Registration successful, set alert and redirect
        header("Location: social_internship_register.php?status=success");
        exit();
    } else {
        // Registration failed, set alert and redirect
        header("Location: social_internship_register.php?status=error");
        exit();
    }

    // Close the statements
    $check_stmt->close();
    $insert_stmt->close();
}
?>
