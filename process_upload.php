<?php

require_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {

        $csv_file = $_FILES['csv_file']['tmp_name'];

        $csv_data = array_map('str_getcsv', file($csv_file));

        array_shift($csv_data);

        $sql = "INSERT INTO activities (name, clubname, category, organized_on, student_organizer_id, student_organizer_name, venue, time_slot, points)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        foreach ($csv_data as $row) {
            $stmt->bind_param(
                'ssssssssi',
                ...$row
            );
            $stmt->execute();
        }

        $stmt->close();

        echo "CSV file uploaded and data inserted successfully!";
    } else {
        echo "Error uploading CSV file.";
    }
} else {
    header("Location: upload_activities.php");
    exit();
}

$conn->close();

?>
