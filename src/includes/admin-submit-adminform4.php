<?php
include 'config.php'; // Include your database configuration file

// Set the response header
header('Content-Type: application/json');

try {
    // Get the input data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
        exit;
    }

    // Extract the fields from the input data
    $projectTitle = $data['projectTitle'] ?? '';
    $issueDetails = $data['issueDetails'] ?? '';
    $issueTypology = $data['issueTypology'] ?? '';
    $IA = $data['IA'] ?? '';
    $location = $data['location'] ?? '';
    $dateOfMeeting = $data['dateOfMeeting'] ?? '';
    $concernedAgencies = $data['concernedAgencies'] ?? '';
    $agreementsReached = $data['agreementsReached'] ?? '';
    $submittedBy = $data['submittedBy'] ?? '';
    $designation = $data['designation'] ?? '';
    $submissionDate = $data['submissionDate'] ?? '';

    // Insert data into the adminform4 table
    $query = "
        INSERT INTO adminform4 (
            project_title, issue_details, issue_typology, implementing_agency, location, 
            date_of_meeting, concerned_agency, agreements_reached, submitted_by, 
            designation_office, submission_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'sssssssssss',
        $projectTitle,
        $issueDetails,
        $issueTypology,
        $IA,
        $location,
        $dateOfMeeting,
        $concernedAgencies,
        $agreementsReached,
        $submittedBy,
        $designation,
        $submissionDate
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit form.']);
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
