<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="./leaderboard.css">
</head>
<body>

    <div class="nav">
        <div class="nav-in">
            <div class="nav-one">
                <h2>Student Activity Center | Activities Portal</h2>
            </div>
            <div class="nav-two">
                <a href="./index.php">Home</a>
                <a href="./leaderboard.php">Leaderboard</a>
                <a href="./add_grievance.php">Grievances</a>
                <a href="./admin.php">Admin</a>
            </div>
        </div>
    </div>

    <div class="main-content">
        <?php
            require_once 'dbconn.php';

            $sql = "SELECT username, name, COUNT(*) AS activities_attended, SUM(points) AS total_points FROM participants GROUP BY username, name ORDER BY total_points DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='leaderboard_div'>";
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
                echo "</div>";
            } else {
                echo "No data available in the leaderboard.";
            }

            $conn->close();
            ?>

    </div>



    <footer>
        <p>Designed and Developed by ZeroOne Code Club. All rights reserved</p>
    </footer>

</body>
</html>
