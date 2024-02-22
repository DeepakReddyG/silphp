<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../../database/dbconn.php');
$updateStatus = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('process_update_academic_profile.php');
}

$user_id = $_SESSION['user_id']; 
$query = "SELECT * FROM user_academic_profile WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $academicProfileData = mysqli_fetch_assoc($result);
} else {
    $academicProfileData = array(
        'year_of_study' => 'NA',
        'department' => '',
        'cluster' => '',
        'sil_section' => '',
        'CGPA' => ''
    );
}
// Do not close the connection here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Academic Profile</title>
    <link rel="stylesheet" href="./update_academic_profile.css">
    <!-- Include jQuery for AJAX functionality -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include your JavaScript for AJAX submission and alert display -->
    <script>
    function submitForm() {
        $.ajax({
            type: "POST",
            url: "update_academic_profile/process_update_academic_profile.php",
            data: $("#updateForm").serialize(),
            dataType: "json",
            success: function(response) {
                // Display alert with the response message
                showAlert(response.message, response.class);
            },
            error: function(xhr, status, error) {
                // Log the detailed error information to the console
                console.error(xhr.responseText);
                showAlert("Error submitting form: " + error, "error");
            }
        });
    }

    function showAlert(message, className) {
        alert(message);
        // You can optionally add code here to apply styles based on the class
    }
</script>

<style>

.update-academic-profile {
    width: 100%;
}
.update-academic-profile-in {
    width: 100%;
}

.update-academic-profile-main {
    width: 100%;
}
.update-academic-profile-main-in {
    width: 100%;
}

.update-academic-profile-main-in form {
    width: 50%;
    display: flex;
    flex-direction: column;
    padding: 1rem 0rem;
}

.update-academic-profile-main-in form input,
.update-academic-profile-main-in form select {
    width: 100%;
    padding: 0.4rem;
    border: 1px solid black;
    outline: none;
    font-size: 1rem;
}

.update-academic-profile-main-in form input:focus,
.update-academic-profile-main-in form select:focus {
    border: 1px solid blue;
    background-color: bisque;
}

.update-academic-profile-main-in form label {
    margin-top: 0.5rem;
}

.update-academic-profile-main-in form button {
    width: 100%;
    padding: 0.4rem;
    border: none;
    outline: none;
    font-size: 1rem;
    background-color: black;
    color: white;
    cursor: pointer;
    margin-top: 1rem;
}

</style>

</head>
<body>

<!-- Display confirmation message -->
<div class="update-academic-profile">
    <div class="update-academic-profile-in">
        <div class="common-main-heading">
            <div class="common-main-heading-in">
                <h1>Update Academic Profile</h1>
            </div>
        </div>

        <div class="update-academic-profile-main">
            <div class="update-academic-profile-main-in">
                <!-- Add an ID to the form for easier targeting with JavaScript -->
                <form id="updateForm" method="post" action="update_academic_profile/process_update_academic_profile.php">
                    <label for="year_of_study">Year of Study:</label>
                    <select name="year_of_study" required>
                        <option value="1" <?php echo ($academicProfileData['year_of_study'] == '1') ? 'selected' : ''; ?>>1</option>
                        <option value="NA" <?php echo ($academicProfileData['year_of_study'] == 'NA') ? 'selected' : ''; ?>>Not Specified</option>
                    </select>

                    <label for="department">Department:</label>
                    <input type="text" name="department" value="<?php echo $academicProfileData['department']; ?>" required>

                    <label for="cluster">Cluster:</label>
                    <input type="text" name="cluster" value="<?php echo $academicProfileData['cluster']; ?>" required>

                    <label for="sil_section">SIL Section:</label>
                    <input type="text" name="sil_section" value="<?php echo $academicProfileData['sil_section']; ?>" required>

                    <label for="CGPA">CGPA:</label>
                    <input type="text" name="CGPA" value="<?php echo $academicProfileData['CGPA']; ?>" required>

                    <button type="button" onclick="submitForm()">Update Academic Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
