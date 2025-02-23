<?php

$servername = "localhost"; 
$username = 'proeva-g-3'; 
$password = 'Proeva123456#'; 
$dbname = "db_proeva";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

