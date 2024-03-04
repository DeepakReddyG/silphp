<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../../../database/dbconn.php');
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM social_internship_registration";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}

$alertMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registration_id = mysqli_real_escape_string($conn, $_POST['registration_id']);
    $approval_status = mysqli_real_escape_string($conn, $_POST['approval_status']);

    $update_query = "UPDATE social_internship_registration SET internship_registration_approval_status = '$approval_status' WHERE id = $registration_id";
    $update_result = mysqli_query($conn, $update_query);

    if (!$update_result) {
        echo "Error updating approval status: " . mysqli_error($conn);
    } else {
        $alertMessage = 'Update successful!';
        echo "<script>window.location.href = 'social_internship_registrations.php';</script>";
        exit();
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Social Internship Registrations</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        form {
            margin: 10px;
        }

        td[approval-status="Approved"] {
            background-color: green;
            color: white;
        }

        td[approval-status="Pending"] {
            background-color: orange;
            color: white;
        }

        td[approval-status="Rejected"] {
            background-color: red;
            color: white;
        }
    </style>
    <script>
        // JavaScript to display the alert after a successful update
        <?php
        if (!empty($alertMessage)) {
            echo "alert('$alertMessage');";
        }
        ?>
    </script>
</head>
<body>
    <h2>Admin - View Social Internship Registrations</h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>Internship Domain</th>
            <th>Approval Status</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['internship_domain']; ?></td>
                <td approval-status="<?php echo $row['internship_registration_approval_status']; ?>">
                    <?php echo $row['internship_registration_approval_status']; ?>
                </td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="registration_id" value="<?php echo $row['id']; ?>">
                        <label for="approval_status">Approval Status:</label>
                        <select id="approval_status" name="approval_status">
                            <option value="Approved">Approved</option>
                            <option value="Pending" selected>Pending</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
