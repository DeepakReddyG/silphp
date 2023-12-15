<?php
// Define the correct username and password
$correct_username = 'admin';
$correct_password = '12345';

// Check if the username and password are provided
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];

    if ($username === $correct_username && $password === $correct_password) {
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h2>Directory Listing</h2>

    <ul>
        <li><a href="dbconn.php">Database Connection</a></li>
        <li><a href="dbconn_status.php">Database Connection Status</a></li>
        <li><a href="leaderboard.php">Leaderboard</a></li>
        <li><a href="process_upload.php">Process Upload</a></li>
        <li><a href="process_upload_participants.php">Process Upload Participants</a></li>
        <li><a href="schema.sql">Database Schema</a></li>
        <li><a href="search_participant.php">Search Participant</a></li>
        <li><a href="upload_activities.php">Upload Activities</a></li>
        <li><a href="upload_participants.php">Upload Participants</a></li>
        <li><a href="upload_process_activities.php">Upload Process Activities</a></li>
        <li><a href="view_activities.php">View Activities</a></li>
    </ul>
</body>
</html>';
    } else {
        // Invalid username or password, display authentication prompt
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Access Denied';
        exit;
    }
} else {
    // Username or password not provided, display authentication prompt
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Access Denied';
    exit;
}
?>
