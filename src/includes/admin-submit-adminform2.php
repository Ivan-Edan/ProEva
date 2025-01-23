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
    $location = $data['location'] ?? '';
    $implementingAgency = $data['IA'] ?? '';
    $fundUtilization = $data['fundUtilization'] ?? '';
    $targetOWPA = $data['targetOWPA'] ?? '';
    $actualOWPA = $data['actualOWPA'] ?? '';
    $slippage = $data['slippage'] ?? '';
    $issueDetails = $data['issueDetails'] ?? '';
    $issueTypology = $data['issueTypology'] ?? '';
    $issueStatus = $data['issueStatus'] ?? '';
    $sourceOfInfo = $data['sourceOfInfo'] ?? '';
    $actionTaken = $data['actionTaken'] ?? '';
    $actionsToBeTaken = $data['actionsToBeTaken'] ?? '';
    $NPMCAction = $data['NPMCAction'] ?? '';
    $requestedAction = $data['requestedAction'] ?? '';
    $submittedBy = $data['submittedBy'] ?? '';
    $designation = $data['designation'] ?? '';
    $submissionDate = $data['submissionDate'] ?? '';

    // Insert into adminform2 table
    $query = "
        INSERT INTO adminform2 (
            project_title, location, implementing_agency, fund_utilization, target_owpa, 
            actual_owpa, slippage, issue_details, issue_typology, issue_status, 
            source_of_information, action_taken, actions_to_be_taken, for_npmc_action, 
            requested_action_from_npmc, submitted_by, designation_office, submission_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'ssssssssssssssssss',
        $projectTitle, $location, $implementingAgency, $fundUtilization, $targetOWPA,
        $actualOWPA, $slippage, $issueDetails, $issueTypology, $issueStatus,
        $sourceOfInfo, $actionTaken, $actionsToBeTaken, $NPMCAction,
        $requestedAction, $submittedBy, $designation, $submissionDate
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
