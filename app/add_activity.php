<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Activity</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 30%;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1.1rem;
        }

        input[type="submit"] {
            background-color: black;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: black;
        }
    </style>
</head>
<body>
    <h2>SAC Activity Week 04 (25th Dec to 29th Dec)</h2>
    
    <form action="process_activity.php" method="post">
        <label for="name">Activity Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="clubname">Club Name:</label>
        <input type="text" id="clubname" name="clubname" required><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br>

        <label for="organized_on">Organized On:</label>
        <input type="date" id="organized_on" name="organized_on" required><br>

        <label for="student_organizer_id">Student Organizer ID:</label>
        <input type="text" id="student_organizer_id" name="student_organizer_id" required><br>

        <label for="student_organizer_name">Student Organizer Name:</label>
        <input type="text" id="student_organizer_name" name="student_organizer_name" required><br>

        <label for="venue">Venue:</label>
        <input type="text" id="venue" name="venue" required><br>

        <label for="time_slot">Time Slot:</label>
        <input type="text" id="time_slot" name="time_slot" required><br>

        <label for="points">Points:</label>
        <input type="text" id="points" name="points" required><br>

        <input type="submit" value="Add Activity">
    </form>
</body>
</html>
