<?php
session_start();
session_unset();
session_destroy();

// Redirect to login page after logout
header('Location: /Project-ProEvaaaaaaaaaaaaaaaaaaaaaaaaa/src/login-welcome.php'); // Adjust this path if necessary
exit;
