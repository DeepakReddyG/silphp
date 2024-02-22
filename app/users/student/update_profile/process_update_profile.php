<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../../../database/dbconn.php');

// Initialize update status
$updateStatus = null;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $profile_picture = mysqli_real_escape_string($conn, $_POST['profile_picture']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $residence_type = mysqli_real_escape_string($conn, $_POST['residence_type']);
    $personal_email = mysqli_real_escape_string($conn, $_POST['personal_email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

    // Check if user_id is set in the session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $updateQuery = "UPDATE user_profile 
                        SET profile_picture = '$profile_picture',
                            gender = '$gender',
                            residence_type = '$residence_type',
                            personal_email = '$personal_email',
                            phone_number = '$phone_number'
                        WHERE user_id = $user_id";

        if (mysqli_query($conn, $updateQuery)) {
            $updateStatus = array('class' => 'success', 'message' => 'Profile updated successfully!');
        } else {
            $updateStatus = array('class' => 'error', 'message' => 'Error updating profile: ' . mysqli_error($conn));
        }
    } else {
        $updateStatus = array('class' => 'error', 'message' => 'User not authenticated.');
    }

    // Do not close the connection here
} else {
    $updateStatus = array('class' => 'error', 'message' => 'Invalid form submission.');
}

// Return the update status as JSON
echo json_encode($updateStatus);
?>
