<?php
session_start();
require_once '../../includes/config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = [];

// Check if form was submitted
if (isset($_POST['submitBtn1'])) {
    // Sub-project data
    $mainProj = $_POST['mainproject'];
    $subProjectName = $_POST['subProjectName'];
    $subStartDate = $_POST['subStartDate'];
    $subEndDate = $_POST['subEndDate'];
    $subProjCost = $_POST['subProjectCost'];
    $subFundSource = $_POST['subFundSource'];
    $subFundingAgency = $_POST['subFundingAgency'];
    $status = $_POST['statusDropdown'];
    $proj = $_POST['project2'];

    // Comment data
    $comment = !empty($_POST['subComment']) ? $_POST['subComment'] : null;

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
        // Insert into user_subproject
        $addSubProject = "INSERT INTO `user_subproject` (`main_id`, `subProjectName`, `subStartDate`, `subEndDate`, `subProjectCost`, `subFundSource`, `subFundingAgency`, `status`, `project_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($addSubProject)) {
            $stmt->bind_param("sssssssss", $mainProj, $subProjectName, $subStartDate, $subEndDate, $subProjCost, $subFundSource, $subFundingAgency, $status, $proj);
            $stmt->execute();
            $subId = $conn->insert_id; // Get the ID of the inserted sub-project
            $stmt->close();
        } else {
            throw new Exception("Preparation failed for user_subproject: " . $conn->error);
        }

        // Fetch the formatted_id for the inserted record
        $formattedId = null;
        $selectFormattedId = "SELECT formatted_id FROM `user_subproject` WHERE id = ?";
        if ($stmt = $conn->prepare($selectFormattedId)) {
            $stmt->bind_param("i", $subId);
            $stmt->execute();
            $stmt->bind_result($formattedId);
            $stmt->fetch();
            $stmt->close();
        } else {
            throw new Exception("Failed to fetch formatted_id: " . $conn->error);
        }

        // Insert into sub_comment only if comment or photoPath is provided
        if ($comment !== null || $dbPhotoPath !== null) {
            $addComment = "INSERT INTO `sub_comment` (`subId`, `comment`, `photoPath`, `photoPath_admin`, `userId`, `formatted_id_sub`) VALUES (?, ?, ?, ?, ?, ?)";
            if ($stmt = $conn->prepare($addComment)) {
                $stmt->bind_param("isssss", $subId, $comment, $dbPhotoPath, $photoPathAdmin, $userId, $formattedId);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Preparation failed for sub_comment: " . $conn->error);
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
