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
    $companyType = $_POST['companyType'];
    $formName = isset($_POST['form_name']) ? $_POST['form_name'] : 'Unknown Form'; // Get form name from POST data
    $uploadDir = "uploads/";
    $filePaths = [
        'pan_card' => null,
        'balance_sheet' => null,
        'barcode_request_letter' => null,
        'proprietorship_proof' => null,
        'partnership_proof' => null,
        'gst_certificate' => null,
        'roc_certificate' => null,
        'other_proof' => null,
        'cancelled_cheque' => null,
    ];

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Map form fields to database fields
    $fileFields = [
        'panCard' => 'pan_card',
        'balanceSheet' => 'balance_sheet',
        'barcodeRequestLetter' => 'barcode_request_letter',
        'proprietorshipProof' => 'proprietorship_proof',
        'partnershipProof' => 'partnership_proof',
        'gstCertificate' => 'gst_certificate',
        'rocCertificate' => 'roc_certificate',
        'otherProof' => 'other_proof',
        'cancelledCheque' => 'cancelled_cheque',
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
    $checkQuery = "SELECT id FROM barcode_submissions WHERE user_id = ? AND company_type = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("is", $user_id, $companyType);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "<script>alert('You have already submitted documents for this company type and form.'); window.location.href='form_page.php';</script>";
        exit;
    }
    $checkStmt->close();

    // Insert submission data into the database
    $stmt = $conn->prepare(
        "INSERT INTO barcode_submissions (
            user_id, company_type, form_name, pan_card, balance_sheet, barcode_request_letter,
            proprietorship_proof, partnership_proof, gst_certificate, roc_certificate,
            other_proof, cancelled_cheque
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "isssssssssss", // Correct number of data types for binding
        $user_id,
        $companyType,
        $formName,
        $filePaths['pan_card'],
        $filePaths['balance_sheet'],
        $filePaths['barcode_request_letter'],
        $filePaths['proprietorship_proof'],
        $filePaths['partnership_proof'],
        $filePaths['gst_certificate'],
        $filePaths['roc_certificate'],
        $filePaths['other_proof'],
        $filePaths['cancelled_cheque']
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
