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

// Query to fetch the user's department from the users_info table
$sql_department = "SELECT department_id FROM users_info WHERE user_id = ? LIMIT 1";
$stmt_department = $conn->prepare($sql_department);
$stmt_department->bind_param('i', $user_id);
$stmt_department->execute();
$result_department = $stmt_department->get_result();

if ($result_department->num_rows > 0) {
    $user_department = $result_department->fetch_assoc()['department_id'];

    // Query to fetch all projects associated with the user
    $sql_projects = "
    SELECT p.project_id, p.project_title
    FROM userprojecttitle AS p
    INNER JOIN initialprojectreport AS r ON p.project_id = r.project_id
    INNER JOIN users AS u ON r.user_id = u.id
    WHERE r.user_id = ? AND u.department_id = ?";
    
    $stmt_projects = $conn->prepare($sql_projects);
    $stmt_projects->bind_param('ii', $user_id, $user_department);
    $stmt_projects->execute();
    $result_projects = $stmt_projects->get_result();
    
    $projects = [];
    while ($row = $result_projects->fetch_assoc()) {
        $projects[] = $row;
    }

    // Query to count the number of tasks with different statuses (Done, In Progress, Incoming)
    $sql_task_counts = "
    SELECT 
        -- Count the 'Done' tasks
        (SELECT COUNT(*) FROM user_mainproject AS mp WHERE mp.project_id = p.project_id AND mp.status = 'Done') +
        (SELECT COUNT(*) FROM user_subproject AS sp WHERE sp.project_id = p.project_id AND sp.status = 'Done') AS done_tasks,

        -- Count the 'In Progress' tasks
        (SELECT COUNT(*) FROM user_mainproject AS mp WHERE mp.project_id = p.project_id AND mp.status = 'In Progress') +
        (SELECT COUNT(*) FROM user_subproject AS sp WHERE sp.project_id = p.project_id AND sp.status = 'In Progress') AS in_progress_tasks,

        -- Count the 'Incoming' tasks (you might need to define this status in your system)
        (SELECT COUNT(*) FROM user_mainproject AS mp WHERE mp.project_id = p.project_id AND mp.status = 'Incoming') +
        (SELECT COUNT(*) FROM user_subproject AS sp WHERE sp.project_id = p.project_id AND sp.status = 'Incoming') AS incoming_tasks
    FROM 
        userprojecttitle AS p
    WHERE 
        p.project_id IN (SELECT r.project_id FROM initialprojectreport AS r WHERE r.user_id = ?)
    GROUP BY p.project_id";

    $stmt_task_counts = $conn->prepare($sql_task_counts);
    $stmt_task_counts->bind_param('i', $user_id);
    $stmt_task_counts->execute();
    $result_task_counts = $stmt_task_counts->get_result();

    $task_counts = [];
    while ($row = $result_task_counts->fetch_assoc()) {
        $task_counts[] = $row;
    }

    // Output JSON response with project titles and task counts
    header('Content-Type: application/json');
    echo json_encode([
        'projects' => $projects,
        'task_counts' => $task_counts
    ]);
} else {
    http_response_code(404); // Not found
    echo json_encode(["error" => "User department not found"]);
}

// Close prepared statements and database connection
$stmt_department->close();
if (isset($stmt_projects)) $stmt_projects->close();
if (isset($stmt_task_counts)) $stmt_task_counts->close();
$conn->close();
?>
