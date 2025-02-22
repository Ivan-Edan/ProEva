<?php
session_start();

// Define the timeout duration in seconds (e.g., 30 minutes)
$timeout_duration = 1800;

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login
    header("Location: login-welcome.php");
    exit();
}

// Check for inactivity
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Calculate the time since the last activity
    if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration) {
        // Last activity was more than the timeout duration
        session_unset(); // Unset session variables
        session_destroy(); // Destroy the session
        header("Location: login-welcome.php");
        exit();
    }
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time();

// Determine which page to show
$page = isset($_GET['page']) ? basename($_GET['page']) : 'user-home';


$pagePath = "user-page/{$page}.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="styles/user-sidebar.css"> 
</head>
<body>
<header class="bg-D9D9D9">
    <button class="hamburger-button">&#9776;</button> 
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
<script src="scripts/user-sidebar.js"></script>
</body>
</html>
