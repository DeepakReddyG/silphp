<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

include_once('../../database/dbconn.php');

$selectedCluster = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCluster = $_POST['cluster'];
}


$query = "SELECT users.id AS user_id, users.username, users.name, user_academic_profile.cluster, user_academic_profile.sil_section, social_internship_attendance.*
          FROM users
          LEFT JOIN social_internship_attendance ON users.id = social_internship_attendance.user_id
          LEFT JOIN user_academic_profile ON users.id = user_academic_profile.user_id
          WHERE users.user_type = 'Student'";
          
if (!empty($selectedCluster)) {
    $query .= " AND user_academic_profile.cluster = $selectedCluster";
}

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['attendance'] as $user_id => $attendance) {
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

    header("Location: post_attendance.php");
    exit();
}


mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Update Attendance</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        <?php include "post_attendance.css" ?>
    </style>
</head>
<body>
<div class="common-main-heading">
    <div class="common-main-heading-in">
        <h1> Update Social Internship Attendance</h1>
    </div>
</div>

<div class="post-attendance">
    <div class="post-attendance-in">

        <label for="">Select Day</label>
        <select name="day" id="day">
            <option value="day_one">Day 1</option>
            <option value="day_two">Day 2</option>
            <option value="day_three">Day 3</option>
            <option value="day_four">Day 4</option>
            <option value="day_five">Day 5</option>
            <option value="day_six">Day 6</option>
            <option value="day_seven">Day 7</option>
            <option value="day_eight">Day 8</option>
            <option value="day_nine">Day 9</option>
            <option value="day_ten">Day 10</option>
        </select>

        <form id="attendanceForm" method="post" action="">
            <table>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Cluster
                        <select name="cluster" id="cluster">
                        <option value="">All</option>
                        <option value="1" <?php if ($selectedCluster === '1') echo 'selected'; ?>>Cluster 1</option>
                        <option value="2" <?php if ($selectedCluster === '2') echo 'selected'; ?>>Cluster 2</option>
                    </select>
                    </th>
                    <th>SIL Section</th>
                    <th class="day_column" id="day_one">Day 1</th>
                    <!-- similarly create th for 10 days -->
                    <th class="day_column" id="day_two">Day 2</th>
                    <th class="day_column" id="day_three">Day 3</th>
                    <th class="day_column" id="day_four">Day 4</th>
                    <th class="day_column" id="day_five">Day 5</th>
                    <th class="day_column" id="day_six">Day 6</th>
                    <th class="day_column" id="day_seven">Day 7</th>
                    <th class="day_column" id="day_eight">Day 8</th>
                    <th class="day_column" id="day_nine">Day 9</th>
                    <th class="day_column" id="day_ten">Day 10</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['cluster']; ?></td>
                        <td><?php echo $row['sil_section']; ?></td>

                        <!-- Day columns -->
                        <td class="day_column" id="day_one">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_one]">
                                <option value="Present" <?php if ($row['day_one_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_one_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>
                        <td class="day_column" id="day_two">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_two]">
                                <option value="Present" <?php if ($row['day_two_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_two_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>
                        <td class="day_column" id="day_three">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_three]">
                                <option value="Present" <?php if ($row['day_three_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_three_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>
                        <td class="day_column" id="day_four">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_four]">
                                <option value="Present" <?php if ($row['day_four_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_four_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>

                        <td class="day_column" id="day_five">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_five]">
                                <option value="Present" <?php if ($row['day_five_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_five_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>

                        <td class="day_column" id="day_six">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_six]">
                                <option value="Present" <?php if ($row['day_six_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_six_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>

                        <td class="day_column" id="day_seven">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_seven]">
                                <option value="Present" <?php if ($row['day_seven_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_seven_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>

                        <td class="day_column" id="day_eight">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_eight]">
                                <option value="Present" <?php if ($row['day_eight_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_eight_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>

                        <td class="day_column" id="day_nine">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_nine]">
                                <option value="Present" <?php if ($row['day_nine_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_nine_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>

                        <td class="day_column" id="day_ten">
                            <select name="attendance[<?php echo $row['user_id']; ?>][day_ten]">
                                <option value="Present" <?php if ($row['day_ten_attendance_status'] === 'Present') echo 'selected'; ?>>Present</option>
                                <option value="Absent" <?php if ($row['day_ten_attendance_status'] === 'Absent') echo 'selected'; ?>>Absent</option>
                            </select>
                        </td>


                        </tr>
                    <?php
                }
                ?>
            </table>

            <button type="submit">Update Attendance</button>


        </form>

    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle change event of the day selection
        $('#day').change(function() {
            var selectedDay = $(this).val();

            // Hide all table day columns except the selected day
            $('table .day_column').hide();
            $('table .day_column#' + selectedDay).show();
        });

        // Trigger change event to initially show the first day's attendance
        $('#day').trigger('change');

        // Handle change event of the cluster selection
        $('#cluster').change(function() {
            $('#attendanceForm').submit(); // Submit the form on cluster change
        });
    });
</script>

</body>
</html>
