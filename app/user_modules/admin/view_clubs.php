<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . '/../../dbconn.php';

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

$selectQuery = "SELECT id, name, description, category, created_at FROM clubs";

if (!empty($categoryFilter)) {
    $selectQuery .= " WHERE category = '$categoryFilter'";
}

$result = $conn->query($selectQuery);

if (!$result) {
    die("Error: " . $selectQuery . "<br>" . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club List</title>
    <link rel="stylesheet" href="view_clubs.css">
</head>
<body>

    <div class="view-clubs-list">
        <div class="view-clubs-list-in">
            <div class="view-clubs-header">
                <div class="view-clubs-header-in">
                    <h1>List of Clubs</h1>
                </div>
            </div>
            <div class="view-clubs-list-one">
                <div class="view-clubs-list-one-pre">
                    <a href="./add_clubs.php" class="add-club-button">Add New Club</a>
                </div>
                <div class="view-clubs-list-one-in">
                    <table>
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category

                                <form method="get" action="">
                                    <select id="categoryFilter" name="category" onchange="this.form.submit()">
                                        <option value="" <?php echo empty($categoryFilter) ? 'selected' : ''; ?>>All</option>
                                        <option value="TEC" <?php echo ($categoryFilter == 'TEC') ? 'selected' : ''; ?>>TEC</option>
                                        <option value="LCH" <?php echo ($categoryFilter == 'LCH') ? 'selected' : ''; ?>>LCH</option>
                                        <option value="ESO" <?php echo ($categoryFilter == 'ESO') ? 'selected' : ''; ?>>ESO</option>
                                        <option value="IIE" <?php echo ($categoryFilter == 'IIE') ? 'selected' : ''; ?>>IIE</option>
                                        <option value="HWB" <?php echo ($categoryFilter == 'HWB') ? 'selected' : ''; ?>>HWB</option>
                                    </select>
                                </form>
                                </th>
                                <th>Created On</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $counter = 1; 
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                            $counter++;
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
