<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../../database/dbconn.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM user_academic_profile WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

$academic_profile = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Academic Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<h2>Update Academic Profile</h2>

<form id="updateForm">
    <label for="year_of_study">Year of Study:</label>
    <select name="year_of_study" required>
        <option value="1" <?php echo ($academic_profile['year_of_study'] == '1') ? 'selected' : ''; ?>>1</option>
        <option value="NA" <?php echo ($academic_profile['year_of_study'] == 'NA') ? 'selected' : ''; ?>>Not Specified</option>
    </select><br>

    <label for="department">Department:</label>
    <input type="text" name="department" value="<?php echo $academic_profile['department']; ?>" required><br>

    <label for="cluster">Cluster:</label>
    <input type="number" name="cluster" value="<?php echo $academic_profile['cluster']; ?>" required><br>

    <label for="sil_section">SIL Section:</label>
    <input type="number" name="sil_section" value="<?php echo $academic_profile['sil_section']; ?>" required><br>

    <label for="CGPA">CGPA:</label>
    <input type="number" step="0.01" name="CGPA" value="<?php echo $academic_profile['CGPA']; ?>" required><br>

    <input type="submit" value="Update">
</form>

<script>
$(document).ready(function(){
    $('#updateForm').submit(function(e){
        e.preventDefault();
        console.log("Form submitted");  // Add this line for debugging
        $.ajax({
            type: 'POST',
            url: 'update_academic_profile/process_update_academic_profile.php', 
            data: $('#updateForm').serialize(),
            success: function(response){
                alert(response);
            }
        });
    });
});
</script>

</body>
</html>
