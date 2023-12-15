<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
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
    <h2>Leaderboard</h2>

    <?php
    require_once 'dbconn.php';

    // Fetch student information from the participants table and calculate total points
    $sql = "SELECT username, name, COUNT(*) AS activities_attended, SUM(points) AS total_points FROM participants GROUP BY username, name ORDER BY total_points DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display the leaderboard in a table
        echo "<table>";
        echo "<tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Name</th>
                <th>Activities Attended (SAC)</th>
                <th>Total Points</th>
              </tr>";

        $rank = 1;

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$rank}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['activities_attended']}</td>
                    <td>{$row['total_points']}</td>
                  </tr>";
            $rank++;
        }

        echo "</table>";
    } else {
        echo "No data available in the leaderboard.";
    }

    $conn->close();
    ?>
</body>
</html>
