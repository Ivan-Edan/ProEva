<?php
session_start();
require 'includes/config.php';

$ip_address = $_SERVER['REMOTE_ADDR'];
$lockout_time = 100; // 15 minutes in seconds
$max_attempts = 3;

// Count failed login attempts
$stmt = $conn->prepare("SELECT COUNT(*) FROM attempt_logs WHERE ip_address = ? AND attempt_time > ?");
$timestamp_limit = time() - $lockout_time;
$stmt->bind_param("si", $ip_address, $timestamp_limit);
$stmt->execute();
$stmt->bind_result($failed_attempts);
$stmt->fetch();
$stmt->close();

if ($failed_attempts >= $max_attempts) {
    echo json_encode(['error' => 'Too many failed attempts. Please try again after 15 minutes.']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

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

        if (password_verify($password, $db_password)) {
            $stmt->close(); // Close after fetching, no further use
            
            // Reset failed attempts for the IP
            $conn->query("DELETE FROM attempt_logs WHERE ip_address = '$ip_address'");

            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $db_email;
            $_SESSION['role'] = $role;
            $_SESSION['department'] = $department;

            echo json_encode(['redirect' => $role === 'admin' ? 'index-admin.php' : 'index-user.php']);
            exit();
        } else {
            // Log failed attempt
            $stmt->close(); // Close the first statement

            $stmt = $conn->prepare("INSERT INTO attempt_logs (ip_address, attempt_time) VALUES (?, ?)");
            $current_time = time();
            $stmt->bind_param("si", $ip_address, $current_time);
            $stmt->execute();
            $stmt->close();

            echo json_encode(['error' => 'Invalid password. Please try again.']);
            exit();
        }
    } else {
        $stmt->close();
        echo json_encode(['error' => 'No user found with that email.']);
        exit();
    }
}

$conn->close();
?>
