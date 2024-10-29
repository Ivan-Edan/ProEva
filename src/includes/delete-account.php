<?php
// Include database configuration
include 'config.php';

// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get user ID from the query string
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $userId = intval($_GET['id']); // Ensure user ID is an integer

        // Begin a transaction to ensure both deletes succeed or fail together
        $conn->begin_transaction();

        try {
            // Delete the user's personal information from users_info table
            $stmt = $conn->prepare("DELETE FROM users_info WHERE user_id = ?");
            $stmt->bind_param('i', $userId);
            $stmt->execute();

            // Check if any row was affected in users_info
            if ($stmt->affected_rows > 0) {
                // Delete the user's email from users table
                $stmt2 = $conn->prepare("DELETE FROM users WHERE id = ?");
                $stmt2->bind_param('i', $userId);
                $stmt2->execute();

                // Check if any row was affected in users table
                if ($stmt2->affected_rows > 0) {
                    // Commit transaction if both deletes were successful
                    $conn->commit();
                    echo json_encode(['success' => true]);
                } else {
                    // Rollback if the email deletion failed
                    $conn->rollback();
                    echo json_encode(['success' => false, 'message' => 'Error deleting account email.']);
                }
            } else {
                // Rollback if the personal info deletion failed
                $conn->rollback();
                echo json_encode(['success' => false, 'message' => 'Error deleting user info.']);
            }

            // Close statements
            $stmt->close();
            $stmt2->close();
        } catch (Exception $e) {
            // Rollback on any error
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => 'Transaction failed: ' . $e->getMessage()]);
        }

    } else {
        // Invalid or missing user ID
        echo json_encode(['success' => false, 'message' => 'Invalid or missing user ID.']);
    }

    // Close the database connection
    $conn->close();
} else {
    // Only allow DELETE requests
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
