<?php

require_once 'dbconn.php';

if ($db_status['connected']) {
    echo 'Database connection successful. Database Name: ' . $db_status['database_name'];

} else {
    echo 'Database connection error: ' . $db_status['error_message'];
}

?>
