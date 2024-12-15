<?php
include 'config.php'; // Database connection file

header('Content-Type: application/json');

if (isset($_GET['query'])) {
    $input = $_GET['query'];
    $searchTerm = "%$input%"; // Prepare the search term with wildcards

    try {
        $stmt = $conn->prepare("SELECT project_title FROM userprojecttitle WHERE project_title LIKE ? LIMIT 10");
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();

        $result = $stmt->get_result();
        $titles = [];
        while ($row = $result->fetch_assoc()) {
            $titles[] = $row['project_title'];
        }

        echo json_encode($titles); // Return results as JSON
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'No query parameter provided.']);
}
?>
