<?php
// Include database configuration
include 'config.php';

// Set JSON response
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['formType'], $data['submissionId'], $data['action'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input',
        'received_data' => $data // Debugging input data
    ]);
    exit;
}

$formType = $data['formType'];
$submissionId = intval($data['submissionId']);
$action = $data['action']; // 'accept' or 'reject'

// Map table names and ID columns
$tableMap = [
    'form1' => 'initialprojectreport',
    'form2' => 'userphysfinaccompreport',
    'form3' => 'userprojectexptrprt',
    'form4' => 'userprojectresult'
];

$idMap = [
    'form1' => 'details_id',
    'form2' => 'Form2_id',
    'form3' => 'form3_id',
    'form4' => 'form4_id'
];

// Validate form type
if (!isset($tableMap[$formType])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid form type']);
    exit;
}

// Determine status based on action
$status = ($action === 'accept') ? 'approved' : 'rejected';

// Initialize additional fields
$approvedBy = null;
$approvedDate = null;

// If action is 'accept', add approved_by and approved_date
if ($action === 'accept') {
    session_start(); // Start session to get admin username
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Admin session not found']);
        exit;
    }

    // Fetch admin's full name from `users_info`
    $adminUserId = $_SESSION['user_id'];
    $query = "SELECT CONCAT(first_name, ' ', last_name) AS full_name FROM users_info WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $adminUserId);
    $stmt->execute();
    $stmt->bind_result($approvedBy);
    $stmt->fetch();
    $stmt->close();

    if (!$approvedBy) {
        echo json_encode(['status' => 'error', 'message' => 'Admin user not found']);
        exit;
    }

    $approvedDate = date('Y-m-d H:i:s'); // Current timestamp
}

// Prepare the update query
$query = "UPDATE {$tableMap[$formType]} 
        SET status = ?, 
            approved_by = ?, 
            approved_date = ? 
        WHERE {$idMap[$formType]} = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('sssi', $status, $approvedBy, $approvedDate, $submissionId);

if (!$stmt->execute()) {
    echo json_encode(['status' => 'error', 'message' => 'SQL Error: ' . $stmt->error]);
    exit;
}

// Check if any rows were updated
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
}
?>
