<?php
header('Content-Type: application/json');
require_once 'config.php';

session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); 
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$user_id = $_SESSION['user_id']; 

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    try {
        // SQL query to fetch the financial_status_id from userphysfinaccompreport based on project_id and user_id
        $sql_report = "SELECT financial_status_id, created_at 
                       FROM userphysfinaccompreport 
                       WHERE project_id = ? AND user_id = ?";

        $stmt_report = $conn->prepare($sql_report);
        $stmt_report->bind_param('ii', $project_id, $user_id); // Bind both project_id and user_id
        $stmt_report->execute();
        $result_report = $stmt_report->get_result();

        // Check if we have a financial_status_id for this user and project
        if ($result_report->num_rows > 0) {
            $row = $result_report->fetch_assoc();
            $financial_status_id = $row['financial_status_id'];
            $created_at = $row['created_at']; // Fetch the created_at field

            // Now fetch the financial details from userfinancialstatus using the financial_status_id
            $sql_financial = "SELECT 
                                appropriations, 
                                allotment, 
                                obligations, 
                                disbursements
                              FROM 
                                userfinancialstatus
                              WHERE 
                                financial_status_id = ?";

            $stmt_financial = $conn->prepare($sql_financial);
            $stmt_financial->bind_param('i', $financial_status_id); // Bind financial_status_id
            $stmt_financial->execute();
            $result_financial = $stmt_financial->get_result();

            // Check if we have financial data
            if ($result_financial->num_rows > 0) {
                $financialDetails = [];
                while ($row = $result_financial->fetch_assoc()) {
                    $financialDetails[] = [
                        'appropriations' => $row['appropriations'],
                        'allotment' => $row['allotment'],
                        'obligations' => $row['obligations'],
                        'disbursements' => $row['disbursements'],
                        'created_at' => $created_at // Include created_at
                    ];
                }
                echo json_encode($financialDetails); // Return the financial details for the logged-in user and project
            } else {
                echo json_encode(['message' => 'No financial data found for this project.']);
            }
        } else {
            echo json_encode(['message' => 'No financial report found for this project or user.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Project ID is required.']);
}
?>
