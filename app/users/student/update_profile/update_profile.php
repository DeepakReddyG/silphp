<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../../database/dbconn.php');
$updateStatus = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the script for processing profile update
    include_once('process_update_profile.php');
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user_profile WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $profileData = mysqli_fetch_assoc($result);
} else {
    $profileData = array(
        'profile_picture' => '',
        'gender' => 'NA',
        'residence_type' => 'NA',
        'personal_email' => '',
        'phone_number' => ''
    );
}
// Do not close the connection here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="./update_profile.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function submitForm() {
        $.ajax({
            type: "POST",
            url: "update_profile/process_update_profile.php",
            data: $("#updateForm").serialize(),
            dataType: "json", // Specify the expected data type
            success: function(response) {
                // Display alert with the response message
                showAlert(response.message, response.class);
            },
            error: function() {
                // Handle error if needed
                showAlert("Error submitting form", "error");
            }
        });
    }

    function showAlert(message, className) {
        alert(message);
        // You can optionally add code here to apply styles based on the class
    }
</script>

</head>
<body>

<!-- Display confirmation message -->
<div class="update-profile">
    <div class="update-profile-in">
        <div class="common-main-heading">
            <div class="common-main-heading-in">
                <h1>Update User Profile</h1>
            </div>
        </div>

        <div class="update-profile-main">
            <div class="update-profile-main-in">
                <!-- Add an ID to the form for easier targeting with JavaScript -->
                <form id="updateForm" method="post" action="update_profile/process_update_profile.php">
                    <label for="profile_picture">Profile Picture URL:</label>
                    <input type="text" name="profile_picture" value="<?php echo $profileData['profile_picture']; ?>" required>

                    <label for="gender">Gender:</label>
                    <select name="gender" required>
                        <option value="Male" <?php echo ($profileData['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($profileData['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="NA" <?php echo ($profileData['gender'] == 'NA') ? 'selected' : ''; ?>>Not Specified</option>
                    </select>

                    <label for="residence_type">Residence Type:</label>
                    <select name="residence_type" required>
                        <option value="University Hostel" <?php echo ($profileData['residence_type'] == 'University Hostel') ? 'selected' : ''; ?>>University Hostel</option>
                        <option value="Day Scholar" <?php echo ($profileData['residence_type'] == 'Day Scholar') ? 'selected' : ''; ?>>Day Scholar</option>
                        <option value="NA" <?php echo ($profileData['residence_type'] == 'NA') ? 'selected' : ''; ?>>Not Specified</option>
                    </select>

                    <label for="personal_email">Personal Email:</label>
                    <input type="email" name="personal_email" value="<?php echo $profileData['personal_email']; ?>" required>

                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" value="<?php echo $profileData['phone_number']; ?>" required>

                    <button type="button" onclick="submitForm()">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
