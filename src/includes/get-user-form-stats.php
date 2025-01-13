<?php
session_start();
include 'config.php'; // Your database connection file

// Get logged-in user ID
$user_id = $_SESSION['user_id']; // Assuming session stores user ID

// Initialize task counts
$projectCounts = [
    'accepted' => 0,
    'rejected' => 0,
    'pending' => 0,
];

// SQL Query to count tasks based on status
$sql = "
    SELECT status, COUNT(*) as count
    FROM (
        SELECT status FROM initialprojectreport WHERE user_id = ?
        UNION ALL
        SELECT status FROM userphysfinaccompreport WHERE user_id = ?
        UNION ALL
        SELECT status FROM userprojectexptrprt WHERE user_id = ?
        UNION ALL
        SELECT status FROM userprojectresult WHERE user_id = ?
    ) AS combined
    GROUP BY status
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $user_id, $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch results
while ($row = $result->fetch_assoc()) {
    $status = strtolower($row['status']); // Ensure lowercase for consistency
    if ($status == 'approved') {
        $projectCounts['accepted'] = $row['count'];
    } elseif ($status == 'rejected') {
        $projectCounts['rejected'] = $row['count'];
    } elseif ($status == 'pending') {
        $projectCounts['pending'] = $row['count'];
    }
}
echo json_encode($projectCounts);
?>
