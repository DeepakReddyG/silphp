<?php
// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    header("Location: /path/to/login.php");
    exit();
}

include_once('../../database/dbconn.php');

// Fetch distinct club categories from the database
$categoryQuery = "SELECT DISTINCT category_name FROM club_categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Check if any categories are retrieved
if (mysqli_num_rows($categoryResult) > 0) {
    $categories = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);
} else {
    $categories = [];
}

// Fetch clubs from the database based on the selected category
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
$filterCondition = $selectedCategory ? "WHERE club_categories.category_name = '$selectedCategory'" : '';
$query = "SELECT clubs.id, clubs.club_name, clubs.club_logo, club_categories.category_name, clubs.club_domain, clubs.club_description, clubs.club_head, clubs.created_at FROM clubs
          INNER JOIN club_categories ON clubs.club_category = club_categories.id $filterCondition";
$result = mysqli_query($conn, $query);

// Check if any clubs are retrieved
if (mysqli_num_rows($result) > 0) {
    $clubs = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $clubs = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Clubs</title>
    <style>
        <?php include "view_clubs.css" ?>
    </style>
</head>
<body>

<div class="view-clubs">
    <div class="view-clubs-in">
        <div class="common-main-heading">
            <div class="common-main-heading-in">
                <h1>View Clubs</h1>
            </div>
        </div>
    </div>
</div>

<div class="filter-form">
    <form id="filterForm" action="" method="get">
        <select name="category" id="category">
            <option value="">All Categories</option>
            <?php
            foreach ($categories as $category) {
                echo '<option value="' . $category['category_name'] . '" ' . ($selectedCategory === $category['category_name'] ? 'selected' : '') . '>' . $category['category_name'] . '</option>';
            }
            ?>
        </select>
    </form>
</div>

<script>
    document.getElementById('category').addEventListener('change', function () {
        document.getElementById('filterForm').submit();
    });
</script>

<div class="view-clubs-table">
    <div class="view-clubs-table-in">
        <div class="view-clubs-table-in-body">
            <?php
            if (!empty($clubs)) {
                echo '<table>';
                echo '<thead><tr><th>ID</th><th>Club Name</th><th>Category

                
                </th><th>Club Domain</th><th>Club Head</th></thead>';
                echo '<tbody>';
                foreach ($clubs as $club) {
                    echo '<tr>';
                    echo '<td>' . $club['id'] . '</td>';
                    echo '<td>' . $club['club_name'] . '</td>';
                    // echo '<td><img src="' . $club['club_logo'] . '" alt="' . $club['club_name'] . '" style="max-width: 100px; max-height: 100px;"></td>';
                    echo '<td>' . $club['category_name'] . '</td>';
                    echo '<td>' . $club['club_domain'] . '</td>';
                    // echo '<td>' . $club['club_description'] . '</td>';
                    echo '<td>' . $club['club_head'] . '</td>';
                    // echo '<td>' . $club['created_at'] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No clubs found.</p>';
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
