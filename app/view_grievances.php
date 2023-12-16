<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Grievances</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>View Grievances</h2>

    <form action="" method="get">
        <label for="filterIssueType">Filter by Issue Type:</label>
        <select id="filterIssueType" name="filterIssueType">
            <option value="">All</option>
            <option value="attendance">Attendance</option>
            <option value="points">Points</option>
            <option value="discipline">Discipline</option>
            <option value="others">Others</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <?php
    require_once 'dbconn.php';

    // Filter by issue type if selected
    $filterIssueType = isset($_GET['filterIssueType']) ? $_GET['filterIssueType'] : '';

    // Build the SQL query based on the filter
    $sql = "SELECT * FROM grievances";
    if (!empty($filterIssueType)) {
        $sql .= " WHERE issue_type = '$filterIssueType'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display the grievances in a table
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Username</th>
                <th>Issue Type</th>
                <th>Description</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['issue_type']}</td>
                    <td>{$row['description']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No grievances found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
