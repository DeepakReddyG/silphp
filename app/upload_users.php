<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Users</title>
</head>
<body>
    <h2>Upload Users</h2>
    <form action="process_upload_users.php" method="post" enctype="multipart/form-data">
        <label for="csv_file">Choose CSV File:</label>
        <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
        <br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
