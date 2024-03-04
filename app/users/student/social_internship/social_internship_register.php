<?php
// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../database/dbconn.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$check_query = "SELECT * FROM social_internship_registration WHERE user_id = $user_id";
$check_result = mysqli_query($conn, $check_query);

// Check if the user has already registered
if (mysqli_num_rows($check_result) > 0) {
    $already_registered_message = "You have already registered for an internship domain.";
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $internship_domain = mysqli_real_escape_string($conn, $_POST['internship_domain']);

    // Check if the user has already registered before processing the form
    if (empty($already_registered_message)) {
        $insert_query = "INSERT INTO social_internship_registration (user_id, internship_domain) VALUES ($user_id, '$internship_domain')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            $registration_success_message = "Registration successful!";
        } else {
            $registration_error_message = "Error: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Internship Registration</title>
    <style>
        form {
            width: 50%;
            margin: 20px;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        button {
            padding: 10px;
        }
    </style>
</head>
<body>

        <div class="common-main-heading">
            <div class="common-main-heading-in">
                <h1>Social Internship Registration</h1>
            </div>
        </div>

        

    <?php
    if (isset($already_registered_message)) {
        echo "<p>$already_registered_message</p>";
    }

    if (isset($registration_success_message)) {
        echo "<p>$registration_success_message</p>";
    }

    if (isset($registration_error_message)) {
        echo "<p>$registration_error_message</p>";
    }
    ?>

    <form method="post" action="">
        <label for="internship_domain">Internship Domain:</label>
        <select id="internship_domain" name="internship_domain" required>
            <option value="Education">Education</option>
            <option value="Healthcare">Healthcare</option>
            <option value="Environment">Environment</option>
            <option value="Community Development">Community Development</option>
        </select>

        <?php
        // Display the form only if the user hasn't already registered
        if (empty($already_registered_message)) {
        ?>
        <button type="submit">Register</button>
        <?php } ?>
    </form>
</body>
</html>
