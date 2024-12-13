<?php
session_start();
require_once '../../includes/config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = [];

// Check if form was submitted
if (isset($_POST['submitBtn'])) {
    // Project data
    $projName = $_POST['projectName'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $projCost = $_POST['projectCost'];
    $fundSource = $_POST['fundSource'];
    $fundAgency = $_POST['fundingAgency'];
    $status = $_POST['statusDropdown'];
    $proj = $_POST['project1'];

    // Comment data
    $comment = !empty($_POST['comment']) ? $_POST['comment'] : null;

    $uploadDir = '../../uploads/';
    $dbPhotoPath = null;

    if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['tmp_name'])) {
        $fileName = basename($_FILES['photo']['name']);
        $photoPath = $uploadDir . $fileName; // Path for saving the file
        $dbPhotoPath = 'uploads/' . $fileName; // Path stored in the database
        $photoPathAdmin = '../uploads/' . $fileName;
    }

    $userId = $_SESSION['user_id']; // Assuming userId is stored in session

    $conn->autocommit(false); // Start transaction

    try {
        // Insert into user_mainproject
        $addProject = "INSERT INTO `user_mainproject` (`projectName`, `startDate`, `endDate`, `projectCost`, `fundSource`, `fundAgency`, `status`, `project_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($addProject)) {
            $stmt->bind_param("ssssssss", $projName, $startDate, $endDate, $projCost, $fundSource, $fundAgency, $status, $proj);
            $stmt->execute();
            $mainId = $conn->insert_id; // Get the ID of the inserted project
            $stmt->close();
        } else {
            throw new Exception("Preparation failed for user_mainproject: " . $conn->error);
        }

        // Fetch the formatted_id for the inserted record
        $formattedId = null;
        $selectFormattedId = "SELECT formatted_id FROM `user_mainproject` WHERE id = ?";
        if ($stmt = $conn->prepare($selectFormattedId)) {
            $stmt->bind_param("i", $mainId);
            $stmt->execute();
            $stmt->bind_result($formattedId);
            $stmt->fetch();
            $stmt->close();
        } else {
            throw new Exception("Failed to fetch formatted_id: " . $conn->error);
        }

        // Insert into main_comment only if comment or photoPath is provided
        if ($comment !== null || $dbPhotoPath !== null) {
            $addComment = "INSERT INTO `main_comment` (`mainId`, `comment`, `photoPath`, `photoPath_admin`, `userId`, `formatted_id_main`) VALUES (?, ?, ?, ?, ?, ?)";
            if ($stmt = $conn->prepare($addComment)) {
                $stmt->bind_param("isssss", $mainId, $comment, $dbPhotoPath, $photoPathAdmin, $userId, $formattedId);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Preparation failed for main_comment: " . $conn->error);
            }
        }

        // Handle photo upload if applicable
        if (!empty($photoPath) && !move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            throw new Exception("Failed to upload photo.");
        }

        $conn->commit();
        $response = ["status" => "success"];
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction on error
        $response = ["status" => "error", "message" => $e->getMessage()];
    }
} else {
    $response = ["status" => "error", "message" => "Required fields are missing."];
}

// Return JSON response
echo json_encode($response);
?>
