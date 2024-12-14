<?php
include 'config.php';

header('Content-Type: application/json');


$options = [];

// Define form queries with the form number, table name, unique identifier, and label
$form_queries = [
    [
        'form_number' => 'Form 1',
        'table' => 'userinitialprojectreport',
        'id_field' => 'details_id',
        'user_id_field' => 'user_id',
        'project_id_field' => 'project_id'
    ],
    [
        'form_number' => 'Form 2',
        'table' => 'userphysfinaccompreport',
        'id_field' => 'Form2_id',
        'user_id_field' => 'user_id',
        'project_id_field' => 'project_id'
    ],
    [
        'form_number' => 'Form 3',
        'table' => 'userprojectexptrprt',
        'id_field' => 'form3_id',
        'user_id_field' => 'user_id',
        'project_id_field' => 'project_id'
    ],
    [
        'form_number' => 'Form 4',
        'table' => 'userprojectresult',
        'id_field' => 'form4_id',
        'user_id_field' => 'user_id',
        'project_id_field' => 'project_id'
    ]
    // Add more form queries if needed
];

foreach ($form_queries as $form) {
    $query = "
        SELECT
            f.{$form['id_field']} AS form_id,
            '{$form['form_number']}' AS form_number,
            d.name AS department,
            p.project_title AS project_title
        FROM
            {$form['table']} AS f
        INNER JOIN
            users AS u ON f.{$form['user_id_field']} = u.id
        INNER JOIN
            departments AS d ON u.department_id = d.id
        INNER JOIN
            userprojecttitle AS p ON f.{$form['project_id_field']} = p.project_id
    ";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[] = [
                'label' => "{$row['form_number']} - {$row['department']} - {$row['project_title']}",
                'value' => strtolower(str_replace(' ', '', $row['form_number'])) . "_{$row['form_id']}"
            ];
        }
    }
}

// Output the combined options as JSON
echo json_encode($options, JSON_PRETTY_PRINT);

?>
