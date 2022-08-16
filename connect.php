<?php
$host = 'localhost';
$username = 'root';
$password = '@Athira321#';
$dbname = 'eshop';
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_errno) {
    echo 'Failed to connect to MySQL: '.$mysqli->connect_error;
    exit();
}
?> 