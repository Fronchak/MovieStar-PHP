<?php

$db_name = "movie_star";
$db_host = "localhost";
$db_user = "root";
$db_password = "1234";

$conn = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

?>