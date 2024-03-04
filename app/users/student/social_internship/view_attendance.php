<?php
// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../database/dbconn.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM social_internship_attendance WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

function getStatusColor($status) {
    switch ($status) {
        case 'Present':
            return 'rgb(0, 128, 0, 0.3)';
        case 'Absent':
            return 'rgb(255, 0, 0,0.3)';
        case 'Pending':
            return 'rgb(255, 165, 0, 0.3)';
        default:
            return ''; // You can set a default color here if needed
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <style>
        <?php include "view_attendance.css" ?>
    </style>
</head>
<body>
    <div class="common-main-heading">
        <div class="common-main-heading-in">
            <h1>Social Internship Attendance</h1>
        </div>
    </div>

    <div class="view-attendance">
        <table>
            <tr>
                <th>Day</th>
                <th>Day 1</th>
                <th>Day 2</th>
                <th>Day 3</th>
                <th>Day 4</th>
                <th>Day 5</th>
                <th>Day 6</th>
                <th>Day 7</th>
                <th>Day 8</th>
                <th>Day 9</th>
                <th>Day 10</th>
                <th>Attendance Percentage</th> <!-- New column -->
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <th>Attendance</th>
                    <td style="background-color: <?php echo getStatusColor($row['day_one_attendance_status']); ?>"><?php echo $row['day_one_attendance_status']; ?></td>
                    <td style="background-color: <?php echo getStatusColor($row['day_two_attendance_status']); ?>"><?php echo $row['day_two_attendance_status']; ?></td>
                    <td style="background-color: <?php echo getStatusColor($row['day_three_attendance_status']); ?>"><?php echo $row['day_three_attendance_status']; ?></td>
                    <td style="background-color: <?php echo getStatusColor($row['day_four_attendance_status']); ?>"><?php echo $row['day_four_attendance_status']; ?></td>
                    <td style="background-color: <?php echo getStatusColor($row['day_five_attendance_status']); ?>"><?php echo $row['day_five_attendance_status']; ?></td>
                    <td style="background-color: <?php echo getStatusColor($row['day_six_attendance_status']); ?>"><?php echo $row['day_six_attendance_status']; ?></td>
                    <td style="background-color: <?php echo getStatusColor($row['day_seven_attendance_status']); ?>"><?php echo $row['day_seven_attendance_status']; ?></td>
                    <td style="background-color: <?php echo getStatusColor($row['day_eight_attendance_status']); ?>"><?php echo $row['day_eight_attendance_status']; ?></td>
                    <td style="background-color: <?php echo getStatusColor($row['day_nine_attendance_status']); ?>"><?php echo $row['day_nine_attendance_status']; ?></td>
                    <td style="background-color: <?php echo getStatusColor($row['day_ten_attendance_status']); ?>"><?php echo $row['day_ten_attendance_status']; ?></td>
                    <td><?php echo calculateAttendancePercentage($row); ?>%</td> <!-- New column -->
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);

function calculateAttendancePercentage($row) {
    $presentCount = 0;
    $totalCount = 0;

    // Count present and total days
    foreach ($row as $key => $value) {
        if (strpos($key, 'day_') !== false && strpos($key, '_attendance_status') !== false) {
            $totalCount++;
            if ($value == 'Present') {
                $presentCount++;
            }
        }
    }

    // Calculate percentage
    if ($totalCount > 0) {
        return round(($presentCount / $totalCount) * 100, 2);
    } else {
        return 0;
    }
}
?>




