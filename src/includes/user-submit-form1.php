<?php
// Assuming you have a database connection file
include 'config.php';

// Set the header to return JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Start transaction
    $conn->begin_transaction();

    try {
        // 3. Insert into Target Output Table
        $outputIndicator1 = $_POST['user_indicator_1_1'];
        $outputIndicator2 = $_POST['user_indicator_2_1'];
        $outputIndicator3 = $_POST['user_indicator_3_1'];
        $outputIndicator4 = $_POST['user_indicator_4_1'];
        $outputIndicator5 = $_POST['user_indicator_5_1'];

        $stmt = $conn->prepare("INSERT INTO UserTargetOutput (Target_output_1, Target_output_2, Target_output_3, Target_output_4, Target_output_5) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $outputIndicator1, $outputIndicator2, $outputIndicator3, $outputIndicator4, $outputIndicator5);
        $stmt->execute();

        $target_output_id = $conn->insert_id; // Store the inserted ID for later use

        // 4. Insert into Employment Targets Table
        $maleTarget = $_POST['user_male_1'];
        $femaleTarget = $_POST['user_female_1'];
        $outputIndicators = $_POST['user_output_indicators_1']; // Assume this is a string or array

        $stmt = $conn->prepare("INSERT INTO UserTargetEmployee (male, female, output_indicator) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $maleTarget, $femaleTarget, $outputIndicators);
        $stmt->execute();

        $target_employee_id = $conn->insert_id; // Store the inserted ID for later use

        // 5. Insert into Location Table
        $location = $_POST['user_province_1'];
        $cityMunicipality = $_POST['user_city_1'];
        $barangay = $_POST['user_barangay_1'];

        $stmt = $conn->prepare("INSERT INTO userlocation (location, city, barangay) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $location, $cityMunicipality, $barangay);
        $stmt->execute();

        $location_id = $conn->insert_id; // Store the inserted ID for later use

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

        // 7. Insert into userimplementingagency Table
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

        // 10. Insert into usermodeofimplementation Table        
        $modeOfImplementation = $_POST['user_mode_implementation_1'];

        $stmt = $conn->prepare("INSERT INTO usermodeofimplementation (mode_of_implementation) VALUES (?)");
        $stmt->bind_param("s", $modeOfImplementation);
        $stmt->execute();
        
        $mode_of_implementation_id = $conn->insert_id; // Store the inserted ID for later use

        // 11. Insert into usersector Table
        $sector = $_POST['user_sector_1'];

        $stmt = $conn->prepare("INSERT INTO usersector (sector) VALUES (?)");
        $stmt->bind_param("s", $sector);
        $stmt->execute();
        
        $sector_id = $conn->insert_id; // Store the inserted ID for later use

        // 12. Insert into userprojecttitle Table
        $projectTitle = $_POST['user_project_title_1'];

        $stmt = $conn->prepare("INSERT INTO userprojecttitle (project_title) VALUES (?)");
        $stmt->bind_param("s", $projectTitle);
        $stmt->execute();
        
        $project_id = $conn->insert_id; // Store the inserted ID for later use in InitialProjectReport (UserInitialProjectReport)

        // 1. Insert into Project Details Table
        $year = $_POST['user_year_1'];
        $startDate = $_POST['user_start_date_1'];
        $endDate = $_POST['user_end_date_1'];
        $remarks = $_POST['user_remarks_1'];
        $totalCost = $_POST['user_total_cost_1'];

        $stmt = $conn->prepare("INSERT INTO userinitialprojectreport (project_id, year, start_date, end_date, remarks, total_cost, implementing_agency_id, fund_agency_id, fund_source_id, sector_id, mode_of_implementation_id, location_id, target_employee_id, target_output_id, project_validation_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssiiiiiiiii", $project_id, $year, $startDate, $endDate, $remarks, $totalCost, $implementing_agency_id, $fund_agency_id, $fund_source_id, $sector_id, $mode_of_implementation_id, $location_id, $target_employee_id, $target_output_id, $project_validation_id);
        $stmt->execute();

        $details_id = $conn->insert_id; // Store the last inserted details_id

        // 2. Insert into Monthly Quarterly Targets Table
        for ($i = 1; $i <= 5; $i++) {
            $startDate = $_POST["user_first_start_$i"];
            $endDate = $_POST["user_first_end_$i"];
            $financialTargets = $_POST["user_first_financial_targets_$i"];
            $physicalTargets = $_POST["user_first_physical_targets_$i"];

            if (!empty($startDate) && !empty($endDate)) {
                $stmt = $conn->prepare("INSERT INTO usermtyltarget (period_start, period_end, financial_target, physical_target_percentage, details_id) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssdis", $startDate, $endDate, $financialTargets, $physicalTargets, $details_id);
                $stmt->execute();
            }
        }

        // Commit transaction
        $conn->commit();

        // Return JSON success response
        echo json_encode([
            'status' => 'success',
            'message' => 'Data successfully submitted!'
        ]);
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();

        // Return JSON error response
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}
?>
