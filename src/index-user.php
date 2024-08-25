<?php
session_start();

// Determine which page to show
$pages = isset($_GET['user-page']) ? basename($_GET['user-page']) : 'user-home';

// Ensure the file exists before including it
$pagesPath = "user-page/{$pages}.php";
if (file_exists($pagesPath)) {
    include 'includes/components/sidebar-user.php';
} else {
    // Handle error if the file does not exist
    echo "Page not found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="styles/user-sidebar.css">
</head>
<body>
<header>
    <button class="hamburger-button">&#9776;</button> 
</header>
<div class="main-content">
    <?php include $pagesPath; ?>
</div>
<script src="scripts/user-sidebar.js"></script>
</body>
</html>
