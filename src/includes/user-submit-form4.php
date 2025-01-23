<?php
// Include your database configuration
include 'config.php';
include 'helpers.php';

// Set response to JSON format
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = getUserId(); // Retrieve the user_id securely

    // Begin transaction
    $conn->begin_transaction();

    try {
        // 2. Insert into userprojecttitle
        $project_title = $_POST['project_title'];
        $project_year = $_POST['project_year'];
        $stmt = $conn->prepare("SELECT project_id FROM userprojecttitle WHERE project_title = ? AND project_year = ?");
        $stmt->bind_param("si", $project_title, $project_year);
        $stmt->execute();
        $result = $stmt->get_result();
    
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $project_id = $row['project_id'];
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Project title does not exist or is not yet approved. Submit Form 1 first.'
            ]);
            exit;
        }
        // 7. Insert into userimplementingagency Table
        $implementingAgency = $_POST['user_implementing_agency_1'];
        $stmt = $conn->prepare("INSERT INTO userimplementingagency (implementing_agency) VALUES (?)");
        $stmt->bind_param("s", $implementingAgency);
        $stmt->execute(); 
        $implementing_agency_id = $conn->insert_id; // Store the inserted ID for later use

        // 6. Insert into Project Validation Table
        //$submittedBy = $_POST['user_submitted_by_1'];
        $submitted_designation = $_POST['user_designation_1'];
        $submitted_by = $_POST['user_submitted_by_1'];
        //$approvedBy = $_POST['user_approved_by_1'];
        //$approvedDate = $_POST['user_approval_date_1'];

        $stmt = $conn->prepare("INSERT INTO userprojectvalidation (/*submitted_by,*/ submitted_by,submitted_designation /*submitted_date, approved_by, approved_date*/) VALUES (?,?/* ?, ?, ?, ?*/)");
        $stmt->bind_param("ss", /*$submittedBy,*/ $submitted_by,$submitted_designation /*$submittedDate,*/  /*$approvedBy,$approvedDate*/ );
        $stmt->execute();
        $project_validation_id = $conn->insert_id; // Store the inserted ID for later use

        // Capture project details from POST request
        $objectives = $_POST['user_objectives_4'];
        $resultIndicator = $_POST['user_result_indicator_4'];
        $observeResults = $_POST['user_observed_results_4'];

        // Insert into UserProjectResult table
        $stmt = $conn->prepare("INSERT INTO userprojectresult (project_id, implementing_agency_id, project_validation_id, objectives, result_indicator, observe_results,user_id) VALUES (?,?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisssi", $project_id, $implementing_agency_id, $project_validation_id, $objectives, $resultIndicator, $observeResults,$user_id);
        $stmt->execute();

        
        // Commit transaction
        $conn->commit();

        // Return success response
        echo json_encode([
            'status' => 'success',
            'message' => 'Form data successfully submitted!'
        ]);

    } catch (Exception $e) {
        // Rollback transaction on failure
        $conn->rollback();

        // Return error response
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}
?>
