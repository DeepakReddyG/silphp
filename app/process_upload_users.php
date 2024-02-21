<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'database/dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {

        $csv_file = $_FILES['csv_file']['tmp_name'];

        $csv_data = array_map('str_getcsv', file($csv_file));
        array_shift($csv_data);

        $sql = "INSERT INTO users (username, name, gender, year, branch, user_type, password)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        foreach ($csv_data as $row) {
            $password = password_hash($row[0], PASSWORD_DEFAULT);
            $stmt->bind_param('sssiiss', ...$row, $password);
            $stmt->execute();
        }

        $stmt->close();

        echo "CSV file uploaded and user data inserted successfully!";
    } else {
        echo "Error uploading CSV file.";
    }
} else {

    header("Location: upload_users.php");
    exit();
}

$conn->close();

?>