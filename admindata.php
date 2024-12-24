<?php
require 'config.php'; // Database connection

$admin_email = 'admin@gmail.com'; // Admin email
$admin_password = '1234'; // Plaintext password

// Hash the password using password_hash() in PHP
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Prepare the SQL query to insert the admin user with the hashed password
$stmt = $conn->prepare("INSERT INTO admin (admin_email, pass) VALUES (?, ?)");
$stmt->bind_param("ss", $admin_email, $hashed_password);

// Execute the query and check if the insert was successful
if ($stmt->execute()) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the prepared statement
$stmt->close();
?>
