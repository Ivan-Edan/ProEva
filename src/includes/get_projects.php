<?php
session_start();
include 'config.php'; // Include database connection

if (!isset($_SESSION['user_id'])) {
    die(json_encode(["error" => "User not logged in"]));
}

$userId = $_SESSION['user_id'];

// Fetch the logged-in user's department ID
$sqlUser = "SELECT department_id FROM users_info WHERE user_id = ?";
$stmt = $conn->prepare($sqlUser);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($departmentId);
$stmt->fetch();
$stmt->close();

// Ensure departmentId is valid (not null or empty)
if ($departmentId === null || $departmentId === '') {
    die(json_encode(["error" => "User does not belong to a department"]));
}

// SQL query to check if project_id exists in both userphysfinaccompreport and issue_details,
// and then filter by department_id and user_id
$sql = "SELECT i.project_id, u.project_title, up.user_id, up.project_id AS phys_project_id
        FROM issue_details i
        JOIN userprojecttitle u ON i.project_id = u.project_id
        JOIN userphysfinaccompreport up ON up.project_id = i.project_id  -- Check if project_id exists in both tables
        JOIN users_info ui ON ui.user_id = ?  -- Join users_info with user_id
        WHERE ui.department_id = ?  -- Filter by department_id
        AND i.project_id IN (SELECT project_id FROM userphysfinaccompreport WHERE user_id = ?)  -- Ensure project_id exists for this user in userphysfinaccompreport
        ORDER BY u.project_title"; 

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $userId, $departmentId, $userId); // Bind user_id and department_id
$stmt->execute();
$result = $stmt->get_result();

$projects = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

echo json_encode($projects); // Return projects as a JSON response
?>
