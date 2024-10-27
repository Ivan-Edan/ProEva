<?php
// Include your database configuration
include 'config.php';

// Set response to JSON format
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Begin transaction
    $conn->begin_transaction();

    try {

        $daRegion = $_POST['user_da_region_3'];
        $stmt = $conn->prepare("INSERT INTO userdaregion (da_region) VALUES (?)");
        $stmt->bind_param("s", $daRegion);
        $stmt->execute();
        $daRegion = $conn->insert_id; // Store the inserted ID

        // 6. Insert into Project Validation Table
        //$submittedBy = $_POST['user_submitted_by_1'];
        $submittedDesignation = $_POST['user_designation_1'];
        //$submittedDate = $_POST['user_submission_date_1'];
        //$approvedBy = $_POST['user_approved_by_1'];
        //$approvedDate = $_POST['user_approval_date_1'];

        $stmt = $conn->prepare("INSERT INTO UserProjectValidation (/*submitted_by,*/ submitted_designation /*submitted_date, approved_by, approved_date*/) VALUES (?/* ?, ?, ?, ?*/)");
        $stmt->bind_param("s", /*$submittedBy,*/ $submittedDesignation /*$submittedDate,*/  /*$approvedBy,$approvedDate*/ );
        $stmt->execute();

        $project_validation_id = $conn->insert_id; // Store the inserted ID for later use

        // 11. Insert into usersector Table
        $sector = $_POST['user_sector_1'];

        $stmt = $conn->prepare("INSERT INTO usersector (sector) VALUES (?)");
        $stmt->bind_param("s", $sector);
        $stmt->execute();
        
        $sector_id = $conn->insert_id; // Store the inserted ID for later use

        // 5. Insert into Location Table
        $location = $_POST['user_province_1'];
        $cityMunicipality = $_POST['user_city_1'];
        $barangay = $_POST['user_barangay_1'];

        $stmt = $conn->prepare("INSERT INTO userlocation (location, city, barangay) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $location, $cityMunicipality, $barangay);
        $stmt->execute();

        $location_id = $conn->insert_id; // Store the inserted ID for later use

        // 1. Insert into UserForm3AddiDetails
        $findings = $_POST['user_findings_3'];
        $typology = $_POST['user_typology_3'];
        $issue_status = $_POST['user_issue_status_3'];
        $reasons = $_POST['user_reasons_3'];
        $actions_taken = $_POST['user_actions_taken_3'];
        $actions_to_be_taken = $_POST['user_actions_to_be_taken_3'];

        $stmt = $conn->prepare("INSERT INTO UserForm3AddiDetails (findings, typology ,issue_status, reasons, actions_taken, actions_to_be_taken) VALUES (?,?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $findings,$typology, $issue_status, $reasons, $actions_taken, $actions_to_be_taken);
        $stmt->execute();
        $Addi_form3_details_id = $conn->insert_id; // Get the inserted ID

        $projectTitle = $_POST['user_project_title_1'];

        // 2. Insert into userprojecttitle
        $projectTitle = $_POST['user_project_title_1'];
        $stmt = $conn->prepare("INSERT INTO userprojecttitle (project_title) VALUES (?)");
        $stmt->bind_param("s", $projectTitle);
        $stmt->execute();
        $project_id = $conn->insert_id; // Store the inserted ID

        // 7. Insert into userimplementingagency Table
        $implementingAgency = $_POST['user_implementing_agency_1'];
        $stmt = $conn->prepare("INSERT INTO userimplementingagency (implementing_agency) VALUES (?)");
        $stmt->bind_param("s", $implementingAgency);
        $stmt->execute();    
        $implementing_agency_id = $conn->insert_id; // Store the inserted ID for later use

        // Capture form data
        $month = $_POST['user_month_3'];
        $year = $_POST['user_year_3'];
        $qtr = $_POST['user_quarter_3'];

        // 4. Insert into UserProjectExptRprt
        $stmt = $conn->prepare("INSERT INTO UserProjectExptRprt (project_id, implementing_agency_id, location_id, da_region_id, sector_id, Addi_form3_details_id,project_validation_id, month, year, qtr) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param("iiiiiiiiii", $project_id, $implementing_agency_id, $location_id, $da_region_id, $sector_id, $Addi_form3_details_id,$project_validation_id, $month, $year, $qtr);
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
