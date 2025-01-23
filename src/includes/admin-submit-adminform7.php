<?php
include 'config.php'; // Adjust the path as needed

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
    $implementingAgency = $data['implementingAgency'] ?? '';
    $nature = $data['nature'] ?? '';
    $details = $data['details'] ?? '';
    $strategies = $data['strategies'] ?? '';
    $responsibleEntity = $data['responsibleEntity'] ?? '';
    $lessonsLearned = $data['lessonsLearned'] ?? '';
    $submittedBy = $data['submittedBy'] ?? '';
    $designation = $data['designation'] ?? '';
    $submissionDate = $data['submissionDate'] ?? '';

    // Insert into adminform7 table
    $query = "
        INSERT INTO adminform7 (
            project_title, location, implementing_agency, nature, details,
            strategies, responsible_entity, lesson_learned, submitted_by, 
            designation_office, submission_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'sssssssssss',
        $projectTitle, $location, $implementingAgency, $nature, $details,
        $strategies, $responsibleEntity, $lessonsLearned, $submittedBy,
        $designation, $submissionDate
    );

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit form.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
