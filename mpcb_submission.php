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

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in. Please log in to continue.");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $businessType = $_POST['businessType'];

    // Upload files
    $ownerAadhar = uploadFile('ownerAadhar');
    $ownerPan = uploadFile('ownerPan');
    $ownerPhoto = uploadFile('ownerPhoto');
    $propertyDocs = uploadFile('propertyDocs');
    $caCertificate = uploadFile('caCertificate');
    $flowChart = uploadFile('flowChart');
    $stpDeclaration = uploadFile('stpDeclaration');
    $machineryList = uploadFile('machineryList');

    $partnersDocs = ($businessType === 'partnership') ? uploadFile('partnersDocs') : null;
    $partnershipDeed = ($businessType === 'partnership') ? uploadFile('partnershipDeed') : null;
    $directorsDocs = ($businessType === 'pvtLtd') ? uploadFile('directorsDocs') : null;
    $certificateIncorporation = ($businessType === 'pvtLtd') ? uploadFile('certificateIncorporation') : null;
    $moa = ($businessType === 'pvtLtd') ? uploadFile('moa') : null;
    $boardResolution = ($businessType === 'pvtLtd') ? uploadFile('boardResolution') : null;

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO mpcb_submissions (
        user_id, business_type, owner_aadhar, owner_pan, owner_photo, partners_docs, partnership_deed,
        directors_docs, certificate_incorporation, moa, board_resolution, property_docs,
        ca_certificate, flow_chart, stp_declaration, machinery_list
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "isssssssssssssss",
        $user_id, $businessType, $ownerAadhar, $ownerPan, $ownerPhoto, $partnersDocs, $partnershipDeed,
        $directorsDocs, $certificateIncorporation, $moa, $boardResolution, $propertyDocs,
        $caCertificate, $flowChart, $stpDeclaration, $machineryList
    );

    if ($stmt->execute()) {
        echo "<script>alert('Document Submitted Successfully'); window.location.href='shopact.php';</script>";
    } else {
        echo "<script>alert('ERROR: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}

// File upload function
function uploadFile($inputName) {
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES[$inputName]['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFilePath)) {
            return $targetFilePath;
        }
    }
    return null;
}
?>
