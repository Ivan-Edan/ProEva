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

// Query to fetch the user's department from the users table
$sql_department = "SELECT department_id FROM users WHERE id = ? LIMIT 1";
$stmt_department = $conn->prepare($sql_department);
$stmt_department->bind_param('i', $user_id);
$stmt_department->execute();
$result_department = $stmt_department->get_result();

if ($result_department->num_rows > 0) {
    $user_department = $result_department->fetch_assoc()['department_id'];

    // Fetch project titles for the user's department
    $sql_projects = "SELECT p.project_id, p.project_title 
                     FROM userprojecttitle AS p
                     INNER JOIN initialprojectreport AS r ON p.project_id = r.project_id
                     INNER JOIN users AS u ON r.user_id = u.id
                     WHERE u.department_id = ?";
                     
    $stmt_projects = $conn->prepare($sql_projects);
    $stmt_projects->bind_param('i', $user_department);
    $stmt_projects->execute();
    $result_projects = $stmt_projects->get_result();

    if ($result_projects->num_rows > 0) {
        $projects = [];
        while ($row = $result_projects->fetch_assoc()) {
            $projects[] = [
                'project_id' => $row['project_id'],
                'project_title' => $row['project_title']
            ];
        }
        echo json_encode($projects); // Return the list of project titles
    } else {
        echo json_encode([]); // No projects found for this department
    }
} else {
    http_response_code(404); // User department not found
    echo json_encode(["error" => "User department not found"]);
}

// Close prepared statements and database connection
$stmt_department->close();
if (isset($stmt_projects)) $stmt_projects->close();
$conn->close();
?>
