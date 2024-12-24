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

    // Check for existing submission for the same user and business type
    $checkQuery = "SELECT COUNT(*) AS count FROM udhyam_submissions WHERE user_id = ? AND business_type = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("is", $user_id, $businessType);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "<script>alert('You have already submitted documents for this business type.'); window.location.href='udhyam.php';</script>";
        $checkStmt->close();
        $conn->close();
        exit;
    }
    $checkStmt->close();

    // Directory to store uploaded files
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileData = [
        'ownerAadhar' => null,
        'ownerPan' => null,
        'partnersDocs' => null,
        'partnershipDeed' => null,
        'directorsDocs' => null,
        'certificate' => null,
        'moa' => null,
        'boardResolution' => null
    ];

    // Process file uploads
    $fileFields = [
        'ownerAadhar' => 'ownerAadhar',
        'ownerPan' => 'ownerPan',
        'partnersDocs' => 'partnersDocs',
        'partnershipDeed' => 'partnershipDeed',
        'directorsDocs' => 'directorsDocs',
        'certificate' => 'certificate',
        'moa' => 'moa',
        'boardResolution' => 'boardResolution'
    ];

    foreach ($fileFields as $formField => $dbField) {
        if (isset($_FILES[$formField]) && $_FILES[$formField]['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($_FILES[$formField]['name']);
            $targetFile = $uploadDir . $fileName;

            // Move uploaded file to the target directory
            if (move_uploaded_file($_FILES[$formField]['tmp_name'], $targetFile)) {
                $fileData[$dbField] = $targetFile; // Save the file path
            }
        }
    }

    // Insert data into the database
    $stmt = $conn->prepare(
        "INSERT INTO udhyam_submissions (user_id, business_type, owner_aadhar, owner_pan, partners_docs,
         partnership_deed, directors_docs, certificates, moa, board_resolution)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "isssssssss",
        $user_id,
        $businessType,
        $fileData['ownerAadhar'],
        $fileData['ownerPan'],
        $fileData['partnersDocs'],
        $fileData['partnershipDeed'],
        $fileData['directorsDocs'],
        $fileData['certificate'],
        $fileData['moa'],
        $fileData['boardResolution']
    );

    if ($stmt->execute()) {
        echo "<script>alert('Document Submitted Successfully'); window.location.href='udhyam.php';</script>";
    } else {
        echo "<script>alert('ERROR: " . $stmt->error . "');window.location.href='udhyam.php'</script>";
    }

    $stmt->close();
}

$conn->close();
?>
