<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Activity</title>
</head>
<body>
    <h2>Add New Activity</h2>
    
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
