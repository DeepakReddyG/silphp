<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../../database/dbconn.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../users/student/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grievance_title = filter_input(INPUT_POST, 'grievance_title', FILTER_SANITIZE_STRING);
    $grievance_description = filter_input(INPUT_POST, 'grievance_description', FILTER_SANITIZE_STRING);

    if ($grievance_title && $grievance_description) {
        $insertQuery = "INSERT INTO grievances (user_id, grievance_title, grievance_description) 
                        VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'iss', $user_id, $grievance_title, $grievance_description);
            $success = mysqli_stmt_execute($stmt);

            if ($success) {
                $message = "Grievance submitted successfully!";
            } else {
                $error = "Error submitting grievance: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            $error = "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Grievance</title>

</head>
<body>
    <h2>Submit a Grievance</h2>

    <?php
    if (isset($message)) {
        echo "<p style='color: green;'>$message</p>";
    }

    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

<form method="POST" action="../../users/student/grievances/submit_grievance.php">

        <label for="grievance_title">Grievance Title:</label>
        <input type="text" name="grievance_title" required>

        <br>

        <label for="grievance_description">Grievance Description:</label>
        <textarea name="grievance_description" required></textarea>

        <br>

        <button type="submit">Submit Grievance</button>
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>
