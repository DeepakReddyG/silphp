<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="./user_register.css">
    <script>
        function generateEmail() {
            var username = document.getElementById("username").value;
            var emailField = document.getElementById("email");
            var email = username + "@kluniversity.in";
            emailField.value = email;
        }
    </script>
</head>
<body>

<?php
include_once('../../database/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the script for processing registration
    include_once('process_user_register.php');
}
?>



<div class="register-form">
    <div class="register-form-in">
        
        <div class="register-form-in-one">
            <div class="register-form-in-one-in">
                <img src="../../assets/Launch.png" alt="">
            </div>
        </div>
        <div class="register-form-in-two">
            <div class="register-form-in-two-alert">
                <?php if (isset($registrationStatus)) : ?>
                    <div class="<?php echo $registrationStatus['class']; ?>">
                        <?php echo $registrationStatus['message']; ?>
                    </div>
                <?php endif; ?>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="register-form-in-two-form-in">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" oninput="generateEmail()" required>
                    <label for="name">Name:</label>
                    <input type="text" name="name" required>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                    <label for="password">Password:</label>
                    <input type="password" name="password" required>
                    <label for="confirm_password">Confirm Password:</label>
                    <button type="submit">Register</button>
                    <a href="../login/user_login.php">Already a registered user?</a>
                </div>    
            </form>
        </div>
    </div>
    <div class="register-form-footer">
        <p>© 2024, Student Activity Center, K L Deemed to be University. All rights reserved.</p>
    </div>
</div>


</body>
</html>
