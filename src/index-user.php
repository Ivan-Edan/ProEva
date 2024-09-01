<?php
session_start();

// Determine which page to show
$page = isset($_GET['page']) ? basename($_GET['page']) : 'user-home';

// Ensure the file exists before including it
$pagePath = "user-page/{$page}.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> <!-- Updated Bootstrap CSS -->
    <link rel="stylesheet" href="styles/user-sidebar.css"> <!-- Link to your custom CSS file -->
</head>
<body>
<header class="bg-D9D9D9">
    <button class="hamburger-button">&#9776;</button> <!-- Hamburger icon in header -->
</header>
<div class="container-fluid">
    
        <?php include 'includes/components/sidebar-user.php'; ?>
        <main class="col-12 col-md-9 col-lg-10 ms-md-auto px-4 main-content">
            <?php if (file_exists($pagePath)) {
                include $pagePath;
            } else {
                echo "Page not found.";
            } ?>
        </main>
    
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Updated jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script> <!-- Updated Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Updated Bootstrap JS -->
<script src="scripts/user-sidebar.js"></script>
</body>
</html>
