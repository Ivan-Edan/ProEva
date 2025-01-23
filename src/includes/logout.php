<?php
session_start(); // Start the session

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header('Location: /ProEva/src/login-welcome.php'); // Adjust this path if necessary
exit(); // Ensure no further code is executed
?>
