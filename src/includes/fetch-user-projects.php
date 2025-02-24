<?php 
session_start();
require 'config.php'; 

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); 
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

// Get the logged-in user ID
$user_id = $_SESSION['user_id'];


$sql = "SELECT p.project_id, p.project_title
        FROM userphysfinaccompreport u
        JOIN userprojecttitle p ON u.project_id = p.project_id
        WHERE u.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

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
?>
