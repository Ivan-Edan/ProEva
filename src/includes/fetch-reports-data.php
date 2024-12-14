<?php
// for reports page admin side table for projects

// Include the config file to get the database connection
include('config.php');

// Get current page, records per page, and sort order
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sortOrder = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';
$recordsPerPage = 5; // Set records per page

// Calculate the offset for the query
$offset = ($page - 1) * $recordsPerPage;

// Get the total number of records (use correct table)
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM initialprojectreport"; 
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Get the projects for the current page with JOIN and sorting by department
$query = "SELECT 
            p.project_title, 
            d.name AS department_name, 
            s.sector, 
            u.total_cost, 
            u.start_date, 
            u.end_date
          FROM initialprojectreport u
          JOIN usersector s ON u.sector_id = s.sector_id
          JOIN users_info ui ON u.user_id = ui.user_id
          JOIN departments d ON ui.department_id = d.id
          JOIN userprojecttitle p ON u.project_id = p.project_id
          ORDER BY d.name $sortOrder 
          LIMIT $offset, $recordsPerPage";

$result = $conn->query($query);

// Fetch the results
$projects = [];
while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Send the results and pagination data back as JSON
echo json_encode(['projects' => $projects, 'totalPages' => $totalPages]);

// Close the database connection
$conn->close();

?>
