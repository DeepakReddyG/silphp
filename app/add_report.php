<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Report</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <div class="nav">
        <!-- Your navigation bar code here -->
    </div>
    <h2>Add Report</h2>

    <form action="add_report_process.php" method="post" enctype="multipart/form-data">
        <label for="activity_name">Activity Name:</label>
        <input type="text" id="activity_name" name="activity_name" required>

        <label for="club_name">Club Name:</label>
        <input type="text" id="club_name" name="club_name" required>

        <label for="organized_on">Organized On:</label>
        <input type="date" id="organized_on" name="organized_on" required>

        <label for="report">Upload Report:</label>
        <input type="file" id="report" name="report" accept=".pdf, .doc, .docx" required>

        <input type="submit" value="Submit Report">
    </form>
</body>
</html>
