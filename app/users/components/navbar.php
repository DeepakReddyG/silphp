<?php

// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../../auth/session_checkup.php');

// if ($_SESSION['user_type'] !== 'Student' || $_SESSION['user_type'] !== 'Admin') {

if (!$_SESSION['user_id']) {
    header("Location: ../../access_denied.php");
    $user_id = $_SESSION['user_id'];
    $query = "SELECT username FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $username = $user['username'];

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="nav.css">
</head>
<body>
    <div class="navigation-bar">
        <div class="navigation-bar-in">
            <div class="navigation-bar-in-one">
                <a href="./student_index.php"><h1>SAC Activities</h1></a>
            </div>
            <div class="navigation-bar-in-two">
                <?php echo $_SESSION['username']; ?> 
                <a href="../../auth/logout/logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>