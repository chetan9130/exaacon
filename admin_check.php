<?php
require 'config.php'; // Include database connection
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo "<script>alert('Access denied. Admins only.'); window.location.href='admin_login.php';</script>";
    exit;
}
?>
