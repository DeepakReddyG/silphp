<?php
// view_users_list.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . '/../../dbconn.php';

// Check if the form is submitted for delete
if (isset($_POST['delete'])) {
    $username_to_delete = $_POST['username_to_delete'];
    $updateQuery = "UPDATE users SET status='inactive' WHERE username='$username_to_delete'";
    $updateResult = $conn->query($updateQuery);

    if (!$updateResult) {
        die("Error: " . $updateQuery . "<br>" . $conn->error);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['field'], $_POST['value'])) {
    $user_id = $_POST['user_id'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    // Update the user's data in the database
    $updateQuery = "UPDATE users SET $field='$value' WHERE id='$user_id'";
    $updateResult = $conn->query($updateQuery);

    if (!$updateResult) {
        die("Error: " . $updateQuery . "<br>" . $conn->error);
    }

    // Output success message or handle as needed
    echo "Update successful";
    exit();
}

$selectQuery = "SELECT id, username, role, created_at FROM users WHERE status='active'";
$result = $conn->query($selectQuery);

if (!$result) {
    die("Error: " . $selectQuery . "<br>" . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="view_users_list.css">
    <style>
        .edit-mode input {
            border: 1px solid #000;
            padding: 2px;
        }
    </style>
</head>
<body>

    <div class="view-users-list">
        <div class="view-users-list-in">
            <div class="view-users-header">
                <div class="view-users-header-in">
                    <h1>Active Users of SAC Activities</h1>
                </div>
            </div>
            <div class="view-users-list-one">
                <div class="view-users-list-one-in">
                    <table>
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $counter = 1; // Initialize the counter
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>"; // Display the Sno
                            echo "<td class='editable' data-id='" . $row['id'] . "' data-field='username'>" . $row['username'] . "</td>";
                            echo "<td class='editable' data-id='" . $row['id'] . "' data-field='role'>" . $row['role'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td>
                                    <form method='post'>
                                        <input type='hidden' name='username_to_delete' value='" . $row['username'] . "'>
                                        <input type='submit' name='delete' value='Deactivate'>
                                    </form>
                                    <input type='button' value='Edit' onclick='toggleEdit(" . $row['id'] . ")'>
                                    <input type='button' value='Save' onclick='saveEdit(" . $row['id'] . ")' style='display:none;'>
                                </td>";
                            echo "</tr>";
                            $counter++; // Increment the counter
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEdit(userId) {
            const cells = document.querySelectorAll(`[data-id="${userId}"]`);
            cells.forEach(cell => {
                const field = cell.dataset.field;
                const currentValue = cell.innerText;
                cell.innerHTML = `<input type="text" name="${field}" value="${currentValue}">`;
            });

            // Show the Save button and hide the Edit button
            document.querySelector(`input[value='Edit'][onclick='toggleEdit(${userId})']`).style.display = 'none';
            document.querySelector(`input[value='Save'][onclick='saveEdit(${userId})']`).style.display = 'inline-block';
        }

        function saveEdit(userId) {
            const cells = document.querySelectorAll(`[data-id="${userId}"]`);
            const formData = new FormData();

            cells.forEach(cell => {
                const field = cell.dataset.field;
                const value = cell.querySelector('input').value;
                cell.innerHTML = value;
                formData.append(field, value);
            });

            formData.append('user_id', userId);

            // Send the updated data to the server using AJAX
            fetch('view_users_list.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Handle the response as needed
            });

            // Show the Edit button and hide the Save button
            document.querySelector(`input[value='Edit'][onclick='toggleEdit(${userId})']`).style.display = 'inline-block';
            document.querySelector(`input[value='Save'][onclick='saveEdit(${userId})']`).style.display = 'none';
        }
    </script>

</body>
</html>
