<?php
session_start();
include 'config.php'; // Include the database connection

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    echo "User is not logged in.";
    exit;
}

// Function to handle file upload
function uploadFile($inputName) {
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
        $fileTmpPath = $_FILES[$inputName]['tmp_name'];
        $fileName = basename($_FILES[$inputName]['name']);
        $uploadDir = 'uploads/';
        
        // Create the uploads directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filePath = $uploadDir . $fileName;
        
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            return $filePath;
        } else {
            echo "Error moving file: " . $_FILES[$inputName]['error'];
            return null;
        }
    } else {
        echo "File upload error code: " . $_FILES[$inputName]['error'];
        return null;
    }
}

// Form data processing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $businessType = $_POST['businessType'];
    $paidUpCapital = (int)$_POST['paidUpCapital'];
    $equityShares = (int)$_POST['equityShares'];
    $authorizedShareCapital = (int)$_POST['authorizedShareCapital'];
    $emailIds = $_POST['emailIds'];
    $mobileNos = $_POST['mobileNos'];
    $occupation = $_POST['occupation'];
    $nationality = $_POST['nationality'];
    $officeOwnerName = $_POST['officeOwnerName'];
    $policeStation = $_POST['policeStation'];
    $bankName = $_POST['bankName'];

    // Handle file uploads
    $promotersPan = uploadFile('promotersPan');
    $addressProof = uploadFile('addressProof');
    $officeProof = uploadFile('officeProof');
    $digitalSignature = uploadFile('digitalSignature');
    $photo = uploadFile('photo');

    // Check if file uploads were successful
    if (!$promotersPan || !$addressProof || !$officeProof || !$digitalSignature || !$photo) {
        echo "File upload failed. Please try again.";
        exit;
    }

    // Prepare SQL query to insert data into the database
    $query = "INSERT INTO company_incorporation (
                user_id, business_type, paid_up_capital, equity_shares, promoters_pan, address_proof,
                email_ids, mobile_nos, occupation, nationality, office_owner_name, office_proof,
                authorized_share_capital, digital_signature, photo, police_station, bank_name
              ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        // Bind parameters with correct types
        $stmt->bind_param(
            'isiiissssssssssss',
            $userId, $businessType, $paidUpCapital, $equityShares, $promotersPan, $addressProof,
            $emailIds, $mobileNos, $occupation, $nationality, $officeOwnerName, $officeProof,
            $authorizedShareCapital, $digitalSignature, $photo, $policeStation, $bankName
        );

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Document Submitted Successfully'); window.location.href='company_submission.php';</script>";
        } else {
            echo "Error submitting the form: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the query: " . $conn->error;
    }

    $conn->close();
}
?>
