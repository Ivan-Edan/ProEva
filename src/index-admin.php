<?php
session_start();

// Define the timeout duration in seconds (e.g., 30 minutes)
$timeout_duration = 1800;

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
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
        header("Location: login-welcome.php"); // Redirect to login page
        exit();
    }
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time(); // Set/update last activity time

// Determine which page to show
$page = isset($_GET['page']) ? basename($_GET['page']) : 'admin-home';

if ($page == 'admin-monitoring-chart') {
    $pagePath = "admin-progress/admin-monitoring-chart.php";
} else {
    $pagePath = "pages/{$page}.php";
}

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
    <link rel="stylesheet" href="<?php echo 'styles/spinner.css'; ?>" />
</head>
<?php include 'spinner.html'; ?>
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
        <!-- Logout Confirmation Modal -->
        <div class="modal fade exitModals" tabindex="-1" aria-labelledby="exitModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <img src="images/illustration/warning.png" class="icon-modal" alt="Warning Icon">
                    <h5 class="text-modal">Are you sure you want to Logout this account?</h5>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="includes/logout.php" class="btn btn-danger">Exit</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="scripts/sidebar.js"></script>
<script src="<?php echo 'scripts/spinner.js'; ?>"></script>
</body>
</html>
