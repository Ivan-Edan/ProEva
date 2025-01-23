<?php
include 'config.php'; // Adjust the path to match your configuration file

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
    $resolutionNumber = $data['resolutionNumber'] ?? '';
    $resolutionTitle = $data['resolutionTitle'] ?? '';
    $dateApproved = $data['dateApproved'] ?? '';
    $resolution = $data['resolution'] ?? '';
    $resolutionLink = $data['resolutionLink'] ?? '';
    $submittedBy = $data['submittedBy'] ?? '';
    $designation = $data['designation'] ?? '';
    $submissionDate = $data['submissionDate'] ?? '';


    // Insert into adminform6 table
    $query = "
        INSERT INTO adminform6 (
            resolution_number, resolution_title, date_approved, resolution, resolution_link,
            submitted_by, designation_office, submission_date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'ssssssss',
        $resolutionNumber, $resolutionTitle, $dateApproved, $resolution, $resolutionLink,
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
