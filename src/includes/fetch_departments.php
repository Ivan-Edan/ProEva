<?php
header('Content-Type: application/json');
require_once 'config.php';

try {
    $sql = "SELECT id, name FROM departments";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $departments = [];
        while ($row = $result->fetch_assoc()) {
            $departments[] = [
                'id' => $row['id'],
                'name' => $row['name']
            ];
        }
        echo json_encode($departments);
    } else {
        echo json_encode([]); // Empty array if no data found
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]); // Return error message if any exception occurs
}
?>
