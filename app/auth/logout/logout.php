<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Update session status to 'Inactive'
    include_once('../../database/dbconn.php');
    $userId = $_SESSION['user_id'];
    $updateQuery = "UPDATE users SET session_status = 'Inactive' WHERE id = $userId";
    mysqli_query($conn, $updateQuery);
    mysqli_close($conn);
}

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header("Location: ../login/user_login.php");
exit();
?>
