<?php
require 'config.php'; // Database connection
session_start();

// Redirect to admin panel if already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_panel.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_email = htmlspecialchars($_POST['email']);
    $admin_password = htmlspecialchars($_POST['password']);

    // Query to check admin credentials
    $stmt = $conn->prepare("SELECT admin_id, pass FROM admin WHERE admin_email = ?");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($admin_id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($admin_password, $hashed_password)) {
            $_SESSION['admin_id'] = $admin_id;
            echo "<script>alert('Login successful!'); window.location.href='admin_panel.php';</script>";
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('No admin found with this email!');</script>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyle.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="admin-container">
        <h1>Admin Login</h1>
        <form method="POST">
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="submit-btn">Login</button>
        </form>
    </div>
</body>
</html>
