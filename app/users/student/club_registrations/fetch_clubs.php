<?php
include_once('../../../database/dbconn.php');

if (isset($_GET['category'])) {
    $category = mysqli_real_escape_string($conn, $_GET['category']);

    $queryClubs = "SELECT * FROM clubs WHERE club_category = $category";
    $resultClubs = mysqli_query($conn, $queryClubs);

    $clubs = mysqli_fetch_all($resultClubs, MYSQLI_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($clubs);
} else {
    header('HTTP/1.1 400 Bad Request');
    echo 'Bad Request';
}
?>
