<?php
session_start();
include 'config.php'; // Include your database connection

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$userId = $_SESSION['user_id'];

// Function to handle file uploads
function uploadFile($inputName) {
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES[$inputName]['name']);
        $filePath = $uploadDir . $fileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $filePath)) {
            return $filePath;
        }
    }
    return null;
}

// Collect form data
$directorName = $_POST['directorName'];
$directorAddress = $_POST['directorAddress'];
$directorContact = $_POST['directorContact'];
$vehicleList = $_POST['vehicleList'];

// Upload files
$photoIdProof = uploadFile('photoIdProof');
$possessionProof = uploadFile('possessionProof');
$firmConstitution = uploadFile('firmConstitution');
$nominationClause = uploadFile('nominationClause');
$waterReport = uploadFile('waterReport');
$iecDocument = uploadFile('iecDocument');
$recallPlan = uploadFile('recallPlan');

// Insert into database
$stmt = $conn->prepare("INSERT INTO partnership_submissions (
    user_id, director_name, director_address, director_contact, photo_id_proof,
    possession_proof, firm_constitution, nomination_clause, water_report,
    iec_document, recall_plan, vehicle_list
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    'isssssssssss',
    $userId, $directorName, $directorAddress, $directorContact, $photoIdProof,
    $possessionProof, $firmConstitution, $nominationClause, $waterReport,
    $iecDocument, $recallPlan, $vehicleList
);

if ($stmt->execute()) {
    echo "Submission successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
