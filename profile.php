<?php
// Start the session
session_start();

// Include the database connection file
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must log in first!'); window.location.href='login.php';</script>";
    exit;
}

// Fetch user information from the database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT photo, full_name, email, time_created, membership_end_date,form_status FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($photo, $full_name, $email, $time_created, $membership_end_date,$form_status);
$stmt->fetch();
$stmt->close();

// Handle membership renewal
if (isset($_POST['renew_membership'])) {
    // Check if the payment is successful (for simplicity, we're simulating payment here)
    // You would typically process payment with a gateway (e.g., Razorpay, Paytm, etc.)
    // Simulate a payment success for demonstration purposes
    $payment_success = true; // Change to actual payment processing code

    if ($payment_success) {
        // Add 6 months to the current membership_end_date
        $new_end_date = new DateTime($membership_end_date);
        $new_end_date->modify('+6 months');
        $new_end_date_str = $new_end_date->format('Y-m-d');

        // Update the membership_end_date in the database
        $update_stmt = $conn->prepare("UPDATE users SET membership_end_date = ? WHERE id = ?");
        $update_stmt->bind_param("si", $new_end_date_str, $user_id);
        if ($update_stmt->execute()) {
            echo "<script>alert('Your membership has been renewed!'); window.location.href='profile.php';</script>";
        } else {
            echo "<script>alert('Error renewing membership. Please try again.');</script>";
        }
        $update_stmt->close();
    } else {
        echo "<script>alert('Payment failed. Please try again.');</script>";
    }
}

// Calculate remaining days and membership status
if ($membership_end_date) {
    $current_date = new DateTime();
    $end_date = new DateTime($membership_end_date);
    $remaining_days = $current_date->diff($end_date)->days;

    if ($current_date > $end_date) {
        $status = "Membership Expired";
    } else {
        $status = "Membership Active";
    }
} else {
    $remaining_days = "N/A";
    $status = "No membership data available";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profilestyle.css">
    <link rel="stylesheet" href="styles.css">
    <title>User Profile</title>
</head>
<body> 
<header>
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
        <p><strong>Form Status:</strong> <?php echo htmlspecialchars($form_status); ?></p>
        
        <section class="membership-status">
            <h2>Your Membership Status</h2>
            <p>Status: <?php echo $status; ?></p>
            <p>Membership Ends On: <?php echo $membership_end_date; ?></p>
            <p>Days Remaining: <?php echo $remaining_days; ?> days</p>

            <?php if ($status == "Membership Expired" || $remaining_days <= 0): ?>
                <!-- Renew Membership Button (Triggering Payment) -->
                <form action="profile.php" method="POST">
                    <button type="submit" name="renew_membership" class="btn">Renew Membership (₹50)</button>
                </form>
            <?php endif; ?>
        </section>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>
</body>
</html>
