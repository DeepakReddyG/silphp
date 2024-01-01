<?php

session_start();
$timeout = 100; 
ini_set('session.gc_maxlifetime', $timeout);
session_set_cookie_params($timeout);

include_once __DIR__ . '/dbconn.php';


$message = "";
$statusClass = "";

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location: auth/user_login.php");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    $selectQuery = "SELECT * FROM users WHERE username = ? AND status = 'active'";
    
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            
            $message = "Login successful!";
            $statusClass = "success"; 
            
            switch ($user['role']) {
                case 'admin':
                    header("Location: ./user_modules/admin/admin_index.php");
                    exit();
                    break;

                case 'staff':
                    header("Location: staff_index.php");
                    exit();
                    break;

                case 'club_head':
                    header("Location: ../user_modules/club_head/club_head_index.php");
                    exit();
                    break;

                case 'club_member':
                    header("Location: ../user_modules/club_member/club_member_index.php");
                    exit();
                    break;
                    
                default:
                    header("Location: default_index.php");
                    exit();
            }
        } else {
            $message = "Incorrect password. Please try again.";
            $statusClass = "error";
        }
    } else {
        $message = "User not found or deactivated by admin.";
        $statusClass = "error"; // Add a class for styling error message
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
    <title>User Login</title>
    <link rel="stylesheet" href="auth/user_login.css">
</head>
<body>
    <div class="user_login_page">
        <div class="nav">
            <div class="nav-in">
                <p>Student Activity Center - Student Central</p>
            </div>
        </div>
        <div class="user_login_page_in">
            <div class="login-status <?php echo $statusClass; ?>">
                <?php echo $message; ?>
            </div>
            <div class="user_login_page_header">
                <div class="user_login_page_header_in">
                    <h1>Login</h1>
                </div>
            </div>
            <div class="user_login_page_form">
                <div class="user_login_page_form_in">
                    <form action="index.php" method="post">
                        <div class="user_login_page_form_in_section_one user_login_page_form_in_section">
                            <label for="username">Username:</label>
                            <input type="text" name="username" required>
                        </div>
            
                        <div class="user_login_page_form_in_section_two user_login_page_form_in_section">
                            <label for="password">Password:</label>
                            <input type="password" name="password" required>
                        </div>
                        
                        <div class="user_login_page_form_in_section_three user_login_page_form_in_section">
                            <button type="submit">Login</button>
                            <a href="#">Not yet registered?</a>
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