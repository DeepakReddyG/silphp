<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Internship Attendance</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./social_internship_attendance.css">
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
                <a href="./social_internship.php">Social Internship</a>
            </div>
        </div>
    </div>


    <div class="main-content">
        <div class="attendance-table">
            <?php
                require_once 'dbconn.php';
                $sql = "SELECT * FROM social_internship_attendance";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                echo "<table>
                    <tr>
                        <th>Sno</th>
                        <th>Username</th>
                        <th>Day 1</th>
                        <th>Day 2</th>
                        <th>Day 3</th>
                        <th>Day 4</th>
                        <th>Day 5</th>
                        <th>Day 6</th>
                        <th>Day 7</th>
                        <th>Day 8</th>
                        <th>Day 9</th>
                        <th>Domain</th>
                    </tr>";

                while ($row = $result->fetch_assoc()) {
                
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>";

                            for ($i = 1; $i <= 9; $i++) {
                            $dayValue = $row["day_$i"];
                            $colorClass = '';
                            switch ($dayValue) {
                                case 'Present':
                                        $colorClass = 'Present';
                                        break;
                                case 'Absent':
                                        $colorClass = 'Absent';
                                        break;
                                case 'NA':
                                        $colorClass = 'NA';
                                        break;
                                    
                            }
                            echo "<td class='$colorClass'>$dayValue</td>";
                }

                echo "<td>{$row['domain']}</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No data available in the social internship attendance.";
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
