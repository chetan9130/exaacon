<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acon";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mock user ID for testing, replace with actual user session logic
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $businessType = $_POST['businessType'];
    $uploadDir = "uploads/";
    $filePaths = [
        'owner_aadhar' => null,
        'owner_pan' => null,
        'owner_photo' => null,
        'partners_docs' => null,
        'partnership_deed' => null,
        'directors_docs' => null,
        'certificate_incorporation' => null,
        'moa' => null,
        'board_resolution' => null,
        'logo' => null,
        'old_document' => null,
    ];

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Map form fields to database fields
    $fileFields = [
        'ownerAadhar' => 'owner_aadhar',
        'ownerPan' => 'owner_pan',
        'ownerPhoto' => 'owner_photo',
        'partnersDocs' => 'partners_docs',
        'partnershipDeed' => 'partnership_deed',
        'directorsDocs' => 'directors_docs',
        'certificateIncorporation' => 'certificate_incorporation',
        'moa' => 'moa',
        'boardResolution' => 'board_resolution',
        'logo' => 'logo',
        'oldDocument' => 'old_document',
    ];

    // Process file uploads
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
        "INSERT INTO trademark_submissions (
            user_id, business_type, owner_aadhar, owner_pan, owner_photo,
            partners_docs, partnership_deed, directors_docs, certificate_incorporation,
            moa, board_resolution, logo, old_document
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "issssssssssss",
        $user_id,
        $businessType,
        $filePaths['owner_aadhar'],
        $filePaths['owner_pan'],
        $filePaths['owner_photo'],
        $filePaths['partners_docs'],
        $filePaths['partnership_deed'],
        $filePaths['directors_docs'],
        $filePaths['certificate_incorporation'],
        $filePaths['moa'],
        $filePaths['board_resolution'],
        $filePaths['logo'],
        $filePaths['old_document']
    );

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Documents submitted successfully'); window.location.href='success_page.php';</script>";
    } else {
        echo "<script>alert('Error submitting form: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
