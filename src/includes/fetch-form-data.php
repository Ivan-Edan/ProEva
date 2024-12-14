<?php
include 'config.php'; // Include your database configuration

header('Content-Type: application/json');

$formType = $_GET['formType'] ?? ''; // Retrieve the form type (e.g., 'form1', 'form2', etc.)
$formId = $_GET['formId'] ?? ''; // Retrieve the form ID passed from the frontend

$response = [];

if (!$formType || !$formId) {
    echo json_encode(['error' => 'Form type or ID is missing.']);
    exit;
}

// Map each form type to its respective table, identifier, and fields
$formMapping = [
    'form1' => [
        'table' => 'userinitialprojectreport',
        'id_field' => 'details_id',
        'fields' => [
            'project_title_id',
            'month',
            'year',
            'quarter',
            'location_id',
            'fund_source_id',
            'implementing_agency_id',
            'total_cost',
            'remarks'
        ]
    ],
    'form2' => [
        'table' => 'userphysfinaccompreport',
        'id_field' => 'Form2_id',
        'fields' => [
            'project_title',
            'month',
            'year',
            'quarter',
            'appropriations',
            'allotment',
            'obligations',
            'disbursements',
            'target_owpa',
            'actual_owpa',
            'slippage',
            'remarks'
        ]
    ],
    'form3' => [
        'table' => 'userprojectexptrprt',
        'id_field' => 'form3_id',
        'fields' => [
            'project_title',
            'month',
            'year',
            'quarter',
            'location',
            'issue_status',
            'actions_taken',
            'actions_to_be_taken',
            'remarks'
        ]
    ],
    'form4' => [
        'table' => 'userprojectresult',
        'id_field' => 'form4_id',
        'fields' => [
            'project_title',
            'month',
            'year',
            'objectives',
            'result_indicator',
            'observe_results',
            'remarks'
        ]
    ]
];

// Check if the form type is valid
if (!array_key_exists($formType, $formMapping)) {
    echo json_encode(['error' => 'Invalid form type.']);
    exit;
}

$formConfig = $formMapping[$formType];

// Build the query dynamically
$query = "SELECT " . implode(', ', $formConfig['fields']) . " FROM {$formConfig['table']} WHERE {$formConfig['id_field']} = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param('i', $formId); // Bind the form ID as an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc(); // Fetch the single row data as an associative array
    } else {
        $response = ['error' => 'No data found for the specified form and ID.'];
    }

    $stmt->close();
} else {
    $response = ['error' => 'Failed to prepare the database query.'];
}

echo json_encode($response); // Return the response as JSON
?>
