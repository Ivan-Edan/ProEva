<?php
session_start();
include '../includes/config.php';

header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectId = $_POST['id'];
    $projectName = escapeshellarg($_POST['name']);
    $start = escapeshellarg($_POST['start']);
    $end = escapeshellarg($_POST['end']);
    $totalCost = (float)$_POST['totalcost'];
    $fundAgency = escapeshellarg($_POST['fundagency']);
    $fundSource = escapeshellarg($_POST['fundsource']);
    $appropriations = escapeshellarg($_POST['appropriations']);
    $allotment = escapeshellarg($_POST['allotment']);
    $obligations = escapeshellarg($_POST['obligations']);
    $disbursement = escapeshellarg($_POST['disbursement']);
    $targetOWPA = (float)$_POST['targetowpa'] / 100;
    $actualOWPA = (float)$_POST['actualowpa'] / 100;
    $slippage = escapeshellarg($_POST['slippage']);
    $male = escapeshellarg($_POST['male']);
    $female = escapeshellarg($_POST['female']);
    $remarks = escapeshellarg($_POST['remarks']);
    $implementingAgency = escapeshellarg($_POST['implementingagency']);
    $sector = escapeshellarg($_POST['sector']);
    $location = escapeshellarg($_POST['location']);
    $city = escapeshellarg($_POST['city']);
    $barangay = escapeshellarg($_POST['barangay']);
    $finding = escapeshellarg($_POST['finding']);
    $typology = escapeshellarg($_POST['typology']);
    $issueStatus = escapeshellarg($_POST['issuestatus']);
    $reasons = escapeshellarg($_POST['reasons']);
    $actionTaken = escapeshellarg($_POST['actiontaken']);
    $actionToBeTaken = escapeshellarg($_POST['actiontobetaken']);

    // Check if project_id exists in issue_details
    $checkQuery = $conn->prepare("SELECT COUNT(*) FROM issue_details WHERE project_id = ?");
    $checkQuery->bind_param("i", $projectId);
    $checkQuery->execute();
    $checkQuery->bind_result($exists);
    $checkQuery->fetch();
    $checkQuery->close();

    if ($exists > 0) {
        $fetchQuery = $conn->prepare("SELECT spi, status, issue_details, pv, ev FROM issue_details WHERE project_id = ?");
        $fetchQuery->bind_param("i", $projectId);
        $fetchQuery->execute();
        $fetchQuery->bind_result($spi, $status, $issue_details, $pv, $ev);
        $fetchQuery->fetch();
        $fetchQuery->close();

        $details[] = [
            'spi' => $spi,
            'status' => $status,
            'issue_details' => $issue_details,
            'total_program_cost' => str_replace(["\n", "\r"], '', $totalCost),
            'project_name' => $projectName,
            'pv' => $pv,
            'ev' => $ev
        ];

        echo json_encode($details);
        exit;
    }

    // Prepare the command for the Python script
    $command = "python3 spi_calculator.py  $start $end $totalCost $appropriations $targetOWPA $actualOWPA $slippage $finding $typology $issueStatus $reasons $actionTaken $actionToBeTaken $projectName";    // Execute the command and capture the output
    $output = shell_exec($command);

    if ($output === null || !is_string($output)) {
        echo json_encode(['error' => 'Failed to execute the Python script.']);
        exit;
    }

    if (preg_match('/Project Name: (.*?)\nSPI: (.*?)\nStatus: (.*?)\nIssue Details: (.*?)\nPV: (.*?)\nEV: (.*)/s', $output, $matches)) {
        $spi = (float)trim($matches[2] ?? '0');
        $status = trim($matches[3] ?? '');
        $issue_details = trim($matches[4] ?? '');
        $pv = (float)trim($matches[5] ?? '0');
        $ev = (float)trim($matches[6] ?? '0');
    } else {
        echo json_encode(['error' => 'Failed to parse Python script output.']);
        exit;
    }

    $details[] = [
        'spi' => $spi,
        'status' => $status,
        'issue_details' => $issue_details,
        'total_program_cost' => str_replace(["\n", "\r"], '', $totalCost),
        'project_name' => $projectName,
        'pv' => $pv,
        'ev' => $ev
    ];

    // Check if SPI is greater than 0.0 before saving
    if ($spi > 0.0) {
        $insertQuery = $conn->prepare(
            "INSERT INTO issue_details (project_id, spi, status, issue_details, pv, ev) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $insertQuery->bind_param("isssss", $projectId, $spi, $status, $issue_details, $pv, $ev);
        $insertQuery->execute();
        $insertQuery->close();
    }

    echo json_encode($details);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
message.txt
5 KB