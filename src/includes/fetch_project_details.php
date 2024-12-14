<?php
header('Content-Type: application/json');
require_once 'config.php';

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    try {
        // SQL query to fetch the required details from both tables based on project_id, excluding start_date and end_date
        $sql = "SELECT 
                    ufs.appropriations, 
                    ufs.allotment, 
                    ufs.obligations, 
                    ufs.disimbursements
                FROM 
                    userfinancialstatus ufs
                LEFT JOIN 
                    userphysfinaccompreport upfr 
                ON 
                    ufs.financial_status_id = upfr.financial_status_id
                WHERE 
                    upfr.project_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $project_id); // Bind the project_id parameter
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if we have any results
        if ($result->num_rows > 0) {
            $financialDetails = [];
            while ($row = $result->fetch_assoc()) {
                $financialDetails[] = [
                    'appropriations' => $row['appropriations'],
                    'allotment' => $row['allotment'],
                    'obligations' => $row['obligations'],
                    'disimbursements' => $row['disimbursements']
                ];
            }
            echo json_encode($financialDetails);
        } else {
            // Return a structured message for no data
            echo json_encode(['message' => 'No data found for this project.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Project ID is required.']);
}
?>
