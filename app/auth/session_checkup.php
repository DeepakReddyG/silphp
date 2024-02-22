<?php
session_start();

$timeout = 900;

if (!isset($_SESSION['user_id']) || (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout)) {
    session_unset();
    session_destroy();
    header("Location: ../../../auth/login/user_login.php");
    exit();
}

$_SESSION['last_activity'] = time();
?>
