<?php
require_once 'config.php'; // Include your DB connection file

// Fetch existing accounts from the database
$query = "SELECT u.id, ui.first_name, ui.middle_name, ui.last_name, u.email, u.role, u.department, ui.date_added 
          FROM users_info ui 
          JOIN users u ON ui.user_id = u.id";
$result = $conn->query($query);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td class="text-center">' . htmlspecialchars($row['last_name']) . '</td>';
        echo '<td class="text-center">' . htmlspecialchars($row['first_name']) . '</td>';
        echo '<td class="text-center">' . htmlspecialchars($row['middle_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['department']) . '</td>';
        echo '<td class="text-center"><a style="color: black;" href="#" data-bs-toggle="modal" data-bs-target="#editAccountModal" data-email="' . htmlspecialchars($row['email']) . '" data-id="' . htmlspecialchars($row['id']) . '" data-firstname="' . htmlspecialchars($row['first_name']) . '" data-middlename="' . htmlspecialchars($row['middle_name']) . '" data-lastname="' . htmlspecialchars($row['last_name']) . '" data-role="' . htmlspecialchars($row['role']) . '" data-department="' . htmlspecialchars($row['department']) . '">' . htmlspecialchars($row['email']) . '</a></td>';
        echo '<td class="text-center">' . htmlspecialchars($row['role']) . '</td>';
        echo '<td>' . htmlspecialchars($row['date_added']) . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7" class="text-center">No accounts found.</td></tr>';
}

$conn->close();
?>
