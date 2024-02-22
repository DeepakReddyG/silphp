<?php
include_once('../../database/dbconn.php');
$loginError = '';

if (
    isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['password']) && !empty($_POST['password'])
) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];

            $updateQuery = "UPDATE users SET session_status = 'Active' WHERE id = " . $user['id'];
            mysqli_query($conn, $updateQuery);

            if ($user['user_type'] == 'Student') {
                header("Location: ../../users/student/student_index.php"); // Redirect student to student_index.php
            } elseif ($user['user_type'] == 'Admin') {
                header("Location: admin_index.php"); // Redirect admin to admin_index.php
            } else {
                header("Location: default_page.php");
            }
            exit();
        } else {
            $loginError = 'Incorrect password. Please try again.';
        }
    } else {
        $loginError = 'User not found. Please check your username.';
    }
} else {
    $loginError = 'Invalid form submission. Please fill in all required fields.';
}

mysqli_close($conn);

// Destroy the session before redirecting
session_destroy();
?>
