<?php
// Include database configuration
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_GET['id'];  // Get user ID from query string

    // Get JSON input and decode it
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Extract updated data from the input
    $firstName = $data['firstName'];
    $middleName = $data['middleName'];
    $lastName = $data['lastName'];
    $suffix = $data['suffix'];
    $email = $data['email'];

    // Prepare the SQL statement to update the account
    $stmt = $conn->prepare("UPDATE users_info SET first_name = ?, middle_name = ?, last_name = ?, suffix = ? WHERE user_id = ?");
    $stmt->bind_param('ssssi', $firstName, $middleName, $lastName, $suffix, $userId);
    
    // Update the email in the users table
    $stmt2 = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
    $stmt2->bind_param('si', $email, $userId);

    if ($stmt->execute() && $stmt2->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating account.']);
    }

    $stmt->close();
    $stmt2->close();
    $conn->close();
}
?>
