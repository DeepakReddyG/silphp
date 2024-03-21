<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start session if not already started

// Include the database connection file
include_once('../../../database/dbconn.php');

// Check if user is admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
  header("Location: login.php");
  exit(); // Stop execution after redirection
}

function getStats($column) {
    global $conn;
    $sql = "SELECT $column, COUNT(*) AS count FROM users GROUP BY $column";
    $result = mysqli_query($conn, $sql);
    $stats = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $stats[] = $row;
    }
    return $stats;
}

// Get total number of users
$totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM users"));

// Get stats related to user types
$userTypeStats = getStats('user_type');

// Get stats related to gender
$genderStats = getStats('gender');

// Get stats related to residence type
$residenceStats = getStats('residence_type');

// Get stats related to year of study
$yearOfStudyStats = getStats('year_of_study');

// Get stats related to department
$departmentStats = getStats('department');

// Get stats related to cluster
$clusterStats = getStats('cluster');

// Get stats related to sil_section
$silSectionStats = getStats('sil_section');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <h2>Total Users: <?php echo $totalUsers['total_users']; ?></h2>

    <h2>User Type Statistics</h2>
    <table>
        <tr>
            <th>User Type</th>
            <th>Count</th>
        </tr>
        <?php foreach ($userTypeStats as $stat): ?>
            <tr>
                <td><?php echo $stat['user_type']; ?></td>
                <td><?php echo $stat['count']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Gender Statistics</h2>
    <table>
        <tr>
            <th>Gender</th>
            <th>Count</th>
        </tr>
        <?php foreach ($genderStats as $stat): ?>
            <tr>
                <td><?php echo $stat['gender']; ?></td>
                <td><?php echo $stat['count']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Residence Type Statistics</h2>
    <table>
        <tr>
            <th>Residence Type</th>
            <th>Count</th>
        </tr>
        <?php foreach ($residenceStats as $stat): ?>
            <tr>
                <td><?php echo $stat['residence_type']; ?></td>
                <td><?php echo $stat['count']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Add similar tables for other statistics (year of study, department, cluster, sil_section) -->

</body>
</html>
