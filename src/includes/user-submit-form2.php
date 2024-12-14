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
        // 1. Insert into UserFinancialStatus
        $appropriations = $_POST['user_appropriations_2'];
        $allotment = $_POST['user_allotment_2'];
        $obligations = $_POST['user_obligations_2'];
        $disbursements = $_POST['user_disbursements_2'];

        $stmt = $conn->prepare("INSERT INTO UserFinancialStatus (appropriations, allotment, obligations, disbursements) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("dddd", $appropriations, $allotment, $obligations, $disbursements);
        $stmt->execute();
        $financial_status_id = $conn->insert_id;

        // 2. Insert into UserOutputIndicator
        $output_indicator = $_POST['user_output_indicator_2'];

        $stmt = $conn->prepare("INSERT INTO UserOutputIndicator (output_indicator) VALUES (?)");
        $stmt->bind_param("s", $output_indicator);
        $stmt->execute();
        $output_indicator_id = $conn->insert_id;

        // 3. Insert into UserPhysAccomplishments
        $target_owpa = $_POST['user_target_owpa_2'];
        $actual_owpa = $_POST['user_actual_owpa_2'];
        $slippage = $_POST['user_slippage_2'];

        $stmt = $conn->prepare("INSERT INTO UserPhysAccomplishments (target_owpa, actual_owpa, slippage, output_indicator_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("dddi", $target_owpa, $actual_owpa, $slippage, $output_indicator_id);
        $stmt->execute();
        $phys_accomplishment_id = $conn->insert_id;

        // 4. Insert into UserAddiDetails
        $end_project_target = $_POST['user_end_project_target_2'];
        $target_date = $_POST['user_target_to_date_2'];
        $actual_date = $_POST['user_actual_to_date_2'];

        $stmt = $conn->prepare("INSERT INTO UserAddiDetails (end_project_target, target_date, actual_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $end_project_target, $target_date, $actual_date);
        $stmt->execute();
        $addi_details_id = $conn->insert_id;

        // 5. Insert into UserSDateEDate
        $start_date = $_POST['user_start_date_2'];
        $end_date = $_POST['user_end_date_2'];

        $stmt = $conn->prepare("INSERT INTO UserSDateEDate (start_date, end_date) VALUES (?, ?)");
        $stmt->bind_param("ss", $start_date, $end_date);
        $stmt->execute();
        $s_date_e_date_id = $conn->insert_id;

        // 6. Insert into UserTargetEmployee
        $male = $_POST['user_male_2'];
        $female = $_POST['user_female_2'];

        $stmt = $conn->prepare("INSERT INTO UserTargetEmployee (male, female) VALUES (?, ?)");
        $stmt->bind_param("ii", $male, $female);
        $stmt->execute();
        $target_employee_id = $conn->insert_id;

        // 7. Insert into UserProjectTitle
        $project_title = $_POST['user_project_title_1'];

        $stmt = $conn->prepare("INSERT INTO UserProjectTitle (project_title) VALUES (?)");
        $stmt->bind_param("s", $project_title);
        $stmt->execute();
        $project_id = $conn->insert_id;

        // 8. Insert into UserImplementingAgency
        $implementing_agency = $_POST['user_implementing_agency_1'];

        $stmt = $conn->prepare("INSERT INTO UserImplementingAgency (implementing_agency) VALUES (?)");
        $stmt->bind_param("s", $implementing_agency);
        $stmt->execute();
        $implementing_agency_id = $conn->insert_id;

        // 9. Insert into UserFundSource
        $fund_source = $_POST['user_fund_source_1'];

        $stmt = $conn->prepare("INSERT INTO UserFundSource (fund_source) VALUES (?)");
        $stmt->bind_param("s", $fund_source);
        $stmt->execute();
        $fund_source_id = $conn->insert_id;

        // 10. Insert into UserFundAgency
        $fund_agency = $_POST['user_funding_agency_1'];

        $stmt = $conn->prepare("INSERT INTO UserFundAgency (fund_agency) VALUES (?)");
        $stmt->bind_param("s", $fund_agency);
        $stmt->execute();
        $fund_agency_id = $conn->insert_id;

        // 11. Insert into UserTotalCost
        $total_cost = $_POST['user_total_cost_2'];

        $stmt = $conn->prepare("INSERT INTO UserTotalCost (total_cost) VALUES (?)");
        $stmt->bind_param("d", $total_cost);
        $stmt->execute();
        $total_cost_id = $conn->insert_id;

        // 12. Insert into UserRemarks
        $remarks = $_POST['user_remarks_2'];

        $stmt = $conn->prepare("INSERT INTO UserRemarks (remarks) VALUES (?)");
        $stmt->bind_param("s", $remarks);
        $stmt->execute();
        $remarks_id = $conn->insert_id;

        // 13. Insert final report into UserPhysFinAccompReport
        $stmt = $conn->prepare("
            INSERT INTO UserPhysFinAccompReport (
                project_id, s_date_e_date_id, fund_agency_id, fund_source_id, 
                total_cost_id, financial_status_id, Phys_Accomplishment_id, 
                Addi_Details_id, Target_employee_id, remarks_id, user_id
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "iiiiiiiiiii",
            $project_id, $s_date_e_date_id, $fund_agency_id, $fund_source_id,
            $total_cost_id, $financial_status_id, $phys_accomplishment_id,
            $addi_details_id, $target_employee_id, $remarks_id, $user_id
        );
        $stmt->execute();

        // Commit transaction
        $conn->commit();

        echo json_encode([
            'status' => 'success',
            'message' => 'Form 2 submitted successfully!'
        ]);
    } catch (Exception $e) {
        $conn->rollback();

        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}
?>
