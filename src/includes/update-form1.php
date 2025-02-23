<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submissionId = $_POST["submissionId"];
    $implementingAgency = $_POST["implementingAgency"];
    $sector = $_POST["sector"];
    $modeOfImplementation = $_POST["modeOfImplementation"];
    $location = $_POST["location"];
    $city = $_POST["city"];
    $barangay = $_POST["barangay"];
    $totalCost = $_POST["totalCost"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $fundAgency = $_POST["fundAgency"];
    $fundSource = $_POST["fundSource"];
    $male = $_POST["male"];
    $female = $_POST["female"];
    $financialTargets = $_POST["financialTargets"];
    $physicalTargets = $_POST["physicalTargets"];
    $compDetails = $_POST["compDetails"];
    $remarks = $_POST["remarks"];
    $submittedDesignation = $_POST["submittedDesignation"];
    $submittedBy = $_POST["submittedBy"];

    // Update form details in the database
    $sql = "UPDATE InitialProjectReport 
            SET implementing_agency = ?, sector = ?, mode_of_implementation = ?, location = ?, 
                city = ?, barangay = ?, total_cost = ?, start_date = ?, end_date = ?, 
                fund_agency = ?, fund_source = ?, male = ?, female = ?, 
                year_financial_target = ?, year_phy_target_percent = ?, comp_details = ?, remarks = ?, 
                submitted_designation = ?, submitted_by = ?, status = 'pending'
            WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "sssssssssssssssssssi", 
            $implementingAgency, $sector, $modeOfImplementation, $location,
            $city, $barangay, $totalCost, $startDate, $endDate,
            $fundAgency, $fundSource, $male, $female,
            $financialTargets, $physicalTargets, $compDetails, $remarks,
            $submittedDesignation, $submittedBy, $submissionId
        );

        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update form."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Database error."]);
    }

    $conn->close();
}
?>
