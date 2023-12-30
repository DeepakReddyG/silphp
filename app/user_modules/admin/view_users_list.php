<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . '/../../dbconn.php';

$selectQuery = "SELECT username, role, created_at FROM users";
$result = $conn->query($selectQuery);

if (!$result) {
    die("Error: " . $selectQuery . "<br>" . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="view_users_list.css">
</head>
<body>

    <div class="view-users-list">
        <div class="view-users-list-in">
            <div class="view-users-header">
                <div class="view-users-header-in">
                    <h1>Active Users of SAC Activities</h1>
                </div>
            </div>
            <div class="view-users-list-one">
                <div class="view-users-list-one-in">
                    <table>
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Created On</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $counter = 1; // Initialize the counter
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>"; // Display the Sno
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                            $counter++; // Increment the counter
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
