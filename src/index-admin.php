<?php
session_start();

// Determine which page to show
$page = isset($_GET['page']) ? basename($_GET['page']) : 'admin-home';

// Ensure the file exists before including it
$pagePath = "pages/{$page}.php";
if (file_exists($pagePath)) {
    include 'includes/components/sidebar-admin.php';
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
    <link rel="stylesheet" href="styles/admin-sidebar.css"> 
</head>
<body>
<header>
    <button class="hamburger-button">&#9776;</button> <!-- Hamburger icon -->
</header>
<div class="main-content">
    <?php include $pagePath; ?>
</div>
<script src="scripts/sidebar.js"></script>
</body>
</html>
