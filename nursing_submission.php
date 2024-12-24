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
$aadharCardPath = uploadFile('aadharCardProprietor') ?: uploadFile('aadharCardPartners') ?: uploadFile('aadharCardDirectors');
$panCardPath = uploadFile('panCardProprietor') ?: uploadFile('panCardPartners') ?: uploadFile('panCardDirectors');
$photoPath = uploadFile('photoProprietor') ?: uploadFile('photoPartners') ?: uploadFile('photoDirectors');
$placeDocumentPath = uploadFile('uttaraDocument');
$mpcbConsentPath = uploadFile('mpcbConsent');
$taxReceiptPath = uploadFile('taxReceipt');
$waterBillPath = uploadFile('waterBill');
$fireNocPath = uploadFile('fireNoc');
$rentAgreementPath = uploadFile('rentAgreement');
$planPath = uploadFile('plan');
$bioMedicalWastePath = uploadFile('bioMedicalWaste');
$corporationNocPath = uploadFile('corporationNoc');
$doctorAadharPath = uploadFile('doctorAadhar');
$doctorPhotoPath = uploadFile('doctorPhoto');
$degreeCertificatePath = uploadFile('degreeCertificate');
$visitingSurgeonAffidavitPath = uploadFile('visitingSurgeonAffidavit');

// Insert data into database
$stmt = $conn->prepare("INSERT INTO nursing_submissions (user_id, entity_type, aadhar_card_path, pan_card_path, photo_path, place_document_path, mpcb_consent_path, tax_receipt_path, water_bill_path, fire_noc_path, rent_agreement_path, plan_path, bio_medical_waste_path, corporation_noc_path, doctor_aadhar_path, doctor_photo_path, degree_certificate_path, visiting_surgeon_affidavit_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssssssssssssss", $user_id, $entityType, $aadharCardPath, $panCardPath, $photoPath, $placeDocumentPath, $mpcbConsentPath, $taxReceiptPath, $waterBillPath, $fireNocPath, $rentAgreementPath, $planPath, $bioMedicalWastePath, $corporationNocPath, $doctorAadharPath, $doctorPhotoPath, $degreeCertificatePath, $visitingSurgeonAffidavitPath);

if ($stmt->execute()) {
    echo "Form submitted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
