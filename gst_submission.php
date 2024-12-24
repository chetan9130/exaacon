<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acon"; // Make sure to use the correct database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mock user ID for testing, replace with actual user session logic
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $entityType = $_POST['entityType'];
    $form_name = "GST Document Submission"; // Define form name here (or dynamic based on form type)

    // Check for existing submission for the same user and entity type
    $checkQuery = "SELECT COUNT(*) AS count FROM gst_submissions WHERE user_id = ? AND entity_type = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("is", $user_id, $entityType);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "<script>alert('You have already submitted documents for this entity type.'); window.location.href='gst.php';</script>";
        $checkStmt->close();
        $conn->close();
        exit;
    }
    $checkStmt->close();

    $uploadDir = "uploads/";
    $filePaths = [
        'aadhar_card' => null,
        'pan_card' => null,
        'photo' => null,
        'partnership_deed' => null,
        'certificate_of_incorporation' => null,
        'moa' => null,
        'aoa' => null,  // Added for Private Ltd entity
    ];

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Process file uploads for GST submission
    $fileFields = [
        'aadharCardProprietor' => 'aadhar_card',
        'panCardProprietor' => 'pan_card',
        'photoProprietor' => 'photo',
        'aadharCardPartnership' => 'aadhar_card',
        'panCardPartnership' => 'pan_card',
        'partnershipDeed' => 'partnership_deed',
        'certificateOfIncorporation' => 'certificate_of_incorporation',
        'moa' => 'moa',
        'aoa' => 'aoa', // For Private Ltd entity
    ];

    foreach ($fileFields as $formField => $dbField) {
        if (isset($_FILES[$formField]) && $_FILES[$formField]['error'] === UPLOAD_ERR_OK) {
            $filename = basename($_FILES[$formField]['name']);
            $targetPath = $uploadDir . time() . "_" . $filename;

            if (move_uploaded_file($_FILES[$formField]['tmp_name'], $targetPath)) {
                $filePaths[$dbField] = $targetPath;
            }
        }
    }

    // Insert data into the database
    $stmt = $conn->prepare(
        "INSERT INTO gst_submissions (user_id, entity_type, form_name, aadhar_card_path, pan_card_path, photo_path, 
         partnership_deed_path, certificate_of_incorporation_path, moa_path, aoa_path)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "isssssssss",
        $user_id,
        $entityType,
        $form_name, // Now it's defined
        $filePaths['aadhar_card'],
        $filePaths['pan_card'],
        $filePaths['photo'],
        $filePaths['partnership_deed'],
        $filePaths['certificate_of_incorporation'],
        $filePaths['moa'],
        $filePaths['aoa'] // For Private Ltd
    );

    if ($stmt->execute()) {
        echo "<script>alert('Document Submitted Successfully'); window.location.href='gst.php';</script>";
    } else {
        echo "<script>alert('ERROR: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
