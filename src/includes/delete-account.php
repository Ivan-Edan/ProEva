<?php
$conn->begin_transaction();

try {
    // Prepare SQL statements to delete from users_info and users tables
    $stmt1 = $conn->prepare("DELETE FROM users_info WHERE user_id = ?");
    $stmt1->bind_param('i', $userId);

    $stmt2 = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt2->bind_param('i', $userId);

    if ($stmt1->execute() && $stmt2->execute()) {
        $conn->commit(); // Commit the transaction
        echo json_encode(['success' => true]);
    } else {
        $conn->rollback(); // Rollback if any of the statements fail
        echo json_encode(['success' => false, 'message' => 'Error deleting account.']);
    }
} catch (Exception $e) {
    $conn->rollback(); // Rollback in case of error
    echo json_encode(['success' => false, 'message' => 'Transaction failed.']);
}

$stmt1->close();
$stmt2->close();
$conn->close();

?>
