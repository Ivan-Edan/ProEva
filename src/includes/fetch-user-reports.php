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

// Query to fetch the user's department from the users_info table
$sql_department = "SELECT department_id FROM users_info WHERE user_id = ? LIMIT 1";
$stmt_department = $conn->prepare($sql_department);
$stmt_department->bind_param('i', $user_id);
$stmt_department->execute();
$result_department = $stmt_department->get_result();

if ($result_department->num_rows > 0) {
    $user_department = $result_department->fetch_assoc()['department_id'];

    // Pagination parameters
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $recordsPerPage = 5;
    $offset = ($page - 1) * $recordsPerPage;

    // Query to count total records
    $sql_count = "SELECT COUNT(*) AS total FROM initialprojectreport AS r
                  INNER JOIN userprojecttitle AS p ON r.project_id = p.project_id
                  INNER JOIN usersector AS s ON r.sector_id = s.sector_id
                  INNER JOIN users AS u ON r.user_id = u.id
                  WHERE r.user_id = ? AND u.department_id = ?";
    $stmt_count = $conn->prepare($sql_count);
    $stmt_count->bind_param('ii', $user_id, $user_department);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $totalRecords = $result_count->fetch_assoc()['total'];

    // Query to fetch the user reports with pagination
    $sql_reports = "
SELECT 
    p.project_title, 
    s.sector, 
    c.total_cost, 
    d.start_date, 
    d.end_date,
    -- Count the completed tasks
    (SELECT COUNT(*) FROM user_mainproject AS mp WHERE mp.project_id = p.project_id AND mp.status = 'Done') +
    (SELECT COUNT(*) FROM user_subproject AS sp WHERE sp.project_id = p.project_id AND sp.status = 'Done') AS completed_tasks,
    -- Count the in-progress tasks
    (SELECT COUNT(*) FROM user_mainproject AS mp WHERE mp.project_id = p.project_id AND mp.status = 'In Progress') +
    (SELECT COUNT(*) FROM user_subproject AS sp WHERE sp.project_id = p.project_id AND sp.status = 'In Progress') AS in_progress_tasks
FROM 
    initialprojectreport AS r
INNER JOIN 
    userprojecttitle AS p ON r.project_id = p.project_id
INNER JOIN 
    usersector AS s ON r.sector_id = s.sector_id
INNER JOIN 
    users AS u ON r.user_id = u.id
LEFT JOIN 
    usertotalcost AS c ON r.total_cost_id = c.total_cost_id
LEFT JOIN 
    usersdateedate AS d ON r.s_date_e_date_id = d.s_date_e_date_id
WHERE 
    r.user_id = ? AND u.department_id = ?
LIMIT ?, ?"; 

    $stmt_reports = $conn->prepare($sql_reports);
    if (!$stmt_reports) {
        die("SQL Error: " . $conn->error);
    }
    $stmt_reports->bind_param('iiii', $user_id, $user_department, $offset, $recordsPerPage);
    $stmt_reports->execute();
    $result_reports = $stmt_reports->get_result();

    $reports = [];
    while ($row = $result_reports->fetch_assoc()) {
        $reports[] = $row;
    }

    // Calculate total pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    // Output JSON response with pagination
    header('Content-Type: application/json');
    echo json_encode([
        'reports' => $reports,
        'totalPages' => $totalPages
    ]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "User department not found"]);
}

// Close prepared statements and database connection
$stmt_department->close();
if (isset($stmt_reports)) $stmt_reports->close();
if (isset($stmt_count)) $stmt_count->close();
$conn->close();
?>
