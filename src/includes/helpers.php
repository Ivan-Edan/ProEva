<?php
function getUserId() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User is not logged in or session has expired.');
    }
    return $_SESSION['user_id'];
}
?>