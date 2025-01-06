<?php
include 'config.php'; // Adjust path to your config file if necessary

header('Content-Type: application/json'); // Return JSON response

if (isset($_GET['query'])) {
    $input = $_GET['query']; // Get user input
    $searchTerm = "%$input%"; // Prepare for LIKE query

    try {
        // Fetch project titles and years from the database
        $stmt = $conn->prepare("
            SELECT project_id, project_title, project_year 
            FROM userprojecttitle 
            WHERE project_title LIKE ? 
            ORDER BY project_year DESC
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

        echo json_encode($titles); // Return results as JSON
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'No query parameter provided.']);
}
?>
