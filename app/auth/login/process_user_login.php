<?php
// Include the database connection file
include_once('../../database/dbconn.php');

// Initialize login error
$loginError = '';

// Check if form fields are set and not empty
if (
    isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['password']) && !empty($_POST['password'])
) {
    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user exists in the database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];

            // Update session status to 'Active'
            $updateQuery = "UPDATE users SET session_status = 'Active' WHERE id = " . $user['id'];
            mysqli_query($conn, $updateQuery);

            // Redirect based on user type
            if ($user['user_type'] == 'Student') {
                header("Location: ../../user/student/student_index.php"); // Redirect student to student_index.php
            } elseif ($user['user_type'] == 'Admin') {
                header("Location: admin_index.php"); // Redirect admin to admin_index.php
            } else {
                // Handle other user types or set a default redirection
                header("Location: default_page.php");
            }
            exit();
        } else {
            // Password is incorrect
            $loginError = 'Incorrect password. Please try again.';
        }
    } else {
        // User does not exist
        $loginError = 'User not found. Please check your username.';
    }
} else {
    // Invalid form submission
    $loginError = 'Invalid form submission. Please fill in all required fields.';
}

// Close the database connection
mysqli_close($conn);
?>
