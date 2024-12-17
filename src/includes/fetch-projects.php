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

// Get status and page from URL parameters
$status = isset($_GET['status']) ? $_GET['status'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Define the number of projects per page
$projects_per_page = 5;

// Count the total number of projects based on status (if any)
$sql_count = "SELECT COUNT(*) as total_projects FROM user_mainproject p
              LEFT JOIN userprojecttitle ut ON p.project_id = ut.project_id
              WHERE p.status LIKE ?";
$stmt_count = $conn->prepare($sql_count);
$search_status = "%$status%"; // Filter status with LIKE
$stmt_count->bind_param('s', $search_status);
$stmt_count->execute();
$result_count = $stmt_count->get_result();
$total_projects = $result_count->fetch_assoc()['total_projects'];
$total_pages = ceil($total_projects / $projects_per_page);

// Calculate the offset for pagination
$offset = ($page - 1) * $projects_per_page;

// Query to fetch the projects based on page and status (now only from `user_mainproject` and `userprojecttitle`)
$sql_projects = "SELECT ut.project_title as project_name, 
                        p.projectName as main_project_name,
                        p.status as task_status, 
                        p.startDate as start_date, 
                        p.endDate as end_date, 
                        p.created_at
                 FROM user_mainproject p
                 LEFT JOIN userprojecttitle ut ON p.project_id = ut.project_id
                 WHERE p.status LIKE ? 
                 LIMIT ?, ?";
$stmt_projects = $conn->prepare($sql_projects);

// Bind parameters
$stmt_projects->bind_param('sii', $search_status, $offset, $projects_per_page);

// Execute the statement
$stmt_projects->execute();
$result_projects = $stmt_projects->get_result();

// Fetch the projects
$projects = [];
while ($row = $result_projects->fetch_assoc()) {
    // Format dates without time (Month Day, Year)
    $row['start_date'] = date("F j, Y", strtotime($row['start_date']));
    $row['end_date'] = date("F j, Y", strtotime($row['end_date']));
    $row['created_at'] = date("F j, Y g:i a", strtotime($row['created_at']));  // Keep the time for created_at

    $projects[] = $row;
}

// Return projects and pagination information
echo json_encode([
    'projects' => $projects,
    'total_pages' => $total_pages
]);
?>
