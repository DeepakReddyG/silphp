<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Participant</title>
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
            background-color: #333;
            color: #fff;
            margin: 0;
            padding: 0rem 2rem;
        }
        .nav-one {
            width: 50%;
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

        form {
            margin: 20px 0;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        input[type="text"] {
            padding: 8px;
        }

        input[type="submit"] {
            padding: 8px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            border: 2px solid black;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>
    <div class="nav">
        <div class="nav-one">
            <h2>Search Participant</h2>
        </div>
        <div class="nav-two">
            <a href="./leaderboard.php">Leaderboard</a>
            <a href="./view_activities.php">View Activities</a>
            <a href="./admin.php">Admin</a>
        </div>
    </div>

    <form action="" method="post">
        <label for="username">Enter Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <input type="submit" value="Search">
    </form>

    <?php
    require_once 'dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Retrieve the username from the form
        $username = $_POST['username'];

        // Prepare and execute the SQL query to get events attended by the participant
        $sql = "SELECT * FROM participants WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Display the list of events attended in a table
            echo "<h3>Events Attended by $username</h3>";
            echo "<table>";
            echo "<tr>
                    <th>Event Name</th>
                    <th>Club Name</th>
                    <th>Venue</th>
                    <th>Date of Participation</th>
                    <th>Time Slot</th>
                  </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['event_name']}</td>
                        <td>{$row['club_name']}</td>
                        <td>{$row['venue']}</td>
                        <td>{$row['date_of_participation']}</td>
                        <td>{$row['time_slot']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "No events found for the username: $username";
        }

        // Close the statement
        $stmt->close();
    }
    
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
