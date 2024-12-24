<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_otp = htmlspecialchars($_POST['otp']);
    if (isset($_SESSION['otp']) && $entered_otp == $_SESSION['otp']) {
        unset($_SESSION['otp']); // Clear OTP after successful login
        echo "<script>alert('Login successful'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Invalid OTP');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginstyle.css">
    <title>OTP Verification</title>
</head>
<body>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <h1>OTP Verification</h1>
                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" name="otp" placeholder="Enter OTP" required />
                        <i class="uil uil-key-skeleton icon"></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" value="Verify OTP" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
