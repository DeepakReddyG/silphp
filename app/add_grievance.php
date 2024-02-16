<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Grievance</title>
    <link rel="stylesheet" href="./index.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        

        .formdiv {
            width: fit-content;
            border: 1px solid black;
            margin: 2rem auto;
        }


        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: black;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: black;
        }
    </style>
</head>
<body>
<div class="nav">
        <div class="nav-in">
            <div class="nav-one">
                <h2>Student Activity Center | Activities Portal</h2>
            </div>
            <div class="nav-two">
                <a href="./index.php">Home</a>
                <a href="./leaderboard.php">Leaderboard</a>
                <!-- <a href="./view_activities.php">View Activities</a> -->
                <a href="./add_grievance.php">Grievances</a>
                <a href="./admin.php">Admin</a>
            </div>
        </div>
    </div>
    <h2>Add Grievance</h2>

    <form action="process_grievance.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="issue_type">Issue Type:</label>
        <select id="issue_type" name="issue_type" required>
            <option value="attendance">Attendance</option>
            <option value="points">Points</option>
            <option value="discipline">Discipline</option>
            <option value="others">Others</option>
        </select>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea>

        <input type="submit" value="Submit Grievance">
    </form>
</body>
</html>
