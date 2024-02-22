<?php
include_once('../../auth/session_checkup.php');

if ($_SESSION['user_type'] !== 'Student') {

    header("Location: ../../access_denied.php");
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