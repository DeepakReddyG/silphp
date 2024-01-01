<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . '/../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $insertQuery = "INSERT INTO clubs (name, description, category) VALUES ('$name', '$description', '$category')";
    $insertResult = $conn->query($insertQuery);

    if (!$insertResult) {
        die("Error: " . $insertQuery . "<br>" . $conn->error);
    }

    header("Location: view_clubs.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Club</title>
    <link rel="stylesheet" href="add_club.css">
</head>
<body>

    <div class="add-club-form">
        <h1>Add New Club</h1>
        <form method="post" action="">
            <label for="name">Club Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="TEC">TEC</option>
                <option value="LCH">LCH</option>
                <option value="ESO">ESO</option>
                <option value="IIE">IIE</option>
                <option value="HWB">HWB</option>
            </select>

            <input type="submit" name="submit" value="Add Club">
        </form>
    </div>

</body>
</html>
