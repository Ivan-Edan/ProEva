<?php
include 'config.php'; // Database connection file

header('Content-Type: application/json');
session_start(); // Start the session

if (isset($_GET['query']) && isset($_SESSION['user_id'])) {
    $input = $_GET['query'];
    $userId = $_SESSION['user_id']; // Get the user ID from the session

    try {
        // Prepare the search term for the LIKE query
        $searchTerm = "%{$input}%";

        // Join userprojecttitle with initialprojectreport and filter by status = 'approved' and user_id
        $stmt = $conn->prepare("
            SELECT userprojecttitle.project_title, userprojecttitle.project_year 
            FROM userprojecttitle 
            INNER JOIN initialprojectreport 
            ON userprojecttitle.project_id = initialprojectreport.project_id 
            WHERE userprojecttitle.project_title LIKE ? 
            AND initialprojectreport.status = 'approved' 
            AND initialprojectreport.user_id = ? 
            LIMIT 10
        ");
        $stmt->bind_param("si", $searchTerm, $userId); // Bind both search term and user ID
        $stmt->execute();

        $result = $stmt->get_result();
        $titles = [];
        while ($row = $result->fetch_assoc()) {
            $titles[] = [
                'project_title' => $row['project_title'],
                'project_year' => $row['project_year']
            ];
        }

        echo json_encode($titles); // Return results as JSON
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Missing query parameter or user ID.']);
}
?>
