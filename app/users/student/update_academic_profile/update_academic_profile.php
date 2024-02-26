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
    <!-- <link rel="stylesheet" href="update_academic_profile.css?v=<?php echo time(); ?>"> -->
    <style>
        <?php include "update_academic_profile.css" ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#updateForm').submit(function(e){
                e.preventDefault();
                console.log("Form submitted");
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

</head>
<body>

<div class="update-academic-profile">
    <div class="update-academic-profile-in">
        <div class="common-main-heading">
            <div class="common-main-heading-in">
                <h1>Update Academic Profile</h1>
            </div>
        </div>
    </div>
</div>

<div class="update-academic-profile-main">
    <div class="update-academic-profile-main-in">
        <form id="updateForm">
            <label for="year_of_study">Year of Study:</label>
            <select name="year_of_study" required>
                <option value="1" <?php echo ($academic_profile['year_of_study'] == '1') ? 'selected' : ''; ?>>1</option>
            </select>

            <label for="department">Department:</label>
            <!-- <input type="text" name="department" value="<?php echo $academic_profile['department']; ?>" required> -->
            <select name="department" required>
                <option value="CSE" <?php echo ($academic_profile['department'] == 'CSE') ? 'selected' : ''; ?>>CSE</option>
                <option value="EEE" <?php echo ($academic_profile['department'] == 'EEE') ? 'selected' : ''; ?>>EEE</option>
                <option value="BBA" <?php echo ($academic_profile['department'] == 'BBA') ? 'selected' : ''; ?>>BBA</option>
                <option value="ENG" <?php echo ($academic_profile['department'] == 'ENG') ? 'selected' : ''; ?>>ENG</option>
            </select>

            <label for="cluster">Cluster:</label>
            <!-- <input type="number" name="cluster" value="<?php echo $academic_profile['cluster']; ?>" required> -->
            <select name="cluster" required>
                <option value="1" <?php echo ($academic_profile['cluster'] == '1') ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo ($academic_profile['cluster'] == '2') ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo ($academic_profile['cluster'] == '3') ? 'selected' : ''; ?>>3</option>
                <option value="4" <?php echo ($academic_profile['cluster'] == '4') ? 'selected' : ''; ?>>4</option>
            </select>

            <label for="sil_section">SIL Section:</label>
            <!-- <input type="number" name="sil_section" value="<?php echo $academic_profile['sil_section']; ?>" required> -->
            <select name="sil_section" required>
                <option value="1" <?php echo ($academic_profile['sil_section'] == '1') ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo ($academic_profile['sil_section'] == '2') ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo ($academic_profile['sil_section'] == '3') ? 'selected' : ''; ?>>3</option>
                <option value="4" <?php echo ($academic_profile['sil_section'] == '4') ? 'selected' : ''; ?>>4</option>
            </select>

            <label for="CGPA">CGPA:</label>
            <input type="number" step="0.01" name="CGPA" value="<?php echo $academic_profile['CGPA']; ?>" required>

            <input id="form-button" type="submit" value="Update">
        </form>
    </div>
</div>
</body>
</html>
