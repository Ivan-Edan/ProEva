<?php
header('Content-Type: application/json');
require_once 'config.php';

try {
    $sql = "SELECT project_id, project_title FROM userprojecttitle";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userprojecttitle = [];
        while ($row = $result->fetch_assoc()) {
            $userprojecttitle[] = [
                'project_id' => $row['project_id'],
                'project_title' => $row['project_title']
            ];
        }
        echo json_encode($userprojecttitle);
    } else {
        echo json_encode([]); 
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>