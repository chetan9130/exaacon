<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
//$form_name = "Leave and License Document";
$entityType = $_POST['entityType'];

// File upload handling
function uploadFile($fileInputName) {
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES[$fileInputName]["name"]);
        $targetFilePath = $targetDir . uniqid() . "_" . $fileName;

        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFilePath)) {
            return $targetFilePath;
        }
    }
    return null;
}

// Collect file paths
$aadharCardIndividual = uploadFile('aadharCardIndividual');
$panCardIndividual = uploadFile('panCardIndividual');
$partnershipDeed = uploadFile('partnershipDeed');
$aadharCardPartners = uploadFile('aadharCardPartners');
$panCardPartners = uploadFile('panCardPartners');
$boardResolutionPartners = uploadFile('boardResolutionPartners');
$certificateOfIncorporation = uploadFile('certificateOfIncorporation');
$moa = uploadFile('moa');
$aoa = uploadFile('aoa');
$aadharCardDirectors = uploadFile('aadharCardDirectors');
$panCardDirectors = uploadFile('panCardDirectors');
$boardResolutionDirectors = uploadFile('boardResolutionDirectors');
$placeDocument = uploadFile('placeDocument');
$witnessAadhar = uploadFile('witnessAadhar');

// Insert data into database
$stmt = $conn->prepare("
    INSERT INTO leave_license_submissions (
    user_id, entity_type, aadhar_card_individual, pan_card_individual,
    partnership_deed, aadhar_card_partners, pan_card_partners, board_resolution_partners,
    certificate_of_incorporation, moa, aoa, aadhar_card_directors, pan_card_directors,
    board_resolution_directors, place_document, witness_aadhar, submission_date
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())

");

$stmt->bind_param(
    "isssssssssssssss",
    $user_id, $entityType, $aadharCardIndividual, $panCardIndividual,
    $partnershipDeed, $aadharCardPartners, $panCardPartners, $boardResolutionPartners,
    $certificateOfIncorporation, $moa, $aoa, $aadharCardDirectors, $panCardDirectors,
    $boardResolutionDirectors, $placeDocument, $witnessAadhar
);




if ($stmt->execute()) {
    echo "Form submitted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
