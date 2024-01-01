<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


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
                            <?php include_once 'admin_sidebar.php'; ?>
                    </div>
                    <div class="template-two-in-two">

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
