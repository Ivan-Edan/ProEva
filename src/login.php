<?php
session_start();
require 'includes/config.php'; // Ensure the path is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT u.id, u.email, u.password, u.role, u.department_id, d.name AS department 
                             FROM users u 
                             JOIN departments d ON u.department_id = d.id 
                             WHERE u.email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_email, $db_password, $role, $department_id, $department);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $db_email;
            $_SESSION['role'] = $role;
            $_SESSION['department'] = $department; // Now fetching from the departments table

            // Return redirect URL
            echo json_encode(['redirect' => $role === 'admin' ? 'index-admin.php' : 'index-user.php']);
        } else {
            echo json_encode(['error' => 'Invalid password. Please try again.']);
        }
    } else {
        // Email not found
        echo json_encode(['error' => 'No user found with that email. Please check your email.']);
    }

    $stmt->close(); // Close the statement
    $conn->close(); // Close the connection
}
