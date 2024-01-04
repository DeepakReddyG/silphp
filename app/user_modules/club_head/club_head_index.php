<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once __DIR__ . '/../../dbconn.php';

// Fetch club name based on club_id
$clubName = '';

if (isset($_SESSION['club_id'])) {
    $selectClubQuery = "SELECT name FROM clubs WHERE id = ?";
    
    $stmtClub = $conn->prepare($selectClubQuery);
    $stmtClub->bind_param("i", $_SESSION['club_id']);
    $stmtClub->execute();

    $resultClub = $stmtClub->get_result();

    if ($resultClub->num_rows > 0) {
        $club = $resultClub->fetch_assoc();
        $clubName = $club['name'];
    }

    $stmtClub->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin_index.css">
    <link rel="stylesheet" href="../../common_styling.css">
</head>
<body>
    <div class="template">
        <div class="template-in">
            <div class="template-one">
                <div class="template-one-in">
                    <div class="template-one-in-one">
                        <h1>Student Activity Center Student Central</h1>
                    </div>
                    <div class="template-one-in-two">
                    </div>
                    <div class="templae-one-in-three">
                        <p><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'user not found'; ?></p>
                        <?php if (isset($_SESSION['username'])) : ?>
                            <a id='logout-button' href="../../auth/logout.php">Logout</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="template-two">
                <div class="template-two-in">
                    <div class="template-two-in-one">
                            <?php include_once 'club_head_sidebar.php'; ?>
                    </div>
                    <div class="template-two-in-two">
                            <?php echo $clubName ? "<p class='template-two-in-two-p'>Club Head  $clubName</p>" : ''; ?>
                    </div>
                </div>
            </div>
            <div class="template-three">
                <div class="template-three-in">
                    <div class="Footer">
                        <div class="Footer-in">
                            <p>Designed and Developed by <a href="#">Deepak Reddy Gathpa</a>. All rights reserved by KLSAC</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.toggle-sub').click(function () {
                // Toggle visibility of the sub-box
                $(this).siblings('.template-two-in-one-box-in-sub').toggle();
            });
        });
    </script>
</body>
</html>
