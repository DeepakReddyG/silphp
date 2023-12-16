<?php

require_once 'dbconn.php';

if ($db_status['connected']) {
    echo 'Connected to the database!';
} else {
    echo 'Database connection error: ' . $db_status['error_message'];
}


?>
