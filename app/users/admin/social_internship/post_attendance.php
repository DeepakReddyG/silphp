<?php
// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../database/dbconn.php');

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Fetch users and their attendance data
$query = "SELECT users.id AS user_id, users.username, social_internship_attendance.*
          FROM users
          LEFT JOIN social_internship_attendance ON users.id = social_internship_attendance.user_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Loop through submitted data to update attendance
    foreach ($_POST['attendance'] as $user_id => $attendance) {
        // Update the attendance status for each day
        $update_query = "UPDATE social_internship_attendance
                         SET day_one_attendance_status = '$attendance[day_one]',
                             day_two_attendance_status = '$attendance[day_two]',
                             day_three_attendance_status = '$attendance[day_three]',
                             day_four_attendance_status = '$attendance[day_four]',
                             day_five_attendance_status = '$attendance[day_five]',
                             day_six_attendance_status = '$attendance[day_six]',
                             day_seven_attendance_status = '$attendance[day_seven]',
                             day_eight_attendance_status = '$attendance[day_eight]',
                             day_nine_attendance_status = '$attendance[day_nine]',
                             day_ten_attendance_status = '$attendance[day_ten]'
                         WHERE user_id = $user_id";
        $update_result = mysqli_query($conn, $update_query);

        // Check if the update was successful
        if (!$update_result) {
            echo "Error updating attendance: " . mysqli_error($conn);
            exit();
        }
    }

    // Redirect to the same page after updating
    header("Location: post_attendance.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Update Attendance</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        form {
            margin: 10px;
        }
        <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        form {
            margin: 10px;
        }
        .present {
            background-color: green;
            color: white;
        }
        .absent {
            background-color: red;
            color: white;
        }
    </style>
    </style>
</head>
<body>
    <h2>Admin - Update Social Internship Attendance</h2>
    <form method="post" action="">
        <table>
            <tr>
                <th>User ID</th>
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
                <th>Day 10</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['username']; ?></td>

                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_one]">
                        <option value="Present" <?php if ($row['day_one_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_one_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>
                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_two]">
                        <option value="Present" <?php if ($row['day_two_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_two_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>
                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_three]">
                        <option value="Present" <?php if ($row['day_three_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_three_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>
                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_four]">
                        <option value="Present" <?php if ($row['day_four_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_four_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>
                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_five]">
                        <option value="Present" <?php if ($row['day_five_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_five_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>
                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_six]">
                        <option value="Present" <?php if ($row['day_six_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_six_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>
                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_seven]">
                        <option value="Present" <?php if ($row['day_seven_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_seven_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>
                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_eight]">
                        <option value="Present" <?php if ($row['day_eight_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_eight_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>
                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_nine]">
                        <option value="Present" <?php if ($row['day_nine_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_nine_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>
                    <td><select name="attendance[<?php echo $row['user_id']; ?>][day_ten]">
                        <option value="Present" <?php if ($row['day_ten_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                        <option value="Absent" <?php if ($row['day_ten_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                    </select></td>

                </tr>
                <?php
            }
            ?>
        </table>
        <button type="submit">Update Attendance</button>
    </form>
</body>
</html>
