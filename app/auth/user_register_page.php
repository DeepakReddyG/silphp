<?php
include_once __DIR__ . '/../dbconn.php';

$message = ""; // Initialize an empty message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST["username"]);
    $password = password_hash(sanitizeInput($_POST["password"]), PASSWORD_DEFAULT);
    $role = sanitizeInput($_POST["role"]);

    $insertQuery = "INSERT INTO users (username, password, role, created_at) VALUES (?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        $message = "User registered successfully!";
    } else {
        $message = "Error: " . $insertQuery . "<br>" . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="user_register.css">
</head>
<body>
    <div class="user_registration_page">
        <div class="nav">
            <div class="nav-in">
                <p>Student Activity Center - Student Central</p>
            </div>
        </div>
        <div class="user_registration_page_in">
            <div class="registration-status">
                <?php echo $message; ?>
            </div>
            <div class="user_registration_page_header">
                <div class="user_registration_page_header_in">
                    <h1>Register</h1>
                </div>
            </div>
            <div class="user_registration_page_form">
                <div class="user_registration_page_form_in">
                    <form action="user_register.php" method="post">
                       <div class="user_registration_page_form_in_section_one user_registration_page_form_in_section">
                            <label for="username">Username:</label>
                            <input type="text" name="username" required>
                       </div>
            
                       <div class="user_registration_page_form_in_section_two user_registration_page_form_in_section">
                            <label for="password">Password:</label>
                            <input type="password" name="password" required>
                       </div>
                        
                       <div class="user_registration_page_form_in_section_three user_registration_page_form_in_section">
                            <label for="role">Role:</label>
                            <select name="role" required>
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                                <option value="club_head">Club Head</option>
                                <option value="club_member">Club Member</option>
                            </select>
                       </div>
                       
            
                        <div class="user_registration_page_form_in_section_four user_registration_page_form_in_section">
                            <button type="submit">Register</button>
                            <a href="#">Not a registered user?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footer-in">
                <p>Designed, Developed and Maintained by <a href="#">Deepak Reddy Gathpa</a> of ZeroOne Code Club</p>
            </div>
        </div>
    </div>
</body>
</html>
