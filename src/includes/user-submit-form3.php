<?php
// Include your database configuration
include 'config.php';
include 'helpers.php';

// Set response to JSON format
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = getUserId(); // Retrieve the user_id securely

    // Begin transaction
    $conn->begin_transaction();

    try {
        // 1. Insert into UserForm3AddiDetails
        $findings = $_POST['user_findings_3'];
        $typology = $_POST['user_typology_3'];
        $issue_status = $_POST['user_issue_status_3'];
        $reasons = $_POST['user_reasons_3'];
        $actions_taken = $_POST['user_actions_taken_3'];
        $actions_to_be_taken = $_POST['user_actions_to_be_taken_3'];

        $stmt = $conn->prepare("
            INSERT INTO UserForm3AddiDetails (findings, typology, issue_status, reasons, actions_taken, actions_to_be_taken) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssss", $findings, $typology, $issue_status, $reasons, $actions_taken, $actions_to_be_taken);
        $stmt->execute();
        $addi_form3_details_id = $conn->insert_id; // Get the inserted ID

        // 2. Insert into UserProjectTitle
        $project_title = $_POST['user_project_title_1'];
        $stmt = $conn->prepare("SELECT project_id FROM userprojecttitle WHERE project_title = ?");
        $stmt->bind_param("s", $project_title);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $project_id = $row['project_id'];
        } else {
            throw new Exception("Project title does not exist. Submit Form 1 first.");
        }
        

        // 3. Insert into UserImplementingAgency
        $implementing_agency = $_POST['user_implementing_agency_1'];
        $stmt = $conn->prepare("INSERT INTO UserImplementingAgency (implementing_agency) VALUES (?)");
        $stmt->bind_param("s", $implementing_agency);
        $stmt->execute();
        $implementing_agency_id = $conn->insert_id;

        // 4. Insert into UserSector
        $sector = $_POST['user_sector_1'];
        $stmt = $conn->prepare("INSERT INTO UserSector (sector) VALUES (?)");
        $stmt->bind_param("s", $sector);
        $stmt->execute();
        $sector_id = $conn->insert_id;

        // 5. Insert into UserLocation
        $location = $_POST['user_province_1'];
        $city_municipality = $_POST['user_city_1'];
        $barangay = $_POST['user_barangay_1'];

        $stmt = $conn->prepare("INSERT INTO UserLocation (location, city, barangay) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $location, $city_municipality, $barangay);
        $stmt->execute();
        $location_id = $conn->insert_id;

        // 6. Insert into UserProjectExptRprt
        $stmt = $conn->prepare("
            INSERT INTO UserProjectExptRprt (project_id, implementing_agency_id, sector_id, location_id, addi_form3_details_id, user_id) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "iiiiii", 
            $project_id, 
            $implementing_agency_id, 
            $sector_id, 
            $location_id, 
            $addi_form3_details_id, 
            $user_id
        );
        $stmt->execute();

        // Commit transaction
        $conn->commit();

        // Return success response
        echo json_encode([
            'status' => 'success',
            'message' => 'Form data successfully submitted!'
        ]);

    } catch (Exception $e) {
        // Rollback transaction on failure
        $conn->rollback();

        // Return error response
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}
?>
