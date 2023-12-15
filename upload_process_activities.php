<?php

// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {

        $csv_file = $_FILES['csv_file']['tmp_name'];

        // Read CSV file
        $csv_data = array_map('str_getcsv', file($csv_file));

        // Skip header row
        array_shift($csv_data);

        // Prepare and execute the SQL query to insert data into the 'activities' table
        $sql = "INSERT INTO activities (name, clubname, category, organized_on, student_organizer_id, student_organizer_name, venue, time_slot, points)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement for each row in the CSV
        foreach ($csv_data as $row) {
            // Convert date format to 'YYYY-MM-DD'
            $formattedDate = DateTime::createFromFormat('m/d/Y', $row[3])->format('Y-m-d');

            // Assuming the CSV data includes points for each activity
            $stmt->bind_param('ssssssssi', $row[0], $row[1], $row[2], $formattedDate, $row[4], $row[5], $row[6], $row[7], $row[8]);
            $stmt->execute();
        }

        // Close the statement
        $stmt->close();

        echo "CSV file uploaded and data inserted successfully!";
    } else {
        echo "Error uploading CSV file.";
    }
} else {
    // Redirect to the upload_activities.php page if the form is not submitted
    header("Location: upload_activities.php");
    exit();
}

// Close the database connection
$conn->close();
?>
