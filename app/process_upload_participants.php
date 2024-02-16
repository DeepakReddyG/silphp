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

        // Prepare and execute the SQL query to insert data into the 'participants' table
        $insert_sql = "INSERT INTO participants (username, name, event_name, club_name, category, date_of_participation, venue, time_slot, points)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $insert_stmt = $conn->prepare($insert_sql);

        foreach ($csv_data as $row) {
            // Check if the username already exists
            $check_sql = "SELECT id FROM participants WHERE username = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param('s', $row[0]); // Assuming username is the first column in your CSV

            $check_stmt->execute();
            $check_stmt->store_result();

            if ($check_stmt->num_rows == 0) {
                // Username doesn't exist, proceed with insertion
                $check_stmt->close();

                $insert_stmt->bind_param('ssssssssi', ...$row);
                $insert_stmt->execute();
            } else {
                // Username already exists, handle accordingly (e.g., skip or log the duplicate)
                echo "Skipping duplicate username: " . $row[0] . "<br>";
                $check_stmt->close();
            }
        }

        // Close the statement
        $insert_stmt->close();

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
