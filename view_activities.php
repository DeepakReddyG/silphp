<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Activities</title>
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
    <h2>View Activities</h2>

    <?php
    // Include the database connection file
    require_once 'dbconn.php';

    // Fetch all activities from the 'activities' table
    $sql = "SELECT * FROM activities";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display activities as a table
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Club Name</th>
                <th>Organized On</th>
                <th>Student Organizer ID</th>
                <th>Student Organizer Name</th>
                <th>Venue</th>
                <th>Time Slot</th>
                <th>Points</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['clubname']}</td>
                    <td>{$row['organized_on']}</td>
                    <td>{$row['student_organizer_id']}</td>
                    <td>{$row['student_organizer_name']}</td>
                    <td>{$row['venue']}</td>
                    <td>{$row['time_slot']}</td>
                    <td>{$row['points']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No activities found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
