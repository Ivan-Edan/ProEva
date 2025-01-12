<?php
session_start();
require_once '../includes/config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = [];

if (isset($_POST['id'], $_POST['id-formatted'])) {
    $taskId = $_POST['id'];
    $formattedId = $_POST['id-formatted'];
    $comment = !empty(trim($_POST['comment'] ?? '')) ? $_POST['comment'] : null;
    $photoPath = null;

    // Handle file upload if a photo is provided
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $uploadDir = '../uploads/';
        $fileName = basename($_FILES['photo']['name']);
        $serverFilePath = $uploadDir . $fileName;
        $photoPath = 'uploads/' . $fileName;
        $photoPathAdmin = '../uploads/' . $fileName;
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $serverFilePath)) {
            $response = [
                'success' => false,
                'message' => 'Failed to upload photo.',
            ];
            echo json_encode($response);
            exit;
        }
    }

    // Add comment/photo
    $commentAdded = false;
    if ($comment || $photoPath) {
        $userId = $_SESSION['user_id'];
        $sql = "INSERT INTO main_comment (mainId, userId, comment, photoPath, photoPath_admin, formatted_id_main) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iissss", $taskId, $userId, $comment, $photoPath, $photoPath, $formattedId);
            if ($stmt->execute()) {
                $commentAdded = true;
            }
            $stmt->close();
        }
    }

    // Respond with success or failure
    if ($commentAdded) {
        $response = [
            'success' => true,
            'message' => 'Task updated successfully.',
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'No changes were made.',
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => 'Invalid input parameters.',
    ];
}

echo json_encode($response);
$conn->close();
?>