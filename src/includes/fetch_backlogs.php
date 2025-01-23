<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $project_id = $input['project_id'];

    $response = [
        'done' => [],
        'inProgress' => [],
        'incoming' => [],
    ];

    // Fetch Task Done
    $stmt = $conn->prepare("SELECT projectName FROM user_mainproject WHERE status = 'Done' AND project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $response['done'][] = $row;
    }

    // Fetch Task In Progress
    $stmt = $conn->prepare("SELECT projectName FROM user_mainproject WHERE status = 'In Progress' AND project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $response['inProgress'][] = $row;
    }

    // Fetch Task Incoming
    $stmt = $conn->prepare("SELECT projectName FROM user_mainproject WHERE status = 'Incoming' AND project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $response['incoming'][] = $row;
    }

    echo json_encode($response);
}
?>
