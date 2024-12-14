<?php
require_once 'config.php';

// Get the department ID from the request
$department_id = isset($_GET['department_id']) ? $_GET['department_id'] : null;

if (!$department_id) {
    echo json_encode(['error' => 'Department ID is required']);
    exit;
}

try {
    // Prepare the SQL query to include department filtering
    $query = "
        SELECT 
            u.project_id, 
            u.project_title, 
            p.slippage
        FROM 
            userprojecttitle u
        LEFT JOIN 
            userphysfinaccompreport r ON u.project_id = r.project_id  -- Linking userprojecttitle and userphysfinaccompreport
        LEFT JOIN 
            userphysaccomplishments p ON r.Phys_Accomplishment_id = p.Phys_Accomplishment_id  -- Linking userphysfinaccompreport to userphysaccomplishments
        LEFT JOIN 
            users usr ON r.user_id = usr.id -- Linking userphysfinaccompreport to users table
        WHERE 
            usr.department_id = ? -- Filtering by department ID
    ";

    // Prepare and bind parameters
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $department_id); // Bind the department ID as an integer

    // Execute the statement and get the result
    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare arrays to hold the labels and slippage data
    $labels = [];
    $positiveSlippage = [];
    $negativeSlippage = [];

    // Process each row in the result
    while ($row = $result->fetch_assoc()) {
        $projectTitle = $row['project_title'];
        $slippageValue = $row['slippage'];

        if ($slippageValue !== null) {
            // Add the project title as a label
            $labels[] = $projectTitle;

            // Check if the slippage is positive or negative
            if ($slippageValue >= 0) {
                $positiveSlippage[] = $slippageValue;
                $negativeSlippage[] = 0; // For negative slippage, we put 0
            } else {
                $positiveSlippage[] = 0; // For positive slippage, we put 0
                $negativeSlippage[] = abs($slippageValue); // Store absolute value of negative slippage
            }
        }
    }

    // Return the data as JSON for the frontend to use
    echo json_encode([
        'labels' => $labels,
        'positiveSlippage' => $positiveSlippage,
        'negativeSlippage' => $negativeSlippage
    ]);
} catch (Exception $e) {
    // Return the error message if any exception occurs
    echo json_encode(['error' => $e->getMessage()]);
}

// Close the database connection
$conn->close();
?>
