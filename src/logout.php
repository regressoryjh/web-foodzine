<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Clear cookies
if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_email'])) {
    setcookie('user_id', '', time() - 3600, '/');
    setcookie('user_email', '', time() - 3600, '/');
}

// Redirect to login page
header("Location: login.php");
exit();
?>
