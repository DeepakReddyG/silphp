<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Activities CSV</title>
</head>
<body>
    <h2>Upload Activities CSV</h2>

    <form action="upload_process_activities.php" method="post" enctype="multipart/form-data">
    <label for="csv_file">Select CSV File:</label>
    <input type="file" id="csv_file" name="csv_file" accept=".csv" required>
    <br>
    <input type="submit" value="Upload CSV">
</form>

</body>
</html>