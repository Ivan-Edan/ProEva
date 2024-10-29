<?php
// Include your database configuration
include 'config.php';

// Set response to JSON format
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Insert into UserFinancialStatus
        $appropriations = $_POST['user_appropriations_2'];
        $allotment = $_POST['user_allotment_2'];
        $obligations = $_POST['user_obligations_2'];
        $disbursements = $_POST['user_disbursements_2'];

        $stmt = $conn->prepare("INSERT INTO UserFinancialStatus (appropriations, allotment, obligations, disimbursements) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("dddd", $appropriations, $allotment, $obligations, $disbursements);
        $stmt->execute();
        $financial_status_id = $conn->insert_id;

        
        // 12. Insert into userprojecttitle Table
        $projectTitle = $_POST['user_project_title_1'];

        $stmt = $conn->prepare("INSERT INTO userprojecttitle (project_title) VALUES (?)");
        $stmt->bind_param("s", $projectTitle);
        $stmt->execute();
        
        $project_id = $conn->insert_id; // Store the inserted ID for later use in InitialProjectReport (UserInitialProjectReport)

        $implementingAgency = $_POST['user_implementing_agency_1'];

        $stmt = $conn->prepare("INSERT INTO userimplementingagency (implementing_agency) VALUES (?)");
        $stmt->bind_param("s", $implementingAgency);
        $stmt->execute();    
        $implementing_agency_id = $conn->insert_id; // Store the inserted ID for later use

        // 8. Insert into userfundagency Table
        $fundAgency = $_POST['user_funding_agency_1'];

        $stmt = $conn->prepare("INSERT INTO userfundagency (fund_agency) VALUES (?)");
        $stmt->bind_param("s", $fundAgency);
        $stmt->execute();
        
        $fund_agency_id = $conn->insert_id; // Store the inserted ID for later use

        // 9. Insert into userfundsource Table
        $fundSource = $_POST['user_fund_source_1'];

        $stmt = $conn->prepare("INSERT INTO userfundsource (fund_source) VALUES (?)");
        $stmt->bind_param("s", $fundSource);
        $stmt->execute();
        
        $fund_source_id = $conn->insert_id; // Store the inserted ID for later use

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


        // Insert into UserPhysAccomplishments
        $target_owpa = $_POST['user_target_owpa_2'];
        $actual_owpa = $_POST['user_actual_owpa_2'];
        $slippage = $_POST['user_slippage_2'];
        $form2_output_indicator = $_POST['user_output_indicator_2'];

        $stmt = $conn->prepare("INSERT INTO UserPhysAccomplishments (target_owpa, actual_owpa, slippage, form2_output_indicator) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ddds", $target_owpa, $actual_owpa, $slippage, $form2_output_indicator);
        $stmt->execute();
        $phys_accomplishment_id = $conn->insert_id;

        // Insert into UserAddiDetails
        $end_project_target = $_POST['user_end_project_target_2'];
        $target_date = $_POST['user_target_to_date_2'];
        $actual_date = $_POST['user_actual_to_date_2'];
        $form2_male = $_POST['user_male_2'];
        $form2_female = $_POST['user_female_2'];

        $stmt = $conn->prepare("INSERT INTO UserAddiDetails (end_project_target, target_date, actual_date, form2_male, form2_female) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $end_project_target, $target_date, $actual_date, $form2_male, $form2_female);
        $stmt->execute();
        $addi_details_id = $conn->insert_id;

        // Insert into UserPhysFinAccompReport
        $form2_total_cost = $_POST['user_total_cost_2'];
        $month = $_POST['user_month_2'];
        $year = $_POST['user_year_2'];
        $qtr = $_POST['user_quarter_2'];
        $start_date = $_POST['user_start_date_2'];
        $end_date = $_POST['user_end_date_2'];
        $form2_remarks = $_POST['user_remarks_2'];

        $stmt = $conn->prepare("INSERT INTO UserPhysFinAccompReport (project_id, implementing_agency_id, fund_agency_id, fund_source_id, form2_total_cost, month, year, qtr, start_date, end_date, form2_remarks, financial_status_id, Phys_Accomplishment_id, Addi_Details_id, project_validation_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiisssiisiisi", $project_id, $implementing_agency_id, $fund_agency_id, $fund_source_id, $form2_total_cost, $month, $year, $qtr, $start_date, $end_date, $form2_remarks, $financial_status_id, $phys_accomplishment_id, $addi_details_id, $project_validation_id);
        $stmt->execute();

        // Commit transaction
        $conn->commit();

        // Return success response
        echo json_encode([
            'status' => 'success',
            'message' => 'Form 2 data successfully submitted!'
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
