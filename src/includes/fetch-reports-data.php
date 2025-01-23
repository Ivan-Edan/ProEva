<?php
session_start();
require 'config.php'; // Include your database connection file

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

// Pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$recordsPerPage = 5;
$offset = ($page - 1) * $recordsPerPage;

// Sorting parameters
$sortOrder = isset($_GET['sort_order']) && $_GET['sort_order'] === 'DESC' ? 'DESC' : 'ASC';

// Query to fetch total records count
$sql_count = "
    SELECT COUNT(*) AS total
    FROM initialprojectreport AS r
    INNER JOIN userprojecttitle AS p ON r.project_id = p.project_id
    INNER JOIN usersector AS s ON r.sector_id = s.sector_id
    INNER JOIN users AS u ON r.user_id = u.id";
$stmt_count = $conn->prepare($sql_count);
$stmt_count->execute();
$result_count = $stmt_count->get_result();
$totalRecords = $result_count->fetch_assoc()['total'];

// Query to fetch paginated reports
$sql_reports = "
    SELECT 
        p.project_title, 
        dept.name AS department_name, -- Use the new alias 'dept' for departments table
        s.sector, 
        c.total_cost, 
        users_date.start_date, 
        users_date.end_date,
        -- Count completed tasks
        (SELECT COUNT(*) FROM user_mainproject AS mp WHERE mp.project_id = p.project_id AND mp.status = 'Done') +
        (SELECT COUNT(*) FROM user_subproject AS sp WHERE sp.project_id = p.project_id AND sp.status = 'Done') AS completed_tasks,
        -- Count in-progress tasks
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
        usersdateedate AS users_date ON r.s_date_e_date_id = users_date.s_date_e_date_id
    LEFT JOIN 
        departments AS dept ON u.department_id = dept.id -- Changed alias to 'dept'
    ORDER BY u.department_id $sortOrder
    LIMIT ?, ?";

$stmt_reports = $conn->prepare($sql_reports);
if (!$stmt_reports) {
    die("SQL Error: " . $conn->error);
}
$stmt_reports->bind_param('ii', $offset, $recordsPerPage);
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
    'projects' => $reports,
    'totalPages' => $totalPages
]);

// Close prepared statements and database connection
$stmt_count->close();
$stmt_reports->close();
$conn->close();
?>
