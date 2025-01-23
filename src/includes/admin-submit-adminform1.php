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
    $implementingAgency = $data['implementingAgency'] ?? '';
    $startDate = $data['startDate'] ?? '';
    $endDate = $data['endDate'] ?? '';
    $sector = $data['sector'] ?? '';
    $fundSource = $data['fundSource'] ?? '';
    $fundingAgency = $data['fundingAgency'] ?? '';
    $projectCost = $data['projectCost'] ?? '';
    $appropriations = $data['appropriations'] ?? '';
    $allotment = $data['allotment'] ?? '';
    $obligations = $data['obligations'] ?? '';
    $disbursements = $data['disbursements'] ?? '';
    $fundingSupport = $data['fundingSupport'] ?? '';
    $fundUtilization = $data['fundUtilization'] ?? '';
    $targetOWPA = $data['targetOWPA'] ?? '';
    $actualOWPA = $data['actualOWPA'] ?? '';
    $slippage = $data['slippage'] ?? '';
    $male = $data['male'] ?? '';
    $female = $data['female'] ?? '';
    $remarks = $data['remarks'] ?? '';
    $submittedBy = $data['submittedBy'] ?? '';
    $designation = $data['designation'] ?? '';
    $submissionDate = $data['submissionDate'] ?? '';

    // Insert into adminform1 table
    $query = "
        INSERT INTO adminform1 (
            project_title, implementing_agency, start_date, end_date, sector, fund_source, 
            funding_agency, total_project_cost, appropriations, allotment, obligations, disbursements, 
            funding_support, fund_utilization, target_owpa, actual_owpa, slippage, male, female, 
            remarks, submitted_by, designation_office, submission_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'sssssssssssssssssssssss',
        $projectTitle, $implementingAgency, $startDate, $endDate, $sector, $fundSource,
        $fundingAgency, $projectCost, $appropriations, $allotment, $obligations, $disbursements,
        $fundingSupport, $fundUtilization, $targetOWPA, $actualOWPA, $slippage, $male, $female,
        $remarks, $submittedBy, $designation, $submissionDate
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
