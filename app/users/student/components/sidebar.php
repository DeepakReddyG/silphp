<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        <?php include "nav.css" ?>
    </style>

    <style>
       
    </style>
    <title>Sidebar</title>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-in">
            <div class="sidebar-in-link">
                <a href="./template_update_profile.php">Update Profile</a>
            </div>
            <div class="sidebar-in-link">
                <a href="./template_update_academic_profile.php">Update Academic Profile</a>
            </div>
            <div class="sidebar-in-link">
                <a href="#" onclick="toggleDropdown()">Social Internship</a>
                <!-- Add the dropdown links within a container div -->
                <div class="dropdown-links">
                    <a href="./template_social_internship_register.php"><li>Internship Registration</li></a>
                    <a href="#"><li>Attendance Register</li></a>
                    <a href="#"><li>Internship Submissions</li></a>
                </div>
            </div>
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
