<?php 
session_start();
require 'config.php'; // Include your database connection file

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

// Get the logged-in user ID
$user_id = $_SESSION['user_id'];

// Query to fetch project_id and project_title from userprojecttitle based on user_id in userphysfinaccompreport
$sql = "SELECT p.project_id, p.project_title
        FROM userphysfinaccompreport u
        JOIN userprojecttitle p ON u.project_id = p.project_id
        WHERE u.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id); // Bind the logged-in user's ID
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
    echo json_encode($userprojecttitle); // Return the projects associated with the user
} else {
    echo json_encode([]); // Empty array if no projects found for the user
}
?>
