<?php
//authetication
$db_server = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'panel';


//creating connection
$dsn = "mysql:host=" . $db_server . ";dbname=" . $db_name;
$pdo = new PDO($dsn, $db_username, $db_password);
?>
