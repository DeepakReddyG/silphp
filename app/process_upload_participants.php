<?php

// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve participant data from textarea
    $participantData = $_POST['participant_data'];

    // Explode the data into an array of rows
    $rows = explode("\n", $participantData);

    foreach ($rows as $row) {
        // Explode each row into an array of values
        $values = explode(",", $row);

        // Trim values to remove extra spaces
        $values = array_map('trim', $values);

        // Check if the username already exists
        $check_sql = "SELECT id FROM participants WHERE username = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param('s', $values[0]); // Assuming username is the first column

        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows == 0) {
            // Username doesn't exist, proceed with insertion
            $check_stmt->close();

            // Prepare and execute the SQL query to insert data into the 'participants' table
            $insert_sql = "INSERT INTO participants (username, name, event_name, club_name, category, date_of_participation, venue, time_slot, points)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $insert_stmt = $conn->prepare($insert_sql);

            $empty_fields = array_fill(0, 9, ""); // Assuming 9 columns in the table

            $insert_stmt->bind_param('ssssssssi', $values[0], ...$empty_fields);
            $insert_stmt->execute();

            // Close the statement
            $insert_stmt->close();
        } else {
            // Username already exists, handle accordingly (e.g., display an error message)
            echo "Skipping duplicate username: " . $values[0] . "<br>";
            $check_stmt->close();
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the upload_participants.php page if the form is not submitted
    header("Location: upload_participants.php");
    exit();
}
?>
