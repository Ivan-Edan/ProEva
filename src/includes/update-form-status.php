<?php
include 'config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$formType = $data['formType'];
$submissionId = intval($data['submissionId']);
$action = $data['action']; // 'accept' or 'reject'

// Map table names
$tableMap = [
    'form1' => 'initialprojectreport',
    'form2' => 'userphysfinaccompreport',
    'form3' => 'userprojectexptrprt',
    'form4' => 'userprojectresult'
];

if (!isset($tableMap[$formType])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid form type']);
    exit;
}

$status = ($action === 'accept') ? 'accepted' : 'rejected';

// Update status in the database
$query = "UPDATE {$tableMap[$formType]} SET status = ? WHERE details_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('si', $status, $submissionId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
}
?>
