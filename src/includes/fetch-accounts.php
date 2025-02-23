<?php
require_once 'config.php';

// Fetch pagination parameters
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = ($page - 1) * $limit;

// Fetch total number of rows
$totalQuery = "SELECT COUNT(*) AS total FROM users_info ui 
               JOIN users u ON ui.user_id = u.id 
               JOIN departments d ON u.department_id = d.id";
$totalResult = $conn->query($totalQuery);
$totalRows = $totalResult->fetch_assoc()['total'];

// Fetch rows for the current page
$query = "SELECT u.id, ui.first_name, ui.middle_name, ui.last_name, ui.suffix, u.email, u.role, d.name AS department, ui.date_added 
          FROM users_info ui 
          JOIN users u ON ui.user_id = u.id 
          JOIN departments d ON u.department_id = d.id 
          LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$rowsHtml = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rowsHtml .= '<tr>';
        $rowsHtml .= '<td class="text-center">' . htmlspecialchars($row['last_name']) . '</td>';
        $rowsHtml .= '<td class="text-center">' . htmlspecialchars($row['first_name']) . '</td>';
        $rowsHtml .= '<td class="text-center">' . htmlspecialchars($row['middle_name']) . '</td>';
        $rowsHtml .= '<td>' . htmlspecialchars($row['department']) . '</td>';
        $rowsHtml .= '<td class="text-center">
                        <a style="color: black;" href="#" data-bs-toggle="modal" data-bs-target="#editAccountModal" 
                           data-email="' . htmlspecialchars($row['email']) . '" 
                           data-id="' . htmlspecialchars($row['id']) . '" 
                           data-firstname="' . htmlspecialchars($row['first_name']) . '" 
                           data-middlename="' . htmlspecialchars($row['middle_name']) . '" 
                           data-lastname="' . htmlspecialchars($row['last_name']) . '" 
                           data-suffix="' . htmlspecialchars($row['suffix'] ?? '') . '"
                           data-role="' . htmlspecialchars($row['role']) . '" 
                           data-department="' . htmlspecialchars($row['department']) . '">
                           ' . htmlspecialchars($row['email']) . '
                        </a>
                      </td>';
        $rowsHtml .= '<td class="text-center">' . htmlspecialchars($row['role']) . '</td>';
        $rowsHtml .= '<td>' . htmlspecialchars($row['date_added']) . '</td>';
        $rowsHtml .= '</tr>';
    }
} else {
    $rowsHtml .= '<tr><td colspan="7" class="text-center">No accounts found.</td></tr>'; // Removed suffix from column count
}

echo json_encode(['totalRows' => $totalRows, 'html' => $rowsHtml]);
$conn->close();
?>


