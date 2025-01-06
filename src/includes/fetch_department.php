<?php
include 'config.php'; // Include your database connection file

$user_id = $_POST['user_id']; // Get the user_id from the request

$sql_department = "SELECT department_id FROM users_info WHERE user_id = ? LIMIT 1";
$stmt = $conn->prepare($sql_department);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($department_id);
$stmt->fetch();
$stmt->close();

echo $department_id; // Send the department_id back to the frontend
?>