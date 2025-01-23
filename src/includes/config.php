<?php
// src/includes/config.php

$servername = "localhost"; 
$username = 'proeva-g-3'; 
$password = 'Proeva123456#'; 
$dbname = "db_proeva";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

