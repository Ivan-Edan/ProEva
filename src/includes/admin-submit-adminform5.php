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

    // Extract fields from the POST request
    $trainingTitle = $data['trainingTitle'] ?? '';
    $objective = $data['objective'] ?? '';
    $date = $data['date'] ?? '';
    $conductedBy = $data['conductedBy'] ?? '';
    $leadOffice = $data['leadOffice'] ?? '';
    $participatingOffices = $data['participatingOffices'] ?? '';
    $maleParticipants = $data['maleParticipants'] ?? 0;
    $femaleParticipants = $data['femaleParticipants'] ?? 0;
    $totalParticipants = $data['totalParticipants'] ?? 0;
    $resultsFeedback = $data['resultsFeedback'] ?? '';
    $submittedBy = $data['submittedBy'] ?? '';
    $designation = $data['designation'] ?? '';
    $submissionDate = $data['submissionDate'] ?? '';

    // Insert data into the adminform5 table
    $query = "
        INSERT INTO adminform5 (
            training_title, training_objective, training_date, conducted_facilitated_attended, lead_office_unit, 
            participating_offices, male, female, 
            total, results_feedback, submitted_by, 
            designation_office, submission_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'ssssssiiissss',
        $trainingTitle, $objective, $date, $conductedBy, $leadOffice,
        $participatingOffices, $maleParticipants, $femaleParticipants, 
        $totalParticipants, $resultsFeedback, $submittedBy, 
        $designation, $submissionDate
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
