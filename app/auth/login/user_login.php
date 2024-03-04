<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./user_login.css">
</head>
<body>

<?php
include_once('../../database/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('process_user_login.php');
}
?>





<div class="login-form">
    
    <div class="login-form-in">

        <div class="login-form-in-one">
            <div class="login-form-alert">
                <?php if (isset($loginError)) : ?>
                    <div class="error">
                        <?php echo $loginError; ?>
                    </div>
                <?php endif; ?>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                    <div class="login-form-in-one-form-in">
                        <label for="username">Username:</label>
                        <input type="text" name="username" placeholder="Registered ID Number" required title="Username must be exactly 10 characters long">

                        <label for="password">Password:</label>
                        <input type="password" name="password" required>
                        <button type="submit" name="login">Login</button>

                        <a href="../register/user_register.php">Not a registered user?</a>
                        <a href="../forgot_password/user_forgot_password.php">Forgot password?</a>
                    </div>

            </form>
        </div>

        <div class="login-form-in-two">
            <div class="login-form-in-two-in">
                <img src="../../assets/Frame.jpg" alt="">
            </div>
        </div>
    </div>

        <div class="login-form-footer">
            <p>© 2024, Student Activity Center, K L Deemed to be University. All rights reserved.</p>
        </div>

</div>


</body>
</html>
