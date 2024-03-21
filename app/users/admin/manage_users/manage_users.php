<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../../database/dbconn.php');

function getUsers() {
  $sql = "SELECT u.*, p.*, ap.* 
          FROM users u
          INNER JOIN user_profile p ON u.id = p.user_id
          INNER JOIN user_academic_profile ap ON u.id = ap.user_id;";
  $result = mysqli_query($GLOBALS['conn'], $sql);

  if (!$result) {
    die("Error fetching users: " . mysqli_error($GLOBALS['conn']));
  }

  $users = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
  }

  mysqli_free_result($result);

  return $users;
}

// Check if user is admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
  header("Location: login.php");
  exit(); // Stop execution after redirection
}

// Get all users with details
$users = getUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users</title>
  <style>
        <?php include "manage_users.css" ?>
    </style>
</head>
<body>

  <div class="common-main-heading">
    <div class="common-main-heading-in">
        <h1>Manage Users</h1>
    </div>
  </div>

  <div class="manage-users">
    <div class="manage-users-in">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <!-- <th>Email</th> -->
            <th>User Type</th>
            <!-- <th>Profile Picture</th> -->
            <th>Gender</th>
            <!-- <th>Residence Type</th> -->
            <!-- <th>Personal Email</th> -->
            <!-- <th>Phone Number</th> -->
            <th>Year of Study</th>
            <th>Department</th>
            <th>Cluster</th>
            <th>SIL Section</th>
            <th>CGPA</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user): ?>
            <tr>
              <td><?= $user['id'] ?></td>
              <td><?= $user['username'] ?></td>
              <td><?= $user['name'] ?></td>
              <!-- <td><?= $user['email'] ?></td> -->
              <td><?= $user['user_type'] ?></td>
              <!-- <td><?= $user['profile_picture'] ?></td> -->
              <td><?= $user['gender'] ?></td>
              <!-- <td><?= $user['residence_type'] ?></td> -->
              <!-- <td><?= $user['personal_email'] ?></td> -->
              <!-- <td><?= $user['phone_number'] ?></td> -->
              <td><?= $user['year_of_study'] ?></td>
              <td><?= $user['department'] ?></td>
              <td><?= $user['cluster'] ?></td>
              <td><?= $user['sil_section'] ?></td>
              <td><?= $user['CGPA'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
  </table>
    </div>
  </div>


      

  

</body>
</html>
