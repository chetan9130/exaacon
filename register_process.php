<?php
// Include the connection file
require 'config.php';

if (isset($_POST['submit'])) {
    // Sanitize and get form data
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $aadhaar = htmlspecialchars($_POST['aadhaar']);
    $birth_date = htmlspecialchars($_POST['birth_date']);
    $gender = htmlspecialchars($_POST['gender']);
    $address_line1 = htmlspecialchars($_POST['address_line1']);
    $address_line2 = htmlspecialchars($_POST['address_line2']);
    $country = htmlspecialchars($_POST['country']);
    $city = htmlspecialchars($_POST['city']);
    $region = htmlspecialchars($_POST['region']);
    $postal_code = htmlspecialchars($_POST['postal_code']);
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    // Handling file uploads
    $upload_dir = 'uploads/';
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $sign = $_FILES['sign']['name'];
    $sign_tmp = $_FILES['sign']['tmp_name'];

    // Validate file types and sizes
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
    if (in_array($_FILES['photo']['type'], $allowed_types) && $_FILES['photo']['size'] <= 2000000 &&
        in_array($_FILES['sign']['type'], $allowed_types) && $_FILES['sign']['size'] <= 2000000) {

        // Check if email, phone, or Aadhaar already exists
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR phone = ? OR aadhaar = ?");
        $check_stmt->bind_param("sss", $email, $phone, $aadhaar);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "<script>alert('Email, phone, or Aadhaar number already registered');</script>";
        } else {
            // Move uploaded files
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); // Create upload directory if it doesn't exist
            }
            move_uploaded_file($photo_tmp, $upload_dir . $photo);
            move_uploaded_file($sign_tmp, $upload_dir . $sign);

            // Calculate the membership end date (6 months from today)
            $current_date = new DateTime();
            $membership_end_date = $current_date->modify('+6 months')->format('Y-m-d');
            
            // Set the initial status as 'active'
            $status = 'active';

            // Check if the membership has expired
            $current_date_str = $current_date->format('Y-m-d');
            if ($current_date_str > $membership_end_date) {
                $status = 'suspended'; // Change status to suspended if expired
            }

            // Insert query with membership_end_date and status
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, pass, phone, aadhaar, birth_date, gender, address_line1, address_line2, country, city, region, postal_code, photo, sign, membership_start_date, membership_end_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
            $stmt->bind_param("ssssssssssssssssss", $full_name, $email, $pass, $phone, $aadhaar, $birth_date, $gender, $address_line1, $address_line2, $country, $city, $region, $postal_code, $photo, $sign, $current_date_str, $membership_end_date, $status);

            if ($stmt->execute()) {
                echo "<script>alert('Registered Successfully'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        }
        $check_stmt->close();
    } else {
        echo "<script>alert('Invalid file type or size exceeds 2MB');</script>";
    }

    $conn->close();
}
?>
