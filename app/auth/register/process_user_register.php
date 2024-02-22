<?php
// Include the database connection file
include_once('../../database/dbconn.php');

// Initialize registration status
$registrationStatus = array();

// Check if form fields are set and not empty
if (
    isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['password']) && !empty($_POST['password'])
) {
    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if username or email already exists
    $checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (!$checkResult) {
        // Display MySQL error if the query fails
        $registrationStatus['class'] = 'error';
        $registrationStatus['message'] = 'MySQL Error: ' . mysqli_error($conn);
    } elseif (mysqli_num_rows($checkResult) > 0) {
        // Username or email already exists
        $registrationStatus['class'] = 'error';
        $registrationStatus['message'] = 'Username or email already exists. Please choose a different one.';
    } else {
        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $query = "INSERT INTO users (username, name, email, password, session_status) VALUES ('$username', '$name', '$email', '$hashedPassword', 'Inactive')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Registration successful
            $registrationStatus['class'] = 'success';
            $registrationStatus['message'] = 'Registration successful!';
        } else {
            // Registration failed
            $registrationStatus['class'] = 'error';
            $registrationStatus['message'] = 'Registration failed. Please try again. MySQL Error: ' . mysqli_error($conn);
        }
    }
} else {
    // Invalid form submission
    $registrationStatus['class'] = 'error';
    $registrationStatus['message'] = 'Invalid form submission. Please fill in all required fields.';
}

// Display registration status
echo json_encode($registrationStatus);

// Close the database connection
mysqli_close($conn);
?>
