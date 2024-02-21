<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Include your CSS stylesheets or link to a CSS file here -->
    <style>
        /* Your CSS styles here */
        .confirmation {
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
        }

        .success {
            background-color: #4caf50;
            color: #fff;
        }

        .error {
            background-color: #ff3333;
            color: #fff;
        }
    </style>
</head>
<body>

<?php
// Include your database connection file
include_once('../../../database/dbconn.php');

// Initialize $updateStatus variable
$updateStatus = null;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the script for processing profile update
    include_once('process_update_profile.php');
}

// Fetch existing values from the database to pre-fill the form
$user_id = 1; // Replace with the actual user_id
$query = "SELECT * FROM user_profile WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $profileData = mysqli_fetch_assoc($result);
} else {
    // Handle the case where user_profile data is not found
    $profileData = array(
        'profile_picture' => '',
        'gender' => 'NA',
        'residence_type' => 'NA',
        'personal_email' => '',
        'phone_number' => ''
    );
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Display confirmation message -->
<?php if (isset($updateStatus)) : ?>
    <div class="confirmation <?php echo $updateStatus['class']; ?>">
        <?php echo $updateStatus['message']; ?>
    </div>
<?php endif; ?>

<!-- Your update profile form goes here -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <!-- Include your form fields for profile update here -->
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

    <button type="submit">Update Profile</button>
</form>

<!-- Include your JavaScript for displaying toasts here if needed -->

</body>
</html>
