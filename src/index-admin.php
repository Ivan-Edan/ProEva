<?php
session_start();

// Determine which page to show
$page = isset($_GET['page']) ? basename($_GET['page']) : 'admin-home';

// Ensure the file exists before including it
$pagePath = "pages/{$page}.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="styles/admin-sidebar.css"> <!-- Link to your custom CSS file -->
</head>
<body>
<header class="bg-D9D9D9">
    <button class="hamburger-button">&#9776;</button> <!-- Hamburger icon in header -->
</header>
<div class="container-fluid">
    <div class="row">
        <?php include 'includes/components/sidebar-admin.php'; ?>
        <main class="ml-sm-auto px-4 main-content">
            <?php if (file_exists($pagePath)) {
                include $pagePath;
            } else {
                echo "Page not found.";
            } ?>
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> <!-- Popper.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
<script src="js/sidebar.js"></script>
</body>
</html>
