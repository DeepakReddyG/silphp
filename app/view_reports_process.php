<style>
    table {
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px solid black;
            width: 100%;
        }

        table tr th {
            background-color: #4b1e3e;
            padding: 7px;
            border: 1px solid grey;
        }
        td {
            border: 1px solid black;
            text-align: left;
            background-color: white;
            padding: 5px;
        }table tr:hover {
            background-color: lightgrey;
        }

        th {
            background-color: black;
            color: white;
        }    
</style>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dbconn.php';

// Retrieve all reports from the database
$sql = "SELECT * FROM activity_reports";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Activity Name</th>
                <th>Club Name</th>
                <th>Organized On</th>
                <th>Report</th>
            </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['activity_name']}</td>
                <td>{$row['club_name']}</td>
                <td>{$row['organized_on']}</td>
                <td><a href='{$row['report']}' target='_blank'>View Report</a></td>
            </tr>";
    }

    // Close the table
    echo "</table>";
} else {
    echo "No reports found.";
}

$conn->close();

?>
