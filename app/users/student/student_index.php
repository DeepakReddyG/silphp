<?php
include_once('../../auth/session_checkup.php');

if ($_SESSION['user_type'] !== 'Student') {

    header("Location: ../../access_denied.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Include your CSS stylesheets or link to a CSS file here -->
</head>
<body>

<!-- Your student dashboard content goes here -->
<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<p>This is the student dashboard.</p>


<a href="./update_profile/update_profile.php">Update profile</a>

<a href="../../auth/logout/logout.php">Logout</a>


</body>
</html>
