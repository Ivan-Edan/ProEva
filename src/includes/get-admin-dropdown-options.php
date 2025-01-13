<?php
// Database configuration
include 'config.php';

// Set response to JSON format
header('Content-Type: application/json');

try {
    // Capture form type
    $formType = isset($_GET['formType']) ? $_GET['formType'] : null;

    // Validate input
    if (!$formType) {
        echo json_encode(['status' => 'error', 'message' => 'Form type is required.']);
        exit;
    }

    // Query for adminform1
    if ($formType === 'adminform1') {
        $query = "
            SELECT 
                pt.project_id,
                pt.project_title,
                pt.project_year,
                ia.implementing_agency,
                sde.start_date,
                sde.end_date,
                s.sector,
                fs.fund_source,
                fa.fund_agency,
                tc.total_cost,
                fs2.appropriations,
                fs2.allotment,
                fs2.obligations,
                fs2.disbursements,
                ROUND((fs2.appropriations / NULLIF(fs2.allotment, 0)) * 100, 2) AS funding_support,
                ROUND((fs2.disbursements / NULLIF(fs2.allotment, 0)) * 100, 2) AS fund_utilization,
                pa.target_owpa,
                pa.actual_owpa,
                (pa.actual_owpa - pa.target_owpa) AS slippage,
                te.male,
                te.female,
                r.remarks
            FROM userprojecttitle pt
            LEFT JOIN initialprojectreport ipr ON pt.project_id = ipr.project_id
            LEFT JOIN userimplementingagency ia ON ipr.implementing_agency_id = ia.implementing_agency_id
            LEFT JOIN usersdateedate sde ON ipr.s_date_e_date_id = sde.s_date_e_date_id
            LEFT JOIN usersector s ON ipr.sector_id = s.sector_id
            LEFT JOIN userfundsource fs ON ipr.fund_source_id = fs.fund_source_id
            LEFT JOIN userfundagency fa ON ipr.fund_agency_id = fa.fund_agency_id
            LEFT JOIN usertotalcost tc ON ipr.total_cost_id = tc.total_cost_id
            LEFT JOIN userphysfinaccompreport pfar ON pt.project_id = pfar.project_id
            LEFT JOIN userfinancialstatus fs2 ON pfar.financial_status_id = fs2.financial_status_id
            LEFT JOIN userphysaccomplishments pa ON pfar.Phys_Accomplishment_id = pa.Phys_Accomplishment_id
            LEFT JOIN usertargetemployee te ON ipr.target_employee_id = te.Target_employee_id
            LEFT JOIN userremarks r ON ipr.remarks_id = r.remarks_id
            WHERE ipr.status = 'approved' -- Filter for approved projects
            GROUP BY pt.project_id
            ORDER BY sde.start_date DESC;

        ";
        

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $options = [];
        while ($row = $result->fetch_assoc()) {
            $options[] = [
                'label' => $row['project_title'] . ' (' . $row['project_year'] . ')',
                'value' => $row['project_id'],
                'data'  => $row
            ];
        }
        echo json_encode(['status' => 'success', 'options' => $options]);
    }

    elseif ($formType === 'adminform2') {
        $query = "
            SELECT
                pt.project_id,
                pt.project_title,
                pt.project_year,
                CONCAT(l.location, ', ', l.city, ', ', l.barangay) AS location, -- Combined location
                ia.implementing_agency,
                ROUND((fs.disbursements / NULLIF(fs.allotment, 0)) * 100, 2) AS fund_utilization,
                pa.target_owpa,
                pa.actual_owpa,
                (pa.actual_owpa - pa.target_owpa) AS slippage
            FROM userprojecttitle pt
            LEFT JOIN initialprojectreport ipr ON pt.project_id = ipr.project_id
            LEFT JOIN userlocation l ON ipr.location_id = l.location_id
            LEFT JOIN userimplementingagency ia ON ipr.implementing_agency_id = ia.implementing_agency_id
            LEFT JOIN userphysfinaccompreport pfar ON pt.project_id = pfar.project_id
            LEFT JOIN userfinancialstatus fs ON pfar.financial_status_id = fs.financial_status_id
            LEFT JOIN userphysaccomplishments pa ON pfar.Phys_Accomplishment_id = pa.Phys_Accomplishment_id
            WHERE ipr.status = 'approved' -- Filter for approved projects
            GROUP BY pt.project_id
            ORDER BY pt.project_title, l.location;
        ";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $options = [];
        while ($row = $result->fetch_assoc()) {
            $options[] = [
                'label' => $row['project_title'] . ' (' . $row['project_year'] . ')',
                'value' => $row['project_id'],
                'data'  => $row
            ];
        }

        echo json_encode(['status' => 'success', 'options' => $options]);
    }

    elseif ($formType === 'adminform3') {
        $query = "
                SELECT
            pt.project_id,
            pt.project_title,
            pt.project_year,
            tc.total_cost,
            CONCAT(loc.location, ', ', loc.city, ', ', loc.barangay) AS location,
            ia.implementing_agency
        FROM userprojecttitle pt
        LEFT JOIN initialprojectreport ipr ON pt.project_id = ipr.project_id
        LEFT JOIN usertotalcost tc ON ipr.total_cost_id = tc.total_cost_id
        LEFT JOIN userlocation loc ON ipr.location_id = loc.location_id
        LEFT JOIN userimplementingagency ia ON ipr.implementing_agency_id = ia.implementing_agency_id
        WHERE ipr.status = 'approved' -- Filter for approved projects
        ORDER BY pt.project_title;
        ";
    // Execute the query
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $options = [];
    while ($row = $result->fetch_assoc()) {
        $options[] = [
            'label' => $row['project_title'] . ' (' . ($row['project_year'] ?? 'No Year') . ')',
            'value' => $row['project_id'],
            'data'  => $row
        ];
    }

    // Return the results
    echo json_encode(['status' => 'success', 'options' => $options]);
    }

    // Query for Admin Form 4 (formerly Form 8)
    elseif ($formType === 'adminform4') {
        $query = "
            SELECT
                pt.project_id,
                pt.project_title,
                pt.project_year,
                CONCAT(loc.location, ', ', loc.city, ', ', loc.barangay) AS location, -- Combined location
                ia.implementing_agency
            FROM userprojecttitle pt
            LEFT JOIN initialprojectreport ipr ON pt.project_id = ipr.project_id
            LEFT JOIN userlocation loc ON ipr.location_id = loc.location_id
            LEFT JOIN userimplementingagency ia ON ipr.implementing_agency_id = ia.implementing_agency_id
            WHERE ipr.status = 'approved' -- Filter for approved projects
            GROUP BY pt.project_id
            ORDER BY pt.project_title;

        ";

    // Execute the query
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $options = [];
    while ($row = $result->fetch_assoc()) {
        $options[] = [
            'label' => $row['project_title'] . ' (' . ($row['project_year'] ?? 'No year') . ')',
            'value' => $row['project_id'],
            'data'  => $row
        ];
    }

    // Return the results
    echo json_encode(['status' => 'success', 'options' => $options]);
    }

    else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid form type.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
