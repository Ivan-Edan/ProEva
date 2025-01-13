<?php
include 'config.php'; // Adjust the path to match the actual location

// Set JSON response
header('Content-Type: application/json');

try {
    // Validate POST data
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
        exit;
    }

    // Extract fields
    $projectTitle = $data['projectTitle'] ?? '';
    $totalCost = $data['totalCost'] ?? '';
    $location = $data['location'] ?? '';
    $IA = $data['IA'] ?? '';
    $inspectionDate = $data['inspectionDate'] ?? '';
    $siteDetails = $data['siteDetails'] ?? '';
    $findings = $data['findings'] ?? '';
    $issues = $data['Issues'] ?? '';
    $actionsTaken = $data['actionsTaken'] ?? '';
    $actionsToBeTaken = $data['actionsToBeTaken'] ?? '';
    $submittedBy = $data['submittedBy'] ?? '';
    $designation = $data['designation'] ?? '';
    $submissionDate = $data['submissionDate'] ?? '';

    // Insert into adminform3 table
    $query = "
        INSERT INTO adminform3 (
            project_title, total_cost, location, implementing_agency, date_of_inspection,
            details_on_site_inspected, findings, issues, action_taken, actions_to_be_taken,
            submitted_by, designation_office, submission_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'sssssssssssss',
        $projectTitle, $totalCost, $location, $IA, $inspectionDate,
        $siteDetails, $findings, $issues, $actionsTaken, $actionsToBeTaken,
        $submittedBy, $designation, $submissionDate
    );

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit form.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
