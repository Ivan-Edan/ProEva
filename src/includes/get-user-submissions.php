<?php

// Include database configuration
// this is the admin side of the subission forms table
include 'config.php';

// Set JSON response
header('Content-Type: application/json');

try {
    // Capture and validate input parameters
    $formType = isset($_GET['formType']) ? $_GET['formType'] : 'all'; 
    $submissionId = isset($_GET['submissionId']) ? intval($_GET['submissionId']) : 0; 

    // Initialize query
    $query = '';

    // Handle 'all' form types or specific form types
    if ($formType === 'all') {
        $query = "
            SELECT 
                ipr.details_id AS submission_id, -- Form 1 ID
                pt.project_title,
                pt.project_year,
                COALESCE(d.name, 'Not Specified') AS department_name,
                'form1' AS form_type,
                ipr.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN initialprojectreport ipr ON pt.project_id = ipr.project_id
            LEFT JOIN users u ON ipr.user_id = u.id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE ipr.status = 'pending'
        
            UNION ALL
        
            SELECT 
                fs.Form2_id AS submission_id, -- Form 2 ID
                pt.project_title,
                pt.project_year,
                COALESCE(d.name, 'Not Specified') AS department_name,
                'form2' AS form_type,
                fs.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN userphysfinaccompreport fs ON pt.project_id = fs.project_id
            LEFT JOIN users u ON fs.user_id = u.id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE fs.status = 'pending'
        
            UNION ALL
        
            SELECT 
                ex.form3_id AS submission_id, -- Form 3 ID
                pt.project_title,
                pt.project_year,
                COALESCE(d.name, 'Not Specified') AS department_name,
                'form3' AS form_type,
                ex.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN userprojectexptrprt ex ON pt.project_id = ex.project_id
            LEFT JOIN users u ON ex.user_id = u.id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE ex.status = 'pending'
        
            UNION ALL
        
            SELECT 
                pr.form4_id AS submission_id, -- Form 4 ID
                pt.project_title,
                pt.project_year,
                COALESCE(d.name, 'Not Specified') AS department_name,
                'form4' AS form_type,
                pr.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN userprojectresult pr ON pt.project_id = pr.project_id
            LEFT JOIN users u ON pr.user_id = u.id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE pr.status = 'pending'
        
            ORDER BY date_submitted DESC;
        ";

    } else {
        // Handle specific form types
        $queryBase = "
            SELECT 
                {table}.{idField} AS submission_id, -- Unique ID
                pt.project_title,
                pt.project_year,
                COALESCE(d.name, 'Not Specified') AS department_name,
                '{$formType}' AS form_type,
                {table}.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN {table} ON pt.project_id = {table}.project_id
            LEFT JOIN users u ON {table}.user_id = u.id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE {table}.status = 'pending'
            ORDER BY {table}.created_at DESC;
        ";
    
        $tableMap = [
            'form1' => ['table' => 'initialprojectreport', 'id' => 'details_id'],
            'form2' => ['table' => 'userphysfinaccompreport', 'id' => 'Form2_id'],
            'form3' => ['table' => 'userprojectexptrprt', 'id' => 'form3_id'],
            'form4' => ['table' => 'userprojectresult', 'id' => 'form4_id']
        ];
        

        if (isset($tableMap[$formType])) {
            $query = str_replace('{table}', $tableMap[$formType]['table'], $queryBase);
            $query = str_replace('{idField}', $tableMap[$formType]['id'], $query);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid form type.']);
            exit;
        }
        
    }

    // Prepare and execute query
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare data for response
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'submission_id' => $row['submission_id'], 
            'project_name' => $row['project_title'] . ' (' . $row['project_year'] . ')',
            'department' => $row['department_name'],
            'date_submitted' => $row['date_submitted'],
            'form_type' => $row['form_type'] 
        ];
    }

    // Return results
    if (count($data) > 0) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'success', 'data' => []]);
    }

} catch (Exception $e) {
    // Handle exceptions
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>
