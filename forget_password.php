<?php
include 'config.php'; // Include the database connection

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and normalize the email input
    $email = strtolower(trim(htmlspecialchars($_POST['email'])));

    // Debugging: Output the sanitized email
    // echo "Input Email: " . $email;

    // Check if the user exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Debugging: Output the number of rows found
    // echo "Number of Rows Found: " . $stmt->num_rows;

    if ($stmt->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Insert the token into the database
        $stmt->bind_result($id);
        $stmt->fetch();
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("iss", $id, $token, $expiry);
        $stmt->execute();

        // Prepare the password reset email
        $reset_link = "http://yourdomain.com/reset_password.php?token=" . $token;

        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'chetansonawane2006@gmail.com'; // Your email
            $mail->Password   = 'rkdwbtcyemddosuf'; // Your email app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('chetansonawane2006@gmail.com', 'Aaradhya Consultancy');
            $mail->addAddress($email);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Click the link below to reset your password:<br><a href='$reset_link'>$reset_link</a>";
            $mail->AltBody = "Click the link below to reset your password: $reset_link";

            $mail->send();
            echo "<script>alert('Password reset link sent to your email'); window.location.href='login.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('No account found with that email address');</script>";
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
    <title>Forgot Password</title>
  </head>
  <body>
    <div class="container">
      <div class="forms">
        <div class="form forgot-password">
          <h1>Forgot Password</h1>
          <span class="title">Reset Your Password</span>

          <!-- Forgot Password Form -->
          <form action="" method="POST">
            <div class="input-field">
              <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
              />
              <i class="uil uil-envelope icon"></i>
            </div>

            <div class="input-field button">
              <input type="submit" value="Send Reset Link" />
            </div>
          </form>

          <div class="login-signup">
            <span class="text">
              <a href="login.php">Back to Login</a>
            </span>
          </div>

        </div>
      </div>
    </div>
  </body>
</html>
