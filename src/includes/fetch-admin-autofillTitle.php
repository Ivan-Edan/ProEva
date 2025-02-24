<?php
include 'config.php'; 

header('Content-Type: application/json'); 

if (isset($_GET['query'])) {
    $input = $_GET['query']; 
    $searchTerm = "%$input%";

    try {
        // Fetch approved project titles and years from the database
        $stmt = $conn->prepare("
            SELECT pt.project_id, pt.project_title, pt.project_year 
            FROM userprojecttitle pt
            INNER JOIN initialprojectreport ipr ON pt.project_id = ipr.project_id
            WHERE pt.project_title LIKE ? 
            AND ipr.status = 'approved' -- Filter for approved projects
            ORDER BY pt.project_year DESC
            LIMIT 10
        ");

        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();

        $result = $stmt->get_result();
        $titles = [];

        while ($row = $result->fetch_assoc()) {
            // Combine title and year for display
            $titles[] = [
                'project_id'    => $row['project_id'],
                'project_title' => $row['project_title'],
                'project_year'  => $row['project_year']
            ];
        }

        echo json_encode($titles);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'No query parameter provided.']);
}
?>
