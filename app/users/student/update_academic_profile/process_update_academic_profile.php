<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../../../database/dbconn.php');

if (!$conn) {
    die("Error: Unable to connect to the database");
}

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year_of_study = $_POST['year_of_study'];
    $department = $_POST['department'];
    $cluster = $_POST['cluster'];
    $sil_section = $_POST['sil_section'];
    $CGPA = $_POST['CGPA'];

    // Update academic profile in the database
    $query = "UPDATE user_academic_profile SET 
              year_of_study = '$year_of_study', 
              department = '$department', 
              cluster = '$cluster', 
              sil_section = '$sil_section', 
              CGPA = '$CGPA' 
              WHERE user_id = $user_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Academic profile updated successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
