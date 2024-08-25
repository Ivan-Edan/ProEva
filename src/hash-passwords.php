<?php
// hash-passwords.php

require 'includes/config.php'; // Ensure the path is correct

// Fetch all users with plain-text passwords
$result = $conn->query("SELECT id, password FROM users");

while ($row = $result->fetch_assoc()) {
    $user_id = $row['id'];
    $plain_password = $row['password'];

    // Hash the password
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $hashed_password, $user_id);

    if ($stmt->execute()) {
        echo "Password for user ID $user_id updated successfully.<br>";
    } else {
        echo "Error updating password for user ID $user_id: " . $stmt->error . "<br>";
    }
}

$result->free();
$conn->close();
?>
