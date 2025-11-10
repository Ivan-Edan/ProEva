<?php
include 'config.php'; // Ensure DB connection

$data = json_decode(file_get_contents("php://input"), true);

// Debugging Output
file_put_contents("debug_log_form2.txt", print_r($data, true));

if (!$data || !isset($data['form2_id'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields: form2_id is required"]);
    exit;
}

$form2_id = $data['form2_id'];

$conn->begin_transaction();

try {
    $stmtArray = [];

    // Update Implementing Agency
    if (!empty($data['implementing_agency'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userimplementingagency SET implementing_agency = ? WHERE implementing_agency_id = (SELECT implementing_agency_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["si", $data['implementing_agency'], $form2_id]
        ];
    }

    // Update Financial Status (Appropriations, Allotment, Obligations, Disbursements)
    if (isset($data['appropriations'], $data['allotment'], $data['obligations'], $data['disbursements'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userfinancialstatus SET appropriations = ?, allotment = ?, obligations = ?, disbursements = ? WHERE financial_status_id = (SELECT financial_status_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["ddddi", $data['appropriations'], $data['allotment'], $data['obligations'], $data['disbursements'], $form2_id]
        ];
    }

    // Update Physical Accomplishments (Target OWPA, Actual OWPA, Slippage)
    if (isset($data['target_owpa'], $data['actual_owpa'], $data['slippage'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userphysaccomplishments SET target_owpa = ?, actual_owpa = ?, slippage = ? WHERE Phys_Accomplishment_id = (SELECT Phys_Accomplishment_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["dddi", $data['target_owpa'], $data['actual_owpa'], $data['slippage'], $form2_id]
        ];
    }

    // Update Output Indicator
    if (!empty($data['output_indicator'])) {
        $stmtArray[] = [
            "sql" => "UPDATE useroutputindicator SET output_indicator = ? WHERE output_indicator_id = (SELECT output_indicator_id FROM userphysaccomplishments WHERE Phys_Accomplishment_id = (SELECT Phys_Accomplishment_id FROM userphysfinaccompreport WHERE form2_id = ?))",
            "params" => ["si", $data['output_indicator'], $form2_id]
        ];
    }

    // Update Additional Details (End Project Target, Target Date, Actual Date)
    if (!empty($data['end_project_target']) && !empty($data['target_date']) && !empty($data['actual_date'])) {
        $stmtArray[] = [
            "sql" => "UPDATE useraddidetails SET end_project_target = ?, target_date = ?, actual_date = ? WHERE addi_details_id = (SELECT addi_details_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["sssi", $data['end_project_target'], $data['target_date'], $data['actual_date'], $form2_id]
        ];
    }

    // Update Employment Data (Male & Female Employees)
    if (isset($data['male'], $data['female'])) {
        $stmtArray[] = [
            "sql" => "UPDATE usertargetemployee SET male = ?, female = ? WHERE target_employee_id = (SELECT target_employee_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["iii", $data['male'], $data['female'], $form2_id]
        ];
    }

    // Update Remarks
    if (!empty($data['remarks'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userremarks SET remarks = ? WHERE remarks_id = (SELECT remarks_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["si", $data['remarks'], $form2_id]
        ];
    }

    // Update Project Validation (Submitted Designation, Submitted By)
    if (!empty($data['submitted_designation']) && !empty($data['submitted_by'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userprojectvalidation SET submitted_designation = ?, submitted_by = ? WHERE project_validation_id = (SELECT project_validation_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["ssi", $data['submitted_designation'], $data['submitted_by'], $form2_id]
        ];
    }

    // Update Start & End Dates
    if (!empty($data['start_date']) && !empty($data['end_date'])) {
        $stmtArray[] = [
            "sql" => "UPDATE usersdateedate SET start_date = ?, end_date = ? WHERE s_date_e_date_id = (SELECT s_date_e_date_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["ssi", $data['start_date'], $data['end_date'], $form2_id]
        ];
    }

    // Update Fund Source
    if (!empty($data['fund_source'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userfundsource SET fund_source = ? WHERE fund_source_id = (SELECT fund_source_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["si", $data['fund_source'], $form2_id]
        ];
    }

    // Update Fund Agency
    if (!empty($data['fund_agency'])) {
        $stmtArray[] = [
            "sql" => "UPDATE userfundagency SET fund_agency = ? WHERE fund_agency_id = (SELECT fund_agency_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["si", $data['fund_agency'], $form2_id]
        ];
    }

    // Update Total Cost
    if (isset($data['total_cost'])) {
        $stmtArray[] = [
            "sql" => "UPDATE usertotalcost SET total_cost = ? WHERE total_cost_id = (SELECT total_cost_id FROM userphysfinaccompreport WHERE form2_id = ?)",
            "params" => ["di", (float)$data['total_cost'], $form2_id]
        ];
    }
    
    $stmtArray[] = [
        "sql" => "UPDATE userphysfinaccompreport SET status = 'pending' WHERE form2_id = ? AND status = 'rejected'",
        "params" => ["i", $form2_id]
    ];

    // Execute all update queries
    foreach ($stmtArray as $stmtData) {
        $stmt = $conn->prepare($stmtData["sql"]);
        $stmt->bind_param(...$stmtData["params"]);
        $stmt->execute();
        $stmt->close();
    }

    $conn->commit();
    echo json_encode(["success" => true, "message" => "Form 2 updated successfully"]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["success" => false, "message" => "Transaction failed: " . $e->getMessage()]);
}

$conn->close();
?>
