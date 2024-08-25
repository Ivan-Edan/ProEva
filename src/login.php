<?php
session_start();
require 'includes/config.php'; // Ensure the path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, email, password, role, department FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_email, $db_password, $role, $department);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $db_email;
            $_SESSION['role'] = $role;
            $_SESSION['department'] = $department;

            // Return redirect URL
            echo json_encode(['redirect' => $role === 'admin' ? 'index-admin.php' : 'index-user.php']);
        } else {
            echo json_encode(['error' => 'Invalid password. Please try again.']);
        }
    } else {
        // Email not found, now we can check if the password is incorrect as well
        $stmt->close();

        // Prepare a new statement to check if the password exists (meaning the email was incorrect)
        $stmt = $conn->prepare("SELECT id FROM users WHERE password = ?");
        $stmt->bind_param("s", $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Password exists but email is wrong
            echo json_encode(['error' => 'No user found with that email. Please check your email.']);
        } else {
            // Both email and password are incorrect
            echo json_encode(['error' => 'Invalid email and password combination. Please try again.']);
        }
    }

    $stmt->close(); // Close the statement
    $conn->close(); // Close the connection
}
