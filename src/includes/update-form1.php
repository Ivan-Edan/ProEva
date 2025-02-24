<?php
include 'config.php'; // Ensure DB connection

$data = json_decode(file_get_contents("php://input"), true);

// Debugging Output
file_put_contents("debug_log.txt", print_r($data, true));

if (!$data || !isset($data['details_id'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields: details_id is required"]);
    exit;
}

$details_id = $data['details_id'];

$conn->begin_transaction();

try {
    $stmtArray = [];

    // Update Location (Only if fields are provided)
    if (!empty($data['location']) && !empty($data['city']) && !empty($data['barangay'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userlocation SET location = ?, city = ?, barangay = ? WHERE location_id = (SELECT location_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["sssi", $data['location'], $data['city'], $data['barangay'], $details_id]
        ];
    }

    // Update Start and End Dates
    if (!empty($data['start_date']) && !empty($data['end_date'])) {
        $stmtArray[] = [
            "sql" => "UPDATE usersdateedate SET start_date = ?, end_date = ? WHERE s_date_e_date_id = (SELECT s_date_e_date_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["ssi", $data['start_date'], $data['end_date'], $details_id]
        ];
    }

    // Update Yearly Financial and Physical Targets
    if (isset($data['year_financial_target']) && isset($data['year_phy_target_percent'])) {
        $stmtArray[] = [
            "sql" => "UPDATE useryeartargets SET year_financial_target = ?, year_phy_target_percent = ? WHERE year_targets_id = (SELECT year_targets_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["dii", (float)$data['year_financial_target'], (int)$data['year_phy_target_percent'], $details_id]
        ];
    }

    // Update Project Validation
    if (!empty($data['submitted_designation']) && !empty($data['submitted_by'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userprojectvalidation SET submitted_designation = ?, submitted_by = ? WHERE project_validation_id = (SELECT project_validation_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["ssi", $data['submitted_designation'], $data['submitted_by'], $details_id]
        ];
    }

    if (isset($data['male']) && isset($data['female'])) {
        $stmtArray[] = [
            "sql" => "UPDATE usertargetemployee SET male = ?, female = ? WHERE target_employee_id = (SELECT target_employee_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["iii", (int)$data['male'], (int)$data['female'], $details_id]
        ];
    }

    // Update Implementing Agency in `userimplementingagency`
    if (!empty($data['implementing_agency'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userimplementingagency 
                    SET implementing_agency = ? 
                    WHERE implementing_agency_id = (SELECT implementing_agency_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["si", $data['implementing_agency'], $details_id]
        ];
    }

    // Update Other FK-Referenced Tables
    if (!empty($data['sector'])) {
        $stmtArray[] = [
            "sql" => "UPDATE usersector 
                    SET sector = ? 
                    WHERE sector_id = (SELECT sector_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["si", $data['sector'], $details_id]
        ];
    }

    if (!empty($data['mode_of_implementation'])) {
        $stmtArray[] = [
            "sql" => "UPDATE usermodeofimplementation 
                    SET mode_of_implementation = ? 
                    WHERE mode_of_implementation_id = (SELECT mode_of_implementation_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["si", $data['mode_of_implementation'], $details_id]
        ];
    }

    if (isset($data['total_cost'])) {
        $stmtArray[] = [
            "sql" => "UPDATE usertotalcost 
                    SET total_cost = ? 
                    WHERE total_cost_id = (SELECT total_cost_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["di", (float)$data['total_cost'], $details_id]
        ];
    }

    if (!empty($data['fund_agency'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userfundagency 
                    SET fund_agency = ? 
                    WHERE fund_agency_id = (SELECT fund_agency_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["si", $data['fund_agency'], $details_id]
        ];
    }

    if (!empty($data['fund_source'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userfundsource 
                    SET fund_source = ? 
                    WHERE fund_source_id = (SELECT fund_source_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["si", $data['fund_source'], $details_id]
        ];
    }

    if (!empty($data['comp_details'])) {
        $stmtArray[] = [
            "sql" => "UPDATE usercompdetails 
                    SET comp_details = ? 
                    WHERE comp_details_id = (SELECT comp_details_id FROM initialprojectreport WHERE details_id = ?)",
            "params" => ["si", $data['comp_details'], $details_id]
        ];
    }

    if (!empty($data['output_indicators'])) {
        // Convert the comma-separated string back to an array
        $indicators = explode(', ', $data['output_indicators']);
    
        foreach ($indicators as $position => $indicator) {
            $stmtArray[] = [
                "sql" => "UPDATE useroutputindicator 
                        SET output_indicator = ? 
                        WHERE details_id = ? AND output_indicator_position = ?",
                "params" => ["sii", $indicator, $details_id, $position + 1] // Assuming position starts from 1
            ];
        }
    }
    if (!empty($data['target_outputs'])) {
        // Convert the comma-separated string back to an array
        $targets = explode(', ', $data['target_outputs']);
    
        foreach ($targets as $position => $target) {
            $stmtArray[] = [
                "sql" => "UPDATE usertargetoutput 
                        SET target_output = ? 
                        WHERE target_output_id = (
                            SELECT target_output_id FROM usertargetoutput 
                            WHERE details_id = ? 
                            ORDER BY target_output_id ASC 
                            LIMIT 1 OFFSET ?
                        )",
                "params" => ["sii", $target, $details_id, $position]
            ];
        }
    }
    
    if (!empty($data['monthly_targets']) && is_array($data['monthly_targets'])) {
        foreach ($data['monthly_targets'] as $target) {
            $stmtArray[] = [
                "sql" => "UPDATE usermtytarget 
                        SET financial_target = ?, physical_target_percent = ? 
                        WHERE details_id = ? AND mty_target_position = ?",
                "params" => ["ddis", 
                            (float) $target['financial'], 
                            (float) $target['physical'], 
                            $details_id, 
                            $target['month']] // ✅ Use month to determine position
            ];
        }
    }
    if (!empty($stmtArray)) { // ✅ Ensures at least one update query was added
        $stmtArray[] = [
            "sql" => "UPDATE initialprojectreport 
                    SET status = 'pending' 
                    WHERE details_id = ? AND status = 'rejected'",
            "params" => ["i", $details_id]
        ];
    }
    
    

    // Execute only the queries that have data
    foreach ($stmtArray as $stmtData) {
        $stmt = $conn->prepare($stmtData["sql"]);
        $stmt->bind_param(...$stmtData["params"]);
        $stmt->execute();
        $stmt->close();
    }

    $conn->commit();
    echo json_encode(["success" => true, "message" => "Update completed successfully"]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["success" => false, "message" => "Transaction failed: " . $e->getMessage()]);
}

$conn->close();
?>
