<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $activity_name = $_POST['activity_name'];
    $club_name = $_POST['club_name'];
    $organized_on = $_POST['organized_on'];

    // Ensure 'storeDocuments' is within the 'app' directory
    $uploadDir = __DIR__ . '/storeDocuments/';
    $reportName = $_FILES['report']['name'];
    $reportPath = $uploadDir . $reportName;

    // Move the uploaded file to the destination folder
    if (move_uploaded_file($_FILES['report']['tmp_name'], $reportPath)) {

        $sql = "INSERT INTO activity_reports (activity_name, club_name, organized_on, report) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $activity_name, $club_name, $organized_on, $reportPath);

        if ($stmt->execute()) {
            echo "Report submitted successfully!";
        } else {
            echo "Error submitting report: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading report. Destination: $reportPath";
    }

} else {
    header("Location: add_report.php");
    exit();
}

$conn->close();

?>
