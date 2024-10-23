<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the dashboard if logged in
    header("Location: public/dashboard.php");
    exit;
} else {
    // Redirect to the login page if not logged in
    header("Location: public/login.php");
    exit;
}
?>
