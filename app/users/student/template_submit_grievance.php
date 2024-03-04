<?php
// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    <title>Academic Profile</title>
    <link rel="stylesheet" href="./student_index.css">
    <link rel="stylesheet" href="./components/nav.css">
</head>
<body>
   <div class="container">
        <div class="nav">
            <?php include '../components/navbar.php'; ?>
        </div>

        <div class="container-in">
            <div class="container-in-one">
                <?php include '../components/sidebar.php'; ?>
            </div>
            <div class="container-in-two">
                <div class="container-in-two-in">
                    <div class="container-in-two-in-one">
                        <ul class="breadcrumb">
                            <li><a href="#">Student</a></li>
                            <li><a href="#">Academic Profile Update</a></li>
                        </ul>
                    </div>
                    <div class="container-in-two-in-two">
                        <?php include './grievances/submit_grievance.php'; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <?php include '../components/footer.php'; ?>
        </div>
   </div>
</body>
</html>
