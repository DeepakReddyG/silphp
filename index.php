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
            background-color: rgb(151, 0, 3);
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

        .formdiv {
            width: fit-content;
            border: 1px solid black;
            margin: 2rem auto;
        }


        form {
            display: flex;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 1.2rem;
            outline: none;
        }

        input[type="submit"] {
            padding: 8px;
            background-color: black;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
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

        th, td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
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

    <div class="formdiv">
        <form action="" method="post">
            <input type="text" id="username" name="username" placeholder="Student University ID" required>
            <br>
            <input type="submit" value="Search Participation">
        </form>
        <p class="developedby">Designed and Developed by 220030805 Sai Manikanta & 2200031219 M Pavan Karthik</p>
    </div>

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
            echo "<div class='participants_div'>";
            
            // Display the additional table for category-wise points
            echo "<h3>Category-wise Points for $username</h3>";
            echo "<table>";
            echo "<tr>
                    <th>Category</th>
                    <th>Points</th>
                  </tr>";

            // Calculate and display the total points for each category
            $categoryPoints = array('TEC' => 0, 'ESO' => 0, 'LCH' => 0, 'IIE' => 0, 'HWB' => 0);

            while ($row = $result->fetch_assoc()) {
                // Update category points
                $categoryPoints[$row['category']] += $row['points'];
            }

            foreach ($categoryPoints as $category => $points) {
                echo "<tr>
                        <td>$category</td>
                        <td>$points</td>
                      </tr>";
            }

            echo "</table>";

            // Reset the result pointer to the beginning
            $result->data_seek(0);

            // Display the table for events attended
            echo "<h3>Events Attended by $username</h3>";
            echo "<table>";
            echo "<tr>
                    <th>Event Name</th>
                    <th>Club Name</th>
                    <th>Category</th>
                    <th>Venue</th>
                    <th>Date of Participation</th>
                    <th>Time Slot</th>
                    <th>Points</th>
                  </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['event_name']}</td>
                        <td>{$row['club_name']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['venue']}</td>
                        <td>{$row['date_of_participation']}</td>
                        <td>{$row['time_slot']}</td>
                        <td>{$row['points']}</td>
                      </tr>";
            }

            echo "</table>";
            echo "</div>";
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
