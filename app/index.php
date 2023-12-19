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
            outline: none;
            border: none;
            font-size: 1.2rem;
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

        .participants_div h3 {
            font-size: 1.5rem;
        }

        table {
            border-collapse: collapse;
            border: 2px solid black;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            text-align: left;
            padding: 6px 3px;
            background-color: #fff;
        }
        table th {
            border: 1px solid grey;
        }
        .participants_div table tr:hover {
            background-color: lightgrey;
        }

        th {
            background-color: black;
            color: white;
        }

        .category_table {
            
        }
        .highlight_in_table {
            background-color: lightgrey;
            font-size: 1.5rem;
        }
        .category_table tr td:nth-child(1) {
            width: 20%;
        }
        .category_table tr td:nth-child(2) {
            width: 30%;
        }
        .category_table tr td:nth-child(3) {
            width: 30%;
        }
        .category_table tr td:nth-child(4) {
            width: 20%;
        }
        .developedby {
            position: absolute;
            bottom: 0;
        }

        .events-attended tr th:nth-child(1) {
            width: 3%;
        }
        .events-attended tr th:nth-child(2) {
            width: 25%;
        }
        .events-attended tr th:nth-child(3) {
            width: 17%;
        }
        .events-attended tr th:nth-child(4) {
            width: 10%;
        }
        .events-attended tr th:nth-child(5) {
            width: 10%;
        }
        .events-attended tr th:nth-child(6) {
            width: 10%;
        }
        .events-attended tr th:nth-child(7) {
            width: 15%;
        }
        .events-attended tr th:nth-child(8) {
            width: 10%;
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
        <p class="developedby">Developed by Deepak Reddy Gathpa 2100031817 of ZeroOne Code Club</p>
    </div>

    <?php
    require_once 'dbconn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST['username'];

        $sql = "SELECT * FROM participants WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='participants_div'>";
            
            echo "<h3>Category-wise Points for $username</h3>";
            echo "<table class='category_table'>";
            echo "<tr>
                    <th>CO</th>
                    <th>Category</th>
                    <th>Activities Participated</th>
                    <th>Points</th>
                    <th>Percentage</th>
                  </tr>";

            $categoryPoints = array('TEC' => 0, 'ESO' => 0, 'LCH' => 0, 'IIE' => 0, 'HWB' => 0);
            $categoryEvents = array('TEC' => 0, 'ESO' => 0, 'LCH' => 0, 'IIE' => 0, 'HWB' => 0);

            while ($row = $result->fetch_assoc()) {
                // Update category points
                $categoryPoints[$row['category']] += $row['points'];
                // Update category events count
                $categoryEvents[$row['category']] += 1;
            }

            $CO = 1;
            foreach ($categoryPoints as $category => $points) {
                echo "<tr>
                        <td>CO$CO</td>
                        <td>$category</td>
                        <td>{$categoryEvents[$category]}</td>
                        <td>$points / 200</td>
                        <td>".($points/2)."%</td>
                      </tr>";
                $CO++;
            }

            // Calculate and display the total points from all categories
            $totalPoints = array_sum($categoryPoints);
            echo "<tr>
                    <td></td>
                    <td>Total</td>
                    <td>".array_sum($categoryEvents)."</td>
                    <td class='highlight_in_table'>$totalPoints / 1000</td>
                    <td class='highlight_in_table'>".($totalPoints/5)."%</td>
                  </tr>";

            echo "</table>";

            // Reset the result pointer to the beginning
            $result->data_seek(0);

            // Display the table for events attended
            echo "<h3>Events Attended by $username</h3>";
            echo "<table class='events-attended'>";
            echo "<tr>
                    <th>Sno</th>
                    <th>Event Name</th>
                    <th>Club Name</th>
                    <th>Category</th>
                    <th>Venue</th>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Points</th>
                  </tr>";

            $sno = 1;

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$sno}</td>
                        <td>{$row['event_name']}</td>
                        <td>{$row['club_name']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['venue']}</td>
                        <td>{$row['date_of_participation']}</td>
                        <td>{$row['time_slot']}</td>
                        <td>{$row['points']}</td>
                      </tr>";
                $sno++;
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
