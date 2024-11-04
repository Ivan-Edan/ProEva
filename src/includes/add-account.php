<?php
require_once 'config.php'; 

// Check if the request is an AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input data from AJAX request
    $firstName = trim($_POST['first_name']);
    $middleName = trim($_POST['middle_name']);
    $lastName = trim($_POST['last_name']);
    $suffix = trim($_POST['suffix']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $department = trim($_POST['department']);

    // Validate input data
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($role) || empty($department)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Password hashing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Retrieve the department ID
    $stmtDept = $conn->prepare("SELECT id FROM departments WHERE name = ?");
    $stmtDept->bind_param("s", $department);
    $stmtDept->execute();
    $stmtDept->bind_result($departmentId);
    $stmtDept->fetch();
    $stmtDept->close();

    if (empty($departmentId)) {
        echo json_encode(['status' => 'error', 'message' => 'Department not found.']);
        exit;
    }

    // Insert data into the `users` table
    $stmt = $conn->prepare("INSERT INTO users (email, password, role, department_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $email, $hashedPassword, $role, $departmentId);

    if ($stmt->execute()) {
        $userId = $stmt->insert_id; // Get the last inserted user ID

        // Now insert data into the `users_info` table
        $stmtInfo = $conn->prepare("INSERT INTO users_info (user_id, first_name, middle_name, last_name, suffix, role, department_id, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmtInfo->bind_param("isssssi", $userId, $firstName, $middleName, $lastName, $suffix, $role, $departmentId);

        if ($stmtInfo->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Account added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error adding account to users_info.']);
        }

        $stmtInfo->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding account to users.']);
    }

    $stmt->close();
    $conn->close();
}
?>
