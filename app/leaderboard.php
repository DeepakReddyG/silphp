<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }


        .nav {
            display: flex;
            justify-content: space-between;
            background-color: rgb(151, 0, 3);
            color: #fff;
            margin: 0;
            padding: 0rem 2rem;
        }
        .nav-one {
            width: 50%;
            display: flex;
            align-items: center;
        }
        .nav-one h2 {
            color: white;
            font-size: 1.5rem;
        }
        .nav-two {
            width: 50%;
            text-align: right;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        .nav-two a {
            color: #fff;
            text-decoration: none;
            margin: 0rem 0.5rem;
        }

        .participants_div {
            width: 90%;
            margin: auto;
        }

        table {
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px solid black;
            width: 100%;
        }

        .participants_div table tr th {
            background-color: #4b1e3e;
            padding: 7px;
            border: 1px solid grey;
        }
        .participants_div td {
            border: 1px solid black;
            text-align: left;
            background-color: white;
            padding: 5px;
        }
        .participants_div table tr:hover {
            background-color: lightgrey;
        }

        th {
            background-color: black;
            color: white;
        }
        .developedby {
            position: absolute;
            bottom: 0;
        }
    </style>
</head>
<body>

<div class="nav">
        <div class="nav-one">
            <h2>Student Activity Center | Activities Portal</h2>
        </div>
        <div class="nav-two">
            <a href="./index.php">Home</a>
            <a href="./leaderboard.php">Leaderboard</a>
            <a href="./view_activities.php">View Activities</a>
            <a href="./add_grievance.php">Grievances</a>
            <a href="./admin.php">Admin</a>
        </div>
    </div>

    <?php
    require_once 'dbconn.php';

    // Fetch student information from the participants table and calculate total points
    $sql = "SELECT username, name, COUNT(*) AS activities_attended, SUM(points) AS total_points FROM participants GROUP BY username, name ORDER BY total_points DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display the leaderboard in a table
        echo "<div class='participants_div'>";
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
</body>
</html>
