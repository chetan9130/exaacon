<?php
require 'config.php'; // Include database connection
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must log in first!'); window.location.href='login.php';</script>";
    exit;
}

// Fetch user information from the database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profilestyle.css">
    <link rel="stylesheet" href="homestyle.css">
    <title>User Profile</title>
</head>
<body>  <header>
        <nav>
            <ul class="nav-list">
                <li class="nav-logo">
                    <a href="index.php">
                        <img src="images/logo.png" alt="Aaradhya Consultancy Services Logo" class="logo">
                    </a>
                </li>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="profile.php">Profile</a></li>
                <!-- <li class="nav-auth"><a href="logout.php">Logout</a></li> -->
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>User Profile</h1>
        <div class="profile-details">
        <p><strong>Photo:</strong></p>
    <?php 
    $photo_path = "uploads/" . htmlspecialchars($photo);
    if (file_exists($photo_path)): ?>
        <img src="<?php echo $photo_path; ?>" alt="User Photo" style="width:150px; height:150px; border-radius:50%;">
    <?php else: ?>
        <p>No photo uploaded or file not found.</p>
    <?php endif; ?>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($full_name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Member Since:</strong> <?php echo htmlspecialchars($time_created); ?></p>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
