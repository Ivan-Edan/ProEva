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

// Get pagination and status parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$status = isset($_GET['status']) ? $_GET['status'] : '';
$itemsPerPage = 5;

// Calculate the offset
$offset = ($page - 1) * $itemsPerPage;

// Query to fetch the user's department from the users_info table
$sql_department = "SELECT department_id FROM users_info WHERE user_id = ? LIMIT 1";
$stmt_department = $conn->prepare($sql_department);
$stmt_department->bind_param('i', $user_id);
$stmt_department->execute();
$result_department = $stmt_department->get_result();

if ($result_department->num_rows > 0) {
    $user_department = $result_department->fetch_assoc()['department_id'];

    // Query to fetch all projects associated with the user based on department_id and status
    $sql_projects = "
    SELECT p.project_id, p.projectName AS main_project_name, p.status AS task_status,
           p.startDate, p.endDate, p.created_at
    FROM user_mainproject AS p
    INNER JOIN initialprojectreport AS r ON p.project_id = r.project_id
    INNER JOIN users AS u ON r.user_id = u.id
    WHERE r.user_id = ? AND u.department_id = ?";
    if (!empty($status)) {
        $sql_projects .= " AND p.status = ?";
    }
    $sql_projects .= " LIMIT ? OFFSET ?";
    
    $stmt_projects = $conn->prepare($sql_projects);
    if (!empty($status)) {
        $stmt_projects->bind_param('iissi', $user_id, $user_department, $status, $itemsPerPage, $offset);
    } else {
        $stmt_projects->bind_param('iiii', $user_id, $user_department, $itemsPerPage, $offset);
    }
    $stmt_projects->execute();
    $result_projects = $stmt_projects->get_result();

    $projects = [];
    while ($row = $result_projects->fetch_assoc()) {
        // Format dates
        $row['startDate'] = date("F j, Y", strtotime($row['startDate']));
        $row['endDate'] = date("F j, Y", strtotime($row['endDate']));
        $row['created_at'] = date("F j, Y g:i a", strtotime($row['created_at']));
        $projects[] = $row;
    }

    // Query to get the total number of pages
    $sql_count = "SELECT COUNT(*) AS total FROM user_mainproject AS p
                  INNER JOIN initialprojectreport AS r ON p.project_id = r.project_id
                  INNER JOIN users AS u ON r.user_id = u.id
                  WHERE r.user_id = ? AND u.department_id = ?";
    if (!empty($status)) {
        $sql_count .= " AND p.status = ?";
    }

    $stmt_count = $conn->prepare($sql_count);
    if (!empty($status)) {
        $stmt_count->bind_param('iis', $user_id, $user_department, $status);
    } else {
        $stmt_count->bind_param('ii', $user_id, $user_department);
    }
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $totalRows = $result_count->fetch_assoc()['total'];
    $totalPages = ceil($totalRows / $itemsPerPage);

    // Output JSON response with project titles, task counts, and total pages
    header('Content-Type: application/json');
    echo json_encode([
        'projects' => $projects,
        'totalPages' => $totalPages
    ]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "User department not found"]);
}

// Close prepared statements and database connection
$stmt_department->close();
if (isset($stmt_projects)) $stmt_projects->close();
if (isset($stmt_count)) $stmt_count->close();
$conn->close();
?>
