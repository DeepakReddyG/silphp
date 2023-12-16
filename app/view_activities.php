<?php
require_once 'dbconn.php';

// Mapping of full category names to short forms
$categoryMapping = [
    "Extension Activities and Social Outreach Activities (ESO)" => "ESO",
    "Liberal Arts, Creative Arts and Hobby Clubs (LCH)" => "LCH",
    "Technology Events through central level clubs (TEC)" => "TEC",
    "Innovation, Incubation & Entrepreneurship (IIE)" => "IIE",
    "Health & Well Being (HWB)" => "HWB",
];

// Filter by category if selected
$filterCategory = isset($_GET['filterCategory']) ? $_GET['filterCategory'] : '';

// Build the SQL query based on the filter
$sql = "SELECT * FROM activities";
if (!empty($filterCategory)) {
    $sql .= " WHERE category = '$filterCategory'";
}

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Activities</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            background-color: rgb(151, 0, 3);
            color: #fff;
            margin: 0;
            padding: 0rem 2rem;
        }
        .nav-one {
            width: 50%;
            display: flex;
            align-items: center;
        }
        .nav-one h2 {
            color: white;
            font-size: 1.5rem;
        }
        .nav-two {
            width: 50%;
            text-align: right;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        .nav-two a {
            color: #fff;
            text-decoration: none;
            margin: 0rem 0.5rem;
            font-family: Arial, sans-serif;
        }

        .formdiv {
            width: fit-content;
            border: 1px solid black;
            margin: 2rem auto;
        }

        .participants_div {
            width: 90%;
            margin: auto;
        }

       

        
        .participants_div table tr:hover {
            background-color: lightgrey;
        }

        th {
            background-color: black;
            color: white;
        }

        .events-attended-table table {
            border-collapse: collapse;
            margin-top: 1rem;
            border: 2px solid black;
            width: 100%;
        }
        .events-attended-table table tr th {
            background-color: #4b1e3e;
            padding: 7px;
            border: 1px solid grey;
        }
        .events-attended-table table tr td {
            border: 1px solid black;
            text-align: center;
            padding: 0.3rem;
            background-color: white;
        }
        .events-attended-table table tr td:nth-child(1) {
            width: 3%;
        }
        .events-attended-table table tr td:nth-child(2) {
            width: 27%;
        }
        .events-attended-table table tr td:nth-child(3) {
            width: 13%;
        }
        .events-attended-table table tr td:nth-child(4) {
            width: 10%;
        }
        .events-attended-table table tr td:nth-child(5) {
            width: 10%;
        }
        .events-attended-table table tr td:nth-child(6) {
            width: 10%;
        }
        .events-attended-table table tr td:nth-child(7) {
            width: 15%;
        }
        .events-attended-table table tr td:nth-child(8) {
            width: 7%;
        }
                .category-ESO { background-color: #FFD700; } /* Yellow */
        .category-LCH { background-color: #00FFFF; } /* Cyan */
        .category-TEC { background-color: #FF6347; } /* Tomato */
        .category-IIE { background-color: #8A2BE2; } /* Blue Violet */
        .category-HWB { background-color: #32CD32; } /* Lime Green */
    </style>
</head>
<body>
        <div class="nav">
            <div class="nav-one">
                <h2>Student Activity Center | Activities Portal</h2>
            </div>
            <div class="nav-two">
                <a href="./index.php">Home</a>
                <a href="./leaderboard.php">Leaderboard</a>
                <a href="./view_activities.php">View Activities</a>
                <a href="./add_grievance.php">Grievances</a>
                <a href="./admin.php">Admin</a>
            </div>
        </div>

    <?php
    if ($result->num_rows > 0) {
        echo "<div class='participants_div events-attended-table'>";
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Club Name</th>
                <th>Category</th>
                <th>Organized On</th>
                <th>Venue</th>
                <th>Time Slot</th>
                <th>Points</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            // Get the short form of the category from the mapping
            $shortCategory = isset($categoryMapping[$row['category']]) ? $categoryMapping[$row['category']] : $row['category'];

            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['clubname']}</td>
                    <td>{$shortCategory}</td>
                    <td>{$row['organized_on']}</td>
                    <td>{$row['venue']}</td>
                    <td>{$row['time_slot']}</td>
                    <td>{$row['points']}</td>
                  </tr>";
        }

        echo "</table>";
        echo "</div>";
    } else {
        echo "No activities found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
