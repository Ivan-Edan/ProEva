<?php
// Include database configuration
include 'config.php';

// Set JSON response
header('Content-Type: application/json');

// Start session and check admin authentication


// Parse and validate input
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['formType'], $data['submissionId'], $data['action'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
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
$status = ($action === 'accept') ? 'accepted' : 'rejected';

// Prepare and execute query
$query = "UPDATE {$tableMap[$formType]} SET status = ? WHERE {$idMap[$formType]} = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('si', $status, $submissionId);

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
