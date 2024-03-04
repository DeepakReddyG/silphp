<?php
// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: /path/to/login.php");
    exit();
}

include_once('../../../database/dbconn.php');

$clubName = '';
$clubLogo = '';
$clubCategory = '';
$clubDomain = '';
$clubDescription = '';
$clubHead = '';
$successMessage = '';
$errorMessage = '';

// Fetch club categories for dropdown
$queryCategories = "SELECT * FROM club_categories";
$resultCategories = mysqli_query($conn, $queryCategories);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $clubName = mysqli_real_escape_string($conn, $_POST['club_name']);
    $clubLogo = mysqli_real_escape_string($conn, $_POST['club_logo']);
    $clubCategory = mysqli_real_escape_string($conn, $_POST['club_category']);
    $clubDomain = mysqli_real_escape_string($conn, $_POST['club_domain']);
    $clubDescription = mysqli_real_escape_string($conn, $_POST['club_description']);
    $clubHead = mysqli_real_escape_string($conn, $_POST['club_head']);

    // Insert data into clubs table
    $query = "INSERT INTO clubs (club_name, club_logo, club_category, club_domain, club_description, club_head) VALUES ('$clubName', '$clubLogo', '$clubCategory', '$clubDomain', '$clubDescription', '$clubHead')";

    if (mysqli_query($conn, $query)) {
        $successMessage = "Club added successfully!";
        // Clear form fields after successful submission
        $clubName = $clubLogo = $clubDomain = $clubDescription = $clubHead = '';
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Clubs</title>
</head>
<body>

<h2>Add Clubs</h2>

<?php
// Display success message if exists
if (!empty($successMessage)) {
    echo '<p style="color: green;">' . $successMessage . '</p>';
}

// Display error message if exists
if (!empty($errorMessage)) {
    echo '<p style="color: red;">' . $errorMessage . '</p>';
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="club_name">Club Name:</label>
    <input type="text" name="club_name" value="<?php echo htmlspecialchars($clubName); ?>" required><br>

    <label for="club_logo">Club Logo URL:</label>
    <input type="text" name="club_logo" value="<?php echo htmlspecialchars($clubLogo); ?>" required><br>

    <label for="club_category">Club Category:</label>
    <select name="club_category" required>
        <?php
        while ($category = mysqli_fetch_assoc($resultCategories)) {
            echo '<option value="' . $category['id'] . '">' . $category['category_name'] . '</option>';
        }
        ?>
    </select><br>

    <label for="club_domain">Club Domain:</label>
    <input type="text" name="club_domain" value="<?php echo htmlspecialchars($clubDomain); ?>" required><br>

    <label for="club_description">Club Description:</label>
    <textarea name="club_description" required><?php echo htmlspecialchars($clubDescription); ?></textarea><br>

    <label for="club_head">Club Head:</label>
    <input type="text" name="club_head" value="<?php echo htmlspecialchars($clubHead); ?>" required><br>

    <input type="submit" value="Add Club">

    <a href="../../student/club_registrations/view_clubs.php">View Clubs</a>
</form>

</body>
</html>
