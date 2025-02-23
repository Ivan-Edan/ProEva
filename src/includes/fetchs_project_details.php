<?php
include 'config.php'; 

$projectId = $_GET['project_id'];

$sql = "SELECT pv, ev, spi, status, issue_details FROM issue_details WHERE project_id = $projectId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row); 
} else {
    echo json_encode([]);
}
?>