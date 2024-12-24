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
    $entityType = $_POST['entityType'];
    $formName = isset($_POST['form_name']) ? $_POST['form_name'] : 'Unknown Form';  // Get form name from POST data

    $uploadDir = "uploads/";
    $filePaths = [
        'aadhar_card' => null,
        'pan_card' => null,
        'photo' => null,
        'partnership_deed' => null,
        'certificate_of_incorporation' => null,
        'moa' => null,
        'board_resolution' => null,
    ];

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Map form fields to database fields
    $fileFields = [
        'aadharCardProprietor' => 'aadhar_card',
        'panCardProprietor' => 'pan_card',
        'photoProprietor' => 'photo',
        'aadharCardPartnership' => 'aadhar_card',
        'panCardPartnership' => 'pan_card',
        'photoPartnership' => 'photo',
        'partnershipDeed' => 'partnership_deed',
        'aadharCardPvtLtd' => 'aadhar_card',
        'panCardPvtLtd' => 'pan_card',
        'photoPvtLtd' => 'photo',
        'certificateOfIncorporation' => 'certificate_of_incorporation',
        'moa' => 'moa',
        'boardResolution' => 'board_resolution',
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

    // Check for duplicate submission
    $checkQuery = "SELECT id FROM drug_license_submissions WHERE user_id = ? AND entity_type = ? AND form_name = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("iss", $user_id, $entityType, $formName);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "<script>alert('You have already submitted documents for this entity type.'); window.location.href='form_page.php';</script>";
        exit;
    }
    $checkStmt->close();

    // Insert submission data into the database
    $stmt = $conn->prepare(
        "INSERT INTO drug_license_submissions (
            user_id, entity_type, form_name, aadhar_card_path, pan_card_path, photo_path,
            partnership_deed_path, certificate_of_incorporation_path, moa_path, board_resolution_path
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "isssssssss",
        $user_id,
        $entityType,
        $formName,
        $filePaths['aadhar_card'],
        $filePaths['pan_card'],
        $filePaths['photo'],
        $filePaths['partnership_deed'],
        $filePaths['certificate_of_incorporation'],
        $filePaths['moa'],
        $filePaths['board_resolution']
    );

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Document Submitted Successfully'); window.location.href='drug.php';</script>";
    } else {
        echo "<script>alert('Error submitting form: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
