<?php
session_start(); // Start the session

// Define base path for the project
define('BASE_URL', '/ProEva/src/'); // URL path relative to the web server's document root

// Check if the user is logged in and has the role of 'user'
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    // Redirect non-users to the login page
    header('Location: ' . BASE_URL . 'login-welcome.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h1> <!-- Display the user's email -->
    <p>You are a user in the <?php echo htmlspecialchars($_SESSION['department']); ?> department.</p>
    <!-- Add user-specific options below -->
    <a href="<?php echo BASE_URL; ?>includes/logout.php">Logout</a> <!-- Corrected Logout link -->
</body>
</html>