<?php
require 'config.php'; // Include the database connection
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        // Check if the user exists in the database
        $stmt = $conn->prepare("SELECT id, pass FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Generate OTP
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['user_id'] = $id;

                // Send OTP via email
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
                    $mail->SMTPAuth = true;
                    $mail->Username = 'chetansonawane2006@gmail.com'; // SMTP username
                    $mail->Password = 'rkdwbtcyemddosuf'; // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;

                    // Recipient
                    $mail->setFrom('chetansonawane2006@gmail.com', 'Aaradhya Consultancy');
                    $mail->addAddress($email);

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Your OTP for Login';
                    $mail->Body = "Your OTP is <b>$otp</b>. Please do not share this with anyone.";

                    $mail->send();
                    echo "<script>alert('OTP sent to your email'); window.location.href='otp_verification.php';</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Could not send OTP. Please try again.');</script>";
                }
            } else {
                echo "<script>alert('Incorrect password');</script>";
            }
        } else {
            echo "<script>alert('No user found with this email');</script>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="loginstyle.css" />
    <title>Login Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms">
        <div class="form login">
          <h1>Welcome To Aaradhya Consultancy</h1>
          <span class="title">Login</span>
          
          <!-- Login Form -->
          <form action="" method="POST">
            <div class="input-field">
              <input
                type="text"
                name="email"
                placeholder="Enter your email"
                required
              />
              <i class="uil uil-envelope icon"></i>
            </div>
            <div class="input-field">
              <input
                type="password"
                name="password"
                class="password"
                placeholder="Enter your password"
                required
              />
              <i class="uil uil-lock icon"></i>
              <i class="uil uil-eye-slash showHidePw"></i>
            </div>

            <div class="input-field button">
              <input type="submit" value="Login" />
            </div>
          </form>

          <div class="login-options">
            <span class="text">
              <a href="forget_password.php">Forgot Password?</a>
            </span>
          </div>

          <div class="login-signup">
            <span class="text">
              Not a member?
              <a href="register.php">Signup Now</a>
            </span>
          </div>

        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
