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

        $userRole = $_SESSION['user_type'];
    ?>

    <div class="sidebar">
        <div class="sidebar-in">
            <?php if ($userRole === 'Student') { ?>
                <div class="sidebar-in-link">
                    <a href="./template_update_profile.php">Update Profile</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="./template_update_academic_profile.php">Update Academic Profile</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="#" onclick="toggleDropdown()">SAC Clubs</a>
                    <div class="dropdown-links-one dropdown-links">
                        <a href="./template_view_clubs.php"><li>View Clubs</li></a>
                        <a href="./template_view_attendance.php"><li>Club Registration</li></a>
                    </div>
                </div>

                <div class="sidebar-in-link">
                    <a href="#" onclick="toggleDropdownTwo()">Social Internship</a>
                    <div class="dropdown-links-two dropdown-links">
                        <a href="./template_social_internship_register.php"><li>Internship Registration</li></a>
                        <a href="./template_view_attendance.php"><li>Attendance Register</li></a>
                    </div>
                </div>

                <div class="sidebar-in-link">
                    <a href="./template_submit_grievance.php">Student Grievances</a>
                </div>





        
            <?php } else if ($userRole === 'Admin') { ?>

                <div class="sidebar-in-link">
                    <a href="../admin/dashboard/dashboard.php">Dashboard</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="../student/template_update_profile.php">Update Profile</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="../student/template_update_academic_profile.php">Update Academic Profile</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="../admin/template_manage_users.php">Manage Users</a>
                </div>
                <div class="sidebar-in-link">
                    <a href="../admin/template_manage_si_attendance.php">Manage SI Attendance</a>
                </div>

            
                <div class="sidebar-in-link">
                    <a href="../admin/dashboard/dashboard.php">Manage Clubs</a>
                </div>
                <div class="sidebar-in-link">
                    <a href="../admin/dashboard/dashboard.php">Club Categories</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="../admin/dashboard/dashboard.php">Activities Catelog</a>
                </div>

                <div class="sidebar-in-link">
                    <a href="../admin/dashboard/dashboard.php">View Reports</a>
                </div>
                <div class="sidebar-in-link">
                    <a href="../admin/dashboard/dashboard.php">Student Council</a>
                </div>
                <div class="sidebar-in-link">
                    <a href="../admin/dashboard/dashboard.php">Logistics</a>
                </div>
            

            <?php } ?>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            var dropdown = document.querySelector('.dropdown-links');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }

        function toggleDropdownTwo() {
            var dropdown = document.querySelector('.dropdown-links-two');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }

    </script>
</body>
</html>
