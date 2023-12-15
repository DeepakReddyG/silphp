<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Grievance</title>
</head>
<body>
    <h2>Add Grievance</h2>

    <form action="process_grievance.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="issue_type">Issue Type:</label>
        <select id="issue_type" name="issue_type" required>
            <option value="attendance">Attendance</option>
            <option value="points">Points</option>
            <option value="discipline">Discipline</option>
            <option value="others">Others</option>
        </select><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Submit Grievance">
    </form>
</body>
</html>
