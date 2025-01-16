<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract data from the request
    $formId = $data['form_id'];
    $projectTitle = trim($data['project_title']);
    $implementingAgency = trim($data['implementing_agency']);
    $objectives = $data['objectives'];
    $resultIndicator = $data['result_indicator'];
    $observedResults = $data['observed_results'];

    // Validate the database connection
    if (!$conn) {
        echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
        exit;
    }

    // Retrieve related IDs based on provided project title and implementing agency
    $stmt = $conn->prepare("
    SELECT 
        pt.project_id, 
        ia.implementing_agency_id, 
        pv.project_validation_id 
    FROM userprojecttitle pt
    LEFT JOIN userimplementingagency ia ON ia.implementing_agency = ?
    LEFT JOIN userprojectvalidation pv ON pv.project_validation_id = pt.project_id
    WHERE pt.project_title = ?
    ");

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the query for fetching IDs.']);
        exit;
    }

    $stmt->bind_param("ss", $implementingAgency, $projectTitle);
    $stmt->execute();
    $stmt->bind_result($projectId, $implementingAgencyId, $projectValidationId);

    if ($stmt->fetch()) {
        $stmt->close();

        // Update the `userprojectresult` table
        $updateStmt = $conn->prepare("
            UPDATE userprojectresult
            SET 
                project_id = ?, 
                implementing_agency_id = ?, 
                project_validation_id = ?, 
                objectives = ?, 
                result_indicator = ?, 
                observe_results = ?, 
                status = 'pending', 
                approved_by = NULL, 
                approved_date = NULL, 
                created_at = NOW()
            WHERE form4_id = ? AND status = 'rejected'
        ");

        if (!$updateStmt) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the update query.']);
            exit;
        }

        $updateStmt->bind_param(
            "iiisssi",
            $projectId,
            $implementingAgencyId,
            $projectValidationId,
            $objectives,
            $resultIndicator,
            $observedResults,
            $formId
        );

        if ($updateStmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Form updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error updating the form.']);
        }

        $updateStmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to fetch related IDs for the form.']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
