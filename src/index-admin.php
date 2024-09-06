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
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> <!-- Updated Bootstrap CSS -->
    <link rel="stylesheet" href="styles/admin-sidebar.css"> <!-- Link to your custom CSS file -->
</head>
<body>
<header class="bg-D9D9D9">
    <button class="hamburger-button">&#9776;</button> <!-- Hamburger icon in header -->
</header>
<div class="container-fluid">
    <?php include 'includes/components/sidebar-admin.php'; ?>
    <main class="col-12 col-md-9 col-lg-10 ms-md-auto px-4 main-content"> <!-- Adjusted grid classes for Bootstrap 5 -->
        <?php if (file_exists($pagePath)) {
            include $pagePath;
        } else {
            echo "Page not found.";
        } ?>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Updated jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Updated Bootstrap JS -->
<script src="scripts/sidebar.js"></script>
</body>
</html>
