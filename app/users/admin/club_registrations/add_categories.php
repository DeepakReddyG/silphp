<?php
// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start or resume session
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: /path/to/login.php");
    exit();
}

include_once('../../../database/dbconn.php');

$categoryName = '';
$categoryDescription = '';
$successMessage = '';
$errorMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $categoryName = mysqli_real_escape_string($conn, $_POST['category_name']);
    $categoryDescription = mysqli_real_escape_string($conn, $_POST['category_description']);

    // Insert data into club_categories table
    $query = "INSERT INTO club_categories (category_name, category_description) VALUES ('$categoryName', '$categoryDescription')";

    if (mysqli_query($conn, $query)) {
        $successMessage = "Category added successfully!";
        // Clear form fields after successful submission
        $categoryName = $categoryDescription = '';
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
    <title>Add Categories</title>
</head>
<body>

<h2>Add Categories</h2>

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
    <label for="category_name">Category Name:</label>
    <input type="text" name="category_name" value="<?php echo htmlspecialchars($categoryName); ?>" required><br>

    <label for="category_description">Category Description:</label>
    <textarea name="category_description" required><?php echo htmlspecialchars($categoryDescription); ?></textarea><br>
    <input type="submit" value="Add Category">

    <a href="../../student/club_registrations/view_categories.php">View Categories</a>
</form>

</body>
</html>
