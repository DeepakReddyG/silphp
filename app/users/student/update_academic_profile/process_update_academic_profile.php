<?php
// Turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include your database connection file
include_once('../../../database/dbconn.php');

// Initialize $updateStatus variable
$updateStatus = null;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the script for processing profile update
    include_once('process_update_profile.php');
}

// Fetch existing values from the database to pre-fill the form
$user_id = $_SESSION['user_id'];

// Open the database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$query = "SELECT * FROM user_profile WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $profileData = mysqli_fetch_assoc($result);
} else {
    // Handle the case where user_profile data is not found
    $profileData = array(
        'profile_picture' => '',
        'gender' => 'NA',
        'residence_type' => 'NA',
        'personal_email' => '',
        'phone_number' => ''
    );
}

// Close the database connection
mysqli_close($conn);
?>