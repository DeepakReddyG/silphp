

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Participant</title>
    <link rel="stylesheet" href="./index.css">
</head>
<body>
    <!-- message-mobile -->
    <div class="message-mobile">
        <p>Sorry, this website is not available for mobile devices. Please use a desktop or laptop to access the website.</p>
    </div>
    <div class="nav">
        <div class="nav-in">
            <div class="nav-one">
                <h2>Student Activity Center | Activities Portal</h2>
            </div>
            <div class="nav-two">
                <a href="./index.php">Home</a>
                <a href="./leaderboard.php">Leaderboard</a>
                <a href="./add_grievance.php">Grievances</a>
                <a href="./social_internship.php">Social Internship</a>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="formdiv">
            <form action="" method="post">
                <input type="text" id="username" name="username" placeholder="Student University ID" required>
                <input type="submit" value="Search Participation">
            </form>
        </div>

        <div class="points-table">
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
                        echo "<div class='points_table_div'>";
                        echo "<h3>Category-wise Points for $username</h3>";
                        echo "<table class='category_table'>";
                            echo "<tr>
                                    <th>Category</th>
                                    <th>Activities Participated</th>
                                    <th>Points</th>
                                    <th>Percentage</th>
                                </tr>";

                            $categoryPoints = array('TEC' => 0, 'ESO' => 0, 'LCH' => 0, 'IIE' => 0, 'HWB' => 0);
                            $categoryEvents = array('TEC' => 0, 'ESO' => 0, 'LCH' => 0, 'IIE' => 0, 'HWB' => 0);

                            while ($row = $result->fetch_assoc()) {
                                $categoryPoints[$row['category']] += $row['points'];
                                $categoryEvents[$row['category']] += 1;
                            }

                            foreach ($categoryPoints as $category => $points) {
                                echo "<tr>
                                        <td>$category</td>
                                        <td>{$categoryEvents[$category]}</td>
                                        <td>$points / 200</td>
                                        <td>".($points/2)."%</td>
                                    </tr>";
                            }

                            $totalPoints = array_sum($categoryPoints);
                            $totalPercentage = ($totalPoints / 1000) * 100;
                        
                            echo "<tr>
                                    <td>Total</td>
                                    <td>".array_sum($categoryEvents)."</td>
                                    <td class='highlight_in_table'>$totalPoints / 1000</td>
                                    <td class='highlight_in_table'>$totalPercentage%</td>
                                </tr>";

                        echo "</table>";

                        $result->data_seek(0);

                        echo "<h3>Events Attended by $username</h3>";
                        echo "<table class='events-attended'>";
                            echo "<tr>
                                    <th>Sno</th>
                                    <th>Event Name</th>
                                    <th>Club Name</th>
                                    <th>Category</th>
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
                                        <td>{$row['date_of_participation']}</td>
                                        <td>{$row['time_slot']}</td>
                                        <td>{$row['points']}</td>
                                    </tr>";
                                    $sno++;
                                }

                        echo "</table>";
                    echo "</div>";
                } else {
                    echo "<p class='no_participation'>No participation records found for $username.<br><span>In case of any discrepancies, please fill the grievances form</span></p>";
                }
                $stmt->close();
            }

            $conn->close();
            ?>
        </div>

    </div>

    <footer>
        <p>Designed and Developed by ZeroOne Code Club. All rights reserved</p>
    </footer>

</body>
</html>
