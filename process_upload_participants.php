<?php

//display errors
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

        // Prepare and execute the SQL query to insert data into the 'participants' table
        $sql = "INSERT INTO participants (username, name, event_name, club_name, date_of_participation, venue, time_slot, points)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement for each row in the CSV
        foreach ($csv_data as $row) {
            // Assuming the CSV data includes points for each participant
            $stmt->bind_param('sssssssi', ...$row);
            $stmt->execute();
        }

        // Close the statement
        $stmt->close();

        echo "CSV file uploaded and data inserted successfully!";
    } else {
        echo "Error uploading CSV file.";
    }
} else {
    // Redirect to the upload_participants.php page if the form is not submitted
    header("Location: upload_participants.php");
    exit();
}

// Close the database connection
$conn->close();

?>
