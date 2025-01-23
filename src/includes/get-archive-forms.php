<?php

// Include database configuration
include 'config.php';

// Set JSON response
header('Content-Type: application/json');

try {
    // Capture and validate input parameters
    $formType = isset($_GET['formType']) ? $_GET['formType'] : 'all'; // Default to 'all'
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
                ipr.created_at AS date_created
            FROM userprojecttitle pt
            LEFT JOIN initialprojectreport ipr ON pt.project_id = ipr.project_id
            LEFT JOIN users u ON ipr.user_id = u.id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE ipr.status = 'approved'
        
            UNION ALL
        
            SELECT 
                fs.Form2_id AS submission_id, -- Form 2 ID
                pt.project_title,
                pt.project_year,
                COALESCE(d.name, 'Not Specified') AS department_name,
                'form2' AS form_type,
                fs.created_at AS date_created
            FROM userprojecttitle pt
            LEFT JOIN userphysfinaccompreport fs ON pt.project_id = fs.project_id
            LEFT JOIN users u ON fs.user_id = u.id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE fs.status = 'approved'
        
            UNION ALL
        
            SELECT 
                ex.form3_id AS submission_id, -- Form 3 ID
                pt.project_title,
                pt.project_year,
                COALESCE(d.name, 'Not Specified') AS department_name,
                'form3' AS form_type,
                ex.created_at AS date_created
            FROM userprojecttitle pt
            LEFT JOIN userprojectexptrprt ex ON pt.project_id = ex.project_id
            LEFT JOIN users u ON ex.user_id = u.id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE ex.status = 'approved'
        
            UNION ALL
        
            SELECT 
                pr.form4_id AS submission_id, -- Form 4 ID
                pt.project_title,
                pt.project_year,
                COALESCE(d.name, 'Not Specified') AS department_name,
                'form4' AS form_type,
                pr.created_at AS date_created
            FROM userprojecttitle pt
            LEFT JOIN userprojectresult pr ON pt.project_id = pr.project_id
            LEFT JOIN users u ON pr.user_id = u.id
            LEFT JOIN departments d ON u.department_id = d.id
            WHERE pr.status = 'approved'
        

            UNION ALL
            
            SELECT 
                af.adminForm1_id AS submission_id, -- Admin Form 1 ID
                af.project_title,
                NULL AS project_year, -- Admin form doesn't have `project_year`
                'CPDO' AS department_name, -- Fixed department
                'adminform1' AS form_type,
                af.created_at AS date_created
            FROM adminform1 af
            
            UNION ALL

            SELECT 
                af.adminForm2_id AS submission_id, -- Admin Form 2 ID
                af.project_title,
                NULL AS project_year, -- Admin form doesn't have `project_year`
                'CPDO' AS department_name, -- Fixed department
                'adminform2' AS form_type,
                af.created_at AS date_created
            FROM adminform2 af

            UNION ALL

            SELECT 
                af.adminForm3_id AS submission_id, -- Admin Form 4 ID
                af.project_title,
                NULL AS project_year, -- Admin form doesn't have `project_year`
                'CPDO' AS department_name, -- Fixed department
                'adminform3' AS form_type,
                af.created_at AS date_created
            FROM adminform3 af

            UNION ALL


            SELECT 
                af.adminForm4_id AS submission_id, -- Admin Form 4 ID
                af.project_title,
                NULL AS project_year, -- Admin form doesn't have `project_year`
                'CPDO' AS department_name, -- Fixed department
                'adminform4' AS form_type,
                af.created_at AS date_created
            FROM adminform4 af

            UNION ALL

            SELECT 
                af.adminForm5_id AS submission_id, -- Admin Form 5 ID
                af.training_title AS project_title, -- Using training title as project title equivalent
                NULL AS project_year, -- Admin form doesn't have `project_year`
                'CPDO' AS department_name, -- Fixed department
                'adminform5' AS form_type,
                af.created_at AS date_created
            FROM adminform5 af

            UNION ALL

            SELECT 
                af.adminForm6_id AS submission_id, -- Admin Form 6 ID
                af.resolution_title AS project_title, -- Using resolution title as the title
                NULL AS project_year, -- No project year for admin forms
                'CPDO' AS department_name, -- Fixed department
                'adminform6' AS form_type,
                af.created_at AS date_created
            FROM adminform6 af

            UNION ALL

            SELECT 
                af.adminForm7_id AS submission_id,
                af.project_title AS project_title,
                NULL AS project_year, -- Admin form doesn't have `project_year`
                'CPDO' AS department_name, -- Fixed department
                'adminform7' AS form_type,
                af.created_at AS date_created
            FROM adminform7 af
            
            ORDER BY date_created DESC;
        ";

    } else {
        // Handle specific form types
        if ($formType === 'adminform1') {
            $query = "
                SELECT 
                    af.adminForm1_id AS submission_id, -- Admin Form 1 ID
                    af.project_title,
                    NULL AS project_year, -- Admin form doesn't have `project_year`
                    'CPDO' AS department_name, -- Fixed department
                    'adminform1' AS form_type,
                    af.created_at AS date_created
                FROM adminform1 af
                ORDER BY af.created_at DESC;
            ";
        }
        else if ($formType === 'adminform2') {
            $query = "
                SELECT 
                    af.adminForm2_id AS submission_id, -- Admin Form 2 ID
                    af.project_title,
                    NULL AS project_year, -- Admin form doesn't have `project_year`
                    'CPDO' AS department_name, -- Fixed department
                    'adminform2' AS form_type,
                    af.created_at AS date_created
                FROM adminform2 af
                ORDER BY af.created_at DESC;
            ";
        }
        else if ($formType === 'adminform3') {
            $query = "
                SELECT 
                    af.adminForm3_id AS submission_id, -- Admin Form 3 ID
                    af.project_title,
                    NULL AS project_year, -- Admin form doesn't have `project_year`
                    'CPDO' AS department_name, -- Fixed department
                    'adminform3' AS form_type,
                    af.created_at AS date_created
                FROM adminform3 af
                ORDER BY af.created_at DESC;
            ";
        }
        else if ($formType === 'adminform4') {
            $query = "
                SELECT 
                    af.adminForm4_id AS submission_id, -- Admin Form 4 ID
                    af.project_title,
                    NULL AS project_year, -- Admin form doesn't have `project_year`
                    'CPDO' AS department_name, -- Fixed department
                    'adminform4' AS form_type,
                    af.created_at AS date_created
                FROM adminform4 af
                ORDER BY af.created_at DESC;
            ";
        }
        
        else if ($formType === 'adminform5') {
            $query = "
                SELECT 
                    af.adminForm5_id AS submission_id,
                    af.training_title AS project_title,
                    NULL AS project_year, -- Admin form doesn't have `project_year`
                    'CPDO' AS department_name, -- Fixed department
                    'adminform5' AS form_type,
                    af.created_at AS date_created
                FROM adminform5 af
                ORDER BY af.created_at DESC;
            ";
        }
        else if ($formType === 'adminform6') {
            $query = "
                SELECT 
                    af.adminForm6_id AS submission_id,
                    af.resolution_title AS project_title, -- Using resolution title as the title
                    NULL AS project_year, -- Admin form doesn't have `project_year`
                    'CPDO' AS department_name, -- Fixed department
                    'adminform6' AS form_type,
                    af.created_at AS date_created
                FROM adminform6 af
                ORDER BY af.created_at DESC;
            ";
        }
        else if ($formType === 'adminform7') {
            $query = "
                SELECT 
                    af.adminForm7_id AS submission_id,
                    af.project_title AS project_title,
                    NULL AS project_year, -- Admin form doesn't have `project_year`
                    'CPDO' AS department_name, -- Fixed department
                    'adminform7' AS form_type,
                    af.created_at AS date_created
                FROM adminform7 af
                ORDER BY af.created_at DESC;
            ";
        }
                
        
        else {
            $queryBase = "
                SELECT 
                    {table}.{idField} AS submission_id, -- Unique ID
                    pt.project_title,
                    pt.project_year,
                    COALESCE(d.name, 'Not Specified') AS department_name,
                    '{$formType}' AS form_type,
                    {table}.created_at AS date_created
                FROM userprojecttitle pt
                LEFT JOIN {table} ON pt.project_id = {table}.project_id
                LEFT JOIN users u ON {table}.user_id = u.id
                LEFT JOIN departments d ON u.department_id = d.id
                WHERE {table}.status = 'approved'
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
    }

    // Execute query
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare data for response
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'submission_id' => $row['submission_id'],
            'project_name' => $row['project_title'] . ($row['project_year'] ? ' (' . $row['project_year'] . ')' : ''),
            'department' => $row['department_name'],
            'date_created' => $row['date_created'],
            'form_type' => $row['form_type']
        ];
    }

    // Return results
    if (count($data) > 0) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'success', 'data' => []]); // Return empty data
    }

} catch (Exception $e) {
    // Handle exceptions
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>
