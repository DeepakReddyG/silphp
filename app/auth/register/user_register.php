<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Include your CSS stylesheets or link to a CSS file here -->
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .success {
        color: #4caf50;
        margin-top: 10px;
    }

    .error {
        color: #ff3333;
        margin-top: 10px;
    }
    </style>

    <script>
        // Function to generate email based on username
        function generateEmail() {
            var username = document.getElementById("username").value;
            var emailField = document.getElementById("email");

            // Assuming the email domain is always 'kluniversity.in'
            var email = username + "@kluniversity.in";
            emailField.value = email;
        }
    </script>
</head>
<body>

<?php
include_once('../../database/dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the script for processing registration
    include_once('process_user_register.php');
}
?>

<!-- Display registration status here -->
<?php if (isset($registrationStatus)) : ?>
    <div class="<?php echo $registrationStatus['class']; ?>">
        <?php echo $registrationStatus['message']; ?>
    </div>
<?php endif; ?>

<!-- Your registration form goes here -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <!-- Include your form fields here -->
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" oninput="generateEmail()" required>

    <label for="name">Name:</label>
    <input type="text" name="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Register</button>
</form>

<a href="../login/user_login.php"></a>
<!-- Include your JavaScript for displaying toasts here if needed -->

</body>
</html>
