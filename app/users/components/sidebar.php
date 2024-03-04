<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        <?php include "nav.css" ?>
    </style>
    <title>Sidebar</title>
</head>
<body>
    <?php

        $userRole = 'Student';
    ?>

    <div class="sidebar">
        <div class="sidebar-in">
            <?php if ($userRole === 'Student') { ?>
                <!-- accessible by student -->
                <div class="sidebar-in-link">
                    <a href="./template_update_profile.php">Update Profile</a>
                </div>

                <!-- accessible by student -->
                <div class="sidebar-in-link">
                    <a href="./template_update_academic_profile.php">Update Academic Profile</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="./template_view_clubs.php">View Clubs</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="#" onclick="toggleDropdown()">Social Internship</a>
                    <div class="dropdown-links">
                        <a href="./template_social_internship_register.php"><li>Internship Registration</li></a>
                        <a href="./template_view_attendance.php"><li>Attendance Register</li></a>
                    </div>
                </div>

                <div class="sidebar-in-link">
                    <a href="./template_submit_grievance.php">Student Grievances</a>
                </div>


            <?php } elseif ($userRole === 'Admin') { ?>


                <div class="sidebar-in-link">
                    <a href="./template_update_academic_profile.php">Update Academic Profile</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="./template_update_academic_profile.php">Manage Users</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="../admin/social_internship/post_attendance.php"><li>Attendance Submissions</li></a>
                </div>
                <div class="sidebar-in-link">
                    <a href="../admin/social_internship/post_attendance.php"><li>Attendance Submissions</li></a>
                </div>
                <div class="sidebar-in-link">
                    <a href="../admin/social_internship/post_attendance.php"><li>Manage Categoties</li></a>
                </div>
                <div class="sidebar-in-link">
                    <a href="../admin/social_internship/post_attendance.php"><li>Manage Clubs</li></a>
                </div>

            <?php } ?>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            var dropdown = document.querySelector('.dropdown-links');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }
    </script>
</body>
</html>
