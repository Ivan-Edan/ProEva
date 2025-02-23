<?php
// For the user side submitted form table
include 'config.php';
session_start();

// Set JSON response
header('Content-Type: application/json');

try {
    // Get logged-in user ID
    $userId = $_SESSION['user_id'];

    // Capture form type filter (default: all forms)
    $formType = isset($_GET['formType']) ? $_GET['formType'] : 'all';

    // Initialize query
    $query = '';

    if ($formType === 'all') {
        // Query for all forms with unique submission IDs
        $query = "
            SELECT 
                ipr.details_id AS submission_id, -- Unique ID for Form 1
                pt.project_id,
                pt.project_title,
                pt.project_year,
                'form1' AS form_type,
                ipr.status,
                ipr.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN initialprojectreport ipr ON pt.project_id = ipr.project_id
            LEFT JOIN users u ON ipr.user_id = u.id
            WHERE ipr.user_id = ?
            AND ipr.status IN ('pending', 'rejected')

            UNION ALL

            SELECT 
                fs.Form2_id AS submission_id, -- Unique ID for Form 2
                pt.project_id,
                pt.project_title,
                pt.project_year,
                'form2' AS form_type,
                fs.status,
                fs.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN userphysfinaccompreport fs ON pt.project_id = fs.project_id
            LEFT JOIN users u ON fs.user_id = u.id
            WHERE fs.user_id = ?
            AND fs.status IN ('pending', 'rejected')

            UNION ALL

            SELECT 
                ex.form3_id AS submission_id, -- Unique ID for Form 3
                pt.project_id,
                pt.project_title,
                pt.project_year,
                'form3' AS form_type,
                ex.status,
                ex.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN userprojectexptrprt ex ON pt.project_id = ex.project_id
            LEFT JOIN users u ON ex.user_id = u.id
            WHERE ex.user_id = ?
            AND ex.status IN ('pending', 'rejected')

            UNION ALL

            SELECT 
                pr.form4_id AS submission_id, -- Unique ID for Form 4
                pt.project_id,
                pt.project_title,
                pt.project_year,
                'form4' AS form_type,
                pr.status,
                pr.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN userprojectresult pr ON pt.project_id = pr.project_id
            LEFT JOIN users u ON pr.user_id = u.id
            WHERE pr.user_id = ?
            AND pr.status IN ('pending', 'rejected')

            ORDER BY date_submitted DESC;
        ";
    } else {
        // Map form types to tables and IDs
        $tableMap = [
            'form1' => ['table' => 'initialprojectreport', 'id' => 'details_id'],
            'form2' => ['table' => 'userphysfinaccompreport', 'id' => 'Form2_id'],
            'form3' => ['table' => 'userprojectexptrprt', 'id' => 'form3_id'],
            'form4' => ['table' => 'userprojectresult', 'id' => 'form4_id']
        ];

        if (!isset($tableMap[$formType])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid form type.']);
            exit;
        }

        // Query for specific form type
        $table = $tableMap[$formType]['table'];
        $idField = $tableMap[$formType]['id'];

        $query = "
            SELECT 
                $table.$idField AS submission_id, -- Unique ID for each submission
                pt.project_id,
                pt.project_title,
                pt.project_year,
                '$formType' AS form_type,
                $table.status,
                $table.created_at AS date_submitted
            FROM userprojecttitle pt
            LEFT JOIN $table ON pt.project_id = $table.project_id
            WHERE $table.user_id = ?
            AND $table.status IN ('pending', 'rejected')
            ORDER BY $table.created_at DESC;
        ";
    }

    // Prepare and execute query
    $stmt = $conn->prepare($query);

    // Bind user ID(s) based on form type
    if ($formType === 'all') {
        $stmt->bind_param('iiii', $userId, $userId, $userId, $userId);
    } else {
        $stmt->bind_param('i', $userId);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare data for response
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'submission_id' => $row['submission_id'],
            'project_name' => $row['project_title'] . ' (' . $row['project_year'] . ')',
            'form_type' => $row['form_type'],
            'status' => $row['status'],
            'date_submitted' => $row['date_submitted'],
            'project_id' => $row['project_id']
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
