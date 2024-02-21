<?php
// Include your database connection file
include_once('../../../database/dbconn.php');

// Initialize $updateStatus variable
$updateStatus = null;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $profile_picture = mysqli_real_escape_string($conn, $_POST['profile_picture']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $residence_type = mysqli_real_escape_string($conn, $_POST['residence_type']);
    $personal_email = mysqli_real_escape_string($conn, $_POST['personal_email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

    // Update the user_profile table
    // Use the user_id from the session or another secure way to identify the user
    $user_id = 1; // Replace with the actual user_id

    $updateQuery = "UPDATE user_profile 
                    SET profile_picture = '$profile_picture',
                        gender = '$gender',
                        residence_type = '$residence_type',
                        personal_email = '$personal_email',
                        phone_number = '$phone_number'
                    WHERE user_id = $user_id";

    if (mysqli_query($conn, $updateQuery)) {
        // Set success message
        $updateStatus = array('class' => 'success', 'message' => 'Profile updated successfully!');
    } else {
        // Set error message
        $updateStatus = array('class' => 'error', 'message' => 'Error updating profile: ' . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Set invalid form submission message
    $updateStatus = array('class' => 'error', 'message' => 'Invalid form submission.');
}

// Start session and store update status
session_start();
$_SESSION['updateStatus'] = $updateStatus;

exit();
?>
