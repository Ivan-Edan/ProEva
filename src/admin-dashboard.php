<?php
session_start(); // Start the session

// Define base path for the project
define('BASE_URL', '/Project-ProEvaaaaaaaaaaaaaaaaaaaaaaaaa/src/'); // URL path relative to the web server's document root

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // Redirect non-admin users to the login page
    header('Location: ' . BASE_URL . 'login-welcome.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <script src="js/script.js"></script> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>
<header>
    <button class="hamburger-button">&#9776;</button> 
</header>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h1> <!-- Display the admin's email -->
    <p>You are an admin in the <?php echo htmlspecialchars($_SESSION['department']); ?> department.</p>
    <!-- Add admin-specific options below -->
     
    <a href="<?php echo BASE_URL; ?>includes/logout.php">Logout</a> <!-- Corrected Logout link -->
</body>
</html>
