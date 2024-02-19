<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Grievance</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./add_grievance.css">
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
                <a href="./add_grievance.php">Grievances</a>
                <a href="./social_internship.php">Social Internship</a>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="addGriev-in">
        <div class="addGrievHeading">
            <h2>Submit your Grievance</h2>
        </div>
        
        <div class="addGrievForm">
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
        </div>
        </div>
    </div>

    <footer>
        <p>Designed and Developed by ZeroOne Code Club. All rights reserved</p>
    </footer>


</body>
</html>
