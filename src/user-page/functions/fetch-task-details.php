<?php
session_start();
require_once '../../includes/config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if taskId is provided in the request
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Prepare the SQL query to fetch task details based on taskId
    $sql = "SELECT comment, photoPath, userId FROM main_comment WHERE mainId = ?";
    
    echo "Received taskId: " . $taskId;  // Debugging line to check if taskId is being passed correctly
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the taskId to the prepared statement
        $stmt->bind_param("i", $taskId);
        
        // Execute the statement
        $stmt->execute();
        
        // Bind the result variables
        $stmt->bind_result($comment, $photoPath, $userId);
        
        // Fetch the result
        if ($stmt->fetch()) {
            // Successfully fetched the task details
            $taskDetails = [
                'success' => true,
                'comment' => $comment,
                'photoPath' => $photoPath,
                'userId' => $userId
            ];
        } else {
            // If no task was found for the provided taskId
            $taskDetails = [
                'success' => false,
                'message' => 'Task not found'
            ];
        }

        // Close the statement
        $stmt->close();
    } else {
        // If the query preparation failed
        $taskDetails = [
            'success' => false,
            'message' => 'Failed to prepare the SQL query'
        ];
    }

    // Close the database connection
    $conn->close();
    
    // Return the task details as JSON
    echo json_encode($taskDetails);
} else {
    // If no taskId was provided in the request
    echo json_encode([
        'success' => false,
        'message' => 'Task ID is required'
    ]);
}
?>
