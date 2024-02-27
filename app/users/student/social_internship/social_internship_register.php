<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../../../database/dbconn.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in

    exit();
}

$user_id = $_SESSION['user_id'];

// Alert message variables
$alertMessage = '';
$alertType = '';

// Check if the registration status is set in the URL (from process_social_internship_register.php)
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    
    // Set alert message based on the status
    if ($status == 'success') {
        $alertMessage = 'Registration successful!';
        $alertType = 'success';
    } elseif ($status == 'already_registered') {
        $alertMessage = 'You have already registered for the internship.';
        $alertType = 'warning';
    } else {
        $alertMessage = 'Registration failed. Please try again.';
        $alertType = 'danger';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Internship Registration</title>
    <!-- Add your CSS styling for alerts here -->
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-warning {
            color: #8a6d3b;
            background-color: #fcf8e3;
            border-color: #faebcc;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>
<body>

    <h2>Social Internship Registration</h2>
    <!-- display username -->
    <p><?php echo $_SESSION['username']; ?>!</p>

    <!-- Display alert if set -->
    <?php if ($alertMessage): ?>
        <div class="alert alert-<?php echo $alertType; ?>">
            <?php echo $alertMessage; ?>
        </div>
    <?php endif; ?>

    <form action="social_internship/process_social_internship_register.php" method="POST">
        <label for="internship_domain">Internship Domain:</label>
        <input type="text" name="internship_domain" required>
        <button type="submit">Submit</button>
    </form>

</body>
</html>
