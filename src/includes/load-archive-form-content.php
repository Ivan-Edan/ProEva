<?php
// Include database configuration
include 'config.php';
session_start();

// Set JSON response
header('Content-Type: application/json');

try {
    // Capture formType and submissionId from GET parameters
    $formType = isset($_GET['formType']) ? $_GET['formType'] : '';
    $submissionId = isset($_GET['submissionId']) ? intval($_GET['submissionId']) : 0;

    // Validate parameters
    if (!$formType || !$submissionId) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
        exit;
    }

    // Check user role
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

    if (!$userId || !$role) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
        exit;
    }

    // Initialize query
    $query = '';
    $params = [];
    $types = 'i'; // Placeholder for submissionId parameter

    // Handle form-specific queries
    switch ($formType) {
        case 'form1': // Form 1: Initial Project Report
            $query = "
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
                        FROM useroutputindicator oi
                        WHERE oi.details_id = ipr.details_id) AS output_indicators,

                        (SELECT GROUP_CONCAT(oi.output_indicator_position ORDER BY oi.output_indicator_position SEPARATOR ', ')
                        FROM useroutputindicator oi
                        WHERE oi.details_id = ipr.details_id) AS output_positions,

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
                        FROM usertargetoutput to1
                        WHERE to1.details_id = ipr.details_id) AS target_outputs,

                        -- Project Validation
                        pv.submitted_designation,
                        pv.submitted_by

                    FROM initialprojectreport ipr

                    -- Joins (One-to-One relationships)
                    LEFT JOIN userprojecttitle pt ON ipr.project_id = pt.project_id
                    LEFT JOIN userimplementingagency ia ON ipr.implementing_agency_id = ia.implementing_agency_id
                    LEFT JOIN usersector sc ON ipr.sector_id = sc.sector_id
                    LEFT JOIN usermodeofimplementation mi ON ipr.mode_of_implementation_id = mi.mode_of_implementation_id
                    LEFT JOIN userlocation loc ON ipr.location_id = loc.location_id
                    LEFT JOIN usertotalcost tc ON ipr.total_cost_id = tc.total_cost_id
                    LEFT JOIN usersdateedate sd ON ipr.s_date_e_date_id = sd.s_date_e_date_id
                    LEFT JOIN userfundagency fa ON ipr.fund_agency_id = fa.fund_agency_id
                    LEFT JOIN userfundsource fs ON ipr.fund_source_id = fs.fund_source_id
                    LEFT JOIN usertargetemployee te ON ipr.target_employee_id = te.target_employee_id
                    LEFT JOIN usercompdetails cd ON ipr.comp_details_id = cd.comp_details_id
                    LEFT JOIN useryeartargets yt ON ipr.year_targets_id = yt.year_targets_id
                    LEFT JOIN userremarks r ON ipr.remarks_id = r.remarks_id
                    LEFT JOIN userprojectvalidation pv ON ipr.project_validation_id = pv.project_validation_id
                WHERE ipr.details_id = ? AND ipr.status = 'approved'
            ";
            $params[] = $submissionId;
            break;

        case 'form2': // Form 2: Physical and Financial Accomplishments
            $query = "
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
                WHERE fp.form2_id = ? AND fp.status = 'approved'
            ";
            $params[] = $submissionId;
            break;

        case 'form3': // Form 3: Exception Report
            $query = "
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
                LEFT JOIN userform3addidetails fd ON ex.Addi_form3_details_id = fd.Addi_form3_details_id
                LEFT JOIN userprojectvalidation pv ON ex.project_validation_id = pv.project_validation_id
                WHERE ex.form3_id = ? AND ex.status = 'approved'
            ";
            $params[] = $submissionId;
            break;

        case 'form4': // Form 4: Project Results
            $query = "
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
                WHERE pr.form4_id = ? AND pr.status = 'approved'
            ";
            $params[] = $submissionId;
            break;
        case 'adminform1':
            $query = "
                SELECT
                    adminForm1_id AS submission_id,
                    project_title,
                    implementing_agency,
                    start_date,
                    end_date,
                    sector,
                    fund_source,
                    funding_agency,
                    total_project_cost,
                    appropriations,
                    allotment,
                    obligations,
                    disbursements,
                    funding_support,
                    fund_utilization,
                    target_owpa,
                    actual_owpa,
                    slippage,
                    male,
                    female,
                    remarks,
                    submitted_by,
                    designation_office,
                    submission_date,
                    created_at
                FROM adminform1
                WHERE adminForm1_id = ? 
            ";
            $params[] = $submissionId;
        
            if ($role === 'user') {
                $query .= " AND user_id = ?"; // Ensure only the user's forms are visible
                $params[] = $userId;
                $types .= 'i';
            }
            break;

        case 'adminform2':
            $query = "
                SELECT
                    adminForm2_id AS submission_id,
                    project_title,
                    location,
                    implementing_agency,
                    fund_utilization,
                    target_owpa,
                    actual_owpa,
                    slippage,
                    issue_details,
                    issue_typology,
                    issue_status,
                    source_of_information,
                    action_taken,
                    actions_to_be_taken,
                    for_npmc_action,
                    requested_action_from_npmc,
                    submitted_by,
                    designation_office,
                    submission_date,
                    created_at
                FROM adminform2
                WHERE adminForm2_id = ?
            ";
            $params[] = $submissionId;
            $types = 'i'; // Integer for adminForm2_id
            break;

            case 'adminform3':
                $query = "
                    SELECT
                        adminForm3_id AS submission_id,
                        project_title,
                        total_cost,
                        location,
                        implementing_agency,
                        date_of_inspection,
                        details_on_site_inspected,
                        findings,
                        issues,
                        action_taken,
                        actions_to_be_taken,
                        submitted_by,
                        designation_office,
                        submission_date,
                        created_at
                    FROM adminform3
                    WHERE adminForm3_id = ?
                ";
                $params[] = $submissionId;
                $types = 'i'; // Integer for adminForm3_id
                break;
                case 'adminform4':
                    $query = "
                        SELECT
                            adminForm4_id AS submission_id,
                            project_title,
                            issue_details,
                            issue_typology,
                            location,
                            implementing_agency,
                            date_of_meeting,
                            concerned_agency,
                            agreements_reached,
                            submitted_by,
                            designation_office,
                            submission_date,
                            created_at
                        FROM adminform4
                        WHERE adminForm4_id = ?
                    ";
                    $params[] = $submissionId;
                    $types = 'i'; // Integer for adminForm4_id
                    break;

                    case 'adminform5':
                        $query = "
                            SELECT 
                                af.adminForm5_id AS submission_id,
                                af.training_title,
                                af.training_objective,
                                af.training_date,
                                af.conducted_facilitated_attended,
                                af.lead_office_unit,
                                af.participating_offices,
                                af.male,
                                af.female,
                                af.total,
                                af.results_feedback,
                                af.submitted_by,
                                af.designation_office,
                                af.submission_date,
                                af.created_at
                            FROM adminform5 af
                            WHERE af.adminForm5_id = ?
                        ";
                        $params[] = $submissionId;
                        $types = 'i'; // Integer for adminForm5_id
                        break;
                        case 'adminform6':
                            $query = "
                                SELECT 
                                    adminForm6_id AS submission_id,
                                    resolution_number,
                                    resolution_title,
                                    date_approved,
                                    resolution,
                                    resolution_link,
                                    submitted_by,
                                    designation_office,
                                    submission_date,
                                    created_at
                                FROM adminform6
                                WHERE adminForm6_id = ?
                            ";
                            $params[] = $submissionId;
                            $types = 'i'; // Integer for adminForm6_id
                            break;

                            case 'adminform7':
                                $query = "
                                    SELECT
                                        adminForm7_id AS submission_id,
                                        project_title,
                                        location,
                                        implementing_agency,
                                        nature,
                                        details,
                                        strategies,
                                        responsible_entity,
                                        lesson_learned,
                                        submitted_by,
                                        designation_office,
                                        submission_date,
                                        created_at
                                    FROM adminform7
                                    WHERE adminForm7_id = ?
                                ";
                                $params[] = $submissionId;
                                $types = 'i'; // Integer for adminForm7_id
                                break;
                            
        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid form type']);
            exit;
    }

    // Prepare and execute query
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data
    if ($row = $result->fetch_assoc()) {
        echo json_encode(['status' => 'success', 'data' => $row]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data found']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
