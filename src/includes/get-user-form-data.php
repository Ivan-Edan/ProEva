<?php

// Include database configuration
include 'config.php';

// Set JSON response
header('Content-Type: application/json');

try {
    $formType = $_GET['formType'] ?? '';
    $submissionId = intval($_GET['submissionId'] ?? 0);

    if (!$formType || !$submissionId) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
        exit;
    }

    // Define query mappings for different form types based on schema
    $queries = [
        // User Forms
        'form1' => "
                    SELECT
                        -- Project Details
                        ipr.details_id, -- Unique ID for each submission
                        pt.project_title,
                        ia.implementing_agency,
                        sc.sector,
                        mi.mode_of_implementation,
                        loc.location,
                        loc.city,
                        loc.barangay,

                        -- Cost and Dates
                        tc.total_cost,
                        sd.start_date,
                        sd.end_date,

                        -- Funding Information
                        fa.fund_agency,
                        fs.fund_source,

                        -- Target Employment
                        te.male,
                        te.female,

                        -- Additional Details
                        cd.comp_details,
                        yt.year_financial_target,
                        yt.year_phy_target_percent,
                        r.remarks,

                        -- Output Indicators (Pre-aggregated)
                        (SELECT GROUP_CONCAT(oi.output_indicator ORDER BY oi.output_indicator_position SEPARATOR ', ')
                        FROM UserOutputIndicator oi
                        WHERE oi.details_id = ipr.details_id) AS output_indicators,

                        -- Monthly Targets (Pre-aggregated)
                        (SELECT GROUP_CONCAT(mt.period_start ORDER BY mt.mty_target_id SEPARATOR ', ')
                        FROM usermtytarget mt
                        WHERE mt.details_id = ipr.details_id) AS mt_period_starts,

                        (SELECT GROUP_CONCAT(mt.period_end ORDER BY mt.mty_target_id SEPARATOR ', ')
                        FROM usermtytarget mt
                        WHERE mt.details_id = ipr.details_id) AS mt_period_ends,

                        (SELECT GROUP_CONCAT(mt.financial_target ORDER BY mt.mty_target_id SEPARATOR ', ')
                        FROM usermtytarget mt
                        WHERE mt.details_id = ipr.details_id) AS mt_financial_targets,

                        (SELECT GROUP_CONCAT(mt.physical_target_percent ORDER BY mt.mty_target_id SEPARATOR ', ')
                        FROM usermtytarget mt
                        WHERE mt.details_id = ipr.details_id) AS mt_physical_targets,

                        -- Target Outputs (Pre-aggregated)
                        (SELECT GROUP_CONCAT(to1.Target_output ORDER BY to1.Target_output_id SEPARATOR ', ')
                        FROM UserTargetOutput to1
                        WHERE to1.details_id = ipr.details_id) AS target_outputs,

                        -- Project Validation
                        pv.submitted_designation,
                        pv.submitted_by

                    FROM InitialProjectReport ipr

                    -- Joins (One-to-One relationships)
                    LEFT JOIN UserProjectTitle pt ON ipr.project_id = pt.project_id
                    LEFT JOIN UserImplementingAgency ia ON ipr.implementing_agency_id = ia.implementing_agency_id
                    LEFT JOIN UserSector sc ON ipr.sector_id = sc.sector_id
                    LEFT JOIN UserModeOfImplementation mi ON ipr.mode_of_implementation_id = mi.mode_of_implementation_id
                    LEFT JOIN UserLocation loc ON ipr.location_id = loc.location_id
                    LEFT JOIN UserTotalCost tc ON ipr.total_cost_id = tc.total_cost_id
                    LEFT JOIN UserSDateEDate sd ON ipr.s_date_e_date_id = sd.s_date_e_date_id
                    LEFT JOIN UserFundAgency fa ON ipr.fund_agency_id = fa.fund_agency_id
                    LEFT JOIN UserFundSource fs ON ipr.fund_source_id = fs.fund_source_id
                    LEFT JOIN UserTargetEmployee te ON ipr.target_employee_id = te.target_employee_id
                    LEFT JOIN UserCompDetails cd ON ipr.comp_details_id = cd.comp_details_id
                    LEFT JOIN UserYearTargets yt ON ipr.year_targets_id = yt.year_targets_id
                    LEFT JOIN UserRemarks r ON ipr.remarks_id = r.remarks_id
                    LEFT JOIN UserProjectValidation pv ON ipr.project_validation_id = pv.project_validation_id
                WHERE ipr.details_id = ?
        ",
        'form2' => "
                SELECT
                        pt.project_title,
                        ia.implementing_agency, -- Fetch implementing agency
                        fs.appropriations,
                        fs.allotment,
                        fs.obligations,
                        fs.disbursements,
                        pa.target_owpa,
                        pa.actual_owpa,
                        pa.slippage,
                        oi.output_indicator, -- Output indicator
                        ad.end_project_target,
                        ad.target_date,
                        ad.actual_date,
                        te.male,
                        te.female,
                        r.remarks,
                        pv.submitted_designation,
                        pv.submitted_by,
                        sed.start_date,
                        sed.end_date,
                        fsr.fund_source,
                        fa.fund_agency,
                        tc.total_cost -- Newly added fields
                    FROM userphysfinaccompreport fp
                    LEFT JOIN userprojecttitle pt ON fp.project_id = pt.project_id
                    LEFT JOIN userimplementingagency ia ON fp.implementing_agency_id = ia.implementing_agency_id
                    LEFT JOIN userfinancialstatus fs ON fp.financial_status_id = fs.financial_status_id
                    LEFT JOIN userphysaccomplishments pa ON fp.Phys_Accomplishment_id = pa.Phys_Accomplishment_id
                    LEFT JOIN useroutputindicator oi ON pa.output_indicator_id = oi.output_indicator_id
                    LEFT JOIN useraddidetails ad ON fp.addi_details_id = ad.addi_details_id
                    LEFT JOIN usertargetemployee te ON fp.target_employee_id = te.target_employee_id
                    LEFT JOIN userremarks r ON fp.remarks_id = r.remarks_id
                    LEFT JOIN userprojectvalidation pv ON fp.project_validation_id = pv.project_validation_id
                    LEFT JOIN usersdateedate sed ON fp.s_date_e_date_id = sed.s_date_e_date_id -- Start & End Date
                    LEFT JOIN userfundsource fsr ON fp.fund_source_id = fsr.fund_source_id -- Fund Source
                    LEFT JOIN userfundagency fa ON fp.fund_agency_id = fa.fund_agency_id -- Fund Agency
                    LEFT JOIN usertotalcost tc ON fp.total_cost_id = tc.total_cost_id -- Total Cost
                WHERE fp.form2_id = ?
        ",
        'form3' => "
               SELECT
                    pt.project_title,
                    ia.implementing_agency,
                    sc.sector AS sector, -- Sector name from sector table
        
                    -- Location details
                    loc.location,
                    loc.city,
                    loc.barangay,
        
                    -- Additional Details
                    fd.findings,
                    fd.typology,
                    fd.issue_status,
                    fd.reasons,
                    fd.actions_taken,
                    fd.actions_to_be_taken,
        
                    -- Project Validation
                    pv.submitted_designation,
                    pv.submitted_by
        
                FROM userprojectexptrprt ex
                LEFT JOIN userprojecttitle pt ON ex.project_id = pt.project_id
                LEFT JOIN userimplementingagency ia ON ex.implementing_agency_id = ia.implementing_agency_id
                LEFT JOIN usersector sc ON ex.sector_id = sc.sector_id -- Sector table join
                LEFT JOIN userlocation loc ON ex.location_id = loc.location_id -- Location table join
                LEFT JOIN UserForm3AddiDetails fd ON ex.Addi_form3_details_id = fd.Addi_form3_details_id
                LEFT JOIN userprojectvalidation pv ON ex.project_validation_id = pv.project_validation_id
                WHERE ex.form3_id = ?
        ",
        'form4' => "
            SELECT
                    pt.project_title,
                    ia.implementing_agency,
                    pr.objectives,
                    pr.result_indicator,
                    pr.observe_results,
                    pv.submitted_designation,
                    pv.submitted_by
                FROM userprojectresult pr
                LEFT JOIN userprojecttitle pt ON pr.project_id = pt.project_id
                LEFT JOIN userimplementingagency ia ON pr.implementing_agency_id = ia.implementing_agency_id
                LEFT JOIN userprojectvalidation pv ON pr.project_validation_id = pv.project_validation_id
                WHERE pr.form4_id = ?
        ",

        // Add similar detailed queries for adminform3, adminform4, etc., following the schema
    ];

    // Check if the form type exists in the mappings
    if (!isset($queries[$formType])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid form type']);
        exit;
    }

    // Fetch data for the form type
    $query = $queries[$formType];
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Query preparation failed']);
        exit;
    }

    // Bind the parameter
    $stmt->bind_param('i', $submissionId);
    $stmt->execute();

    // Get result and fetch data
    $result = $stmt->get_result();

    if ($result) {
        $data = $result->fetch_assoc();
        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Query execution failed']);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
