<?php
// Start or resume session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or display an error message
    header("Location: /path/to/login.php");
    exit();
}

// Include database connection file
include_once('../../../database/dbconn.php');

// Fetch categories from the database
$query = "SELECT * FROM club_categories";
$result = mysqli_query($conn, $query);

// Check if any categories are retrieved
if (mysqli_num_rows($result) > 0) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $categories = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Categories</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Display Categories</h2>

<?php
// Check if there are categories to display
if (!empty($categories)) {
    echo '<table>';
    echo '<thead><tr><th>ID</th><th>Category Name</th><th>Category Description</th><th>Created At</th></tr></thead>';
    echo '<tbody>';
    foreach ($categories as $category) {
        echo '<tr>';
        echo '<td>' . $category['id'] . '</td>';
        echo '<td>' . $category['category_name'] . '</td>';
        echo '<td>' . $category['category_description'] . '</td>';
        echo '<td>' . $category['created_at'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No categories found.</p>';
}

?>

</body>
</html>
