<?php
require('fpdf/fpdf.php'); // Include FPDF library
require 'config.php'; // Include database connection

// Get the user ID from the POST request
$user_id = $_POST['user_id'];

// Fetch user data based on the provided ID
$stmt = $conn->prepare("SELECT id, photo, full_name, email, phone, aadhaar, birth_date, address_line1, address_line2, gender, country, city, region, postal_code, time_created, sign FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();

// Fetch form submission details from multiple tables
$submission_query = "
    SELECT 'Drug License' AS form_type, form_name, submission_date
    FROM drug_license_submissions
    WHERE user_id = ?
    UNION ALL
    SELECT 'Barcode' AS form_type, form_name, submission_date
    FROM barcode_submissions
    WHERE user_id = ?
    UNION ALL
    SELECT 'Trademark' AS form_type, 'trademark_name' AS form_name, submission_date
    FROM trademark_submissions
    WHERE user_id = ?
    UNION ALL
    SELECT 'Shopact' AS form_type, form_name, submission_date
    FROM shop_act_submissions
    WHERE user_id = ?
";
$form_stmt = $conn->prepare($submission_query);
$form_stmt->bind_param("iiii", $user_id, $user_id, $user_id, $user_id);
$form_stmt->execute();
$form_result = $form_stmt->get_result();

// Create PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set title and font
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'User and Form Details', 0, 1, 'C');

// User Details
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$pdf->Cell(0, 10, 'User Details', 0, 1);
$pdf->Cell(0, 10, 'ID: ' . $user_result->fetch_assoc()['id'], 0, 1);
$pdf->Cell(0, 10, 'Full Name: ' . $user_result->fetch_assoc()['full_name'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $user_result->fetch_assoc()['email'], 0, 1);
$pdf->Cell(0, 10, 'Phone: ' . $user_result->fetch_assoc()['phone'], 0, 1);
// Add more fields as needed...

// Form Submissions
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Form Submissions', 0, 1);
if ($form_result->num_rows > 0) {
    while ($form_row = $form_result->fetch_assoc()) {
        $pdf->Cell(0, 10, $form_row['form_type'] . ': ' . $form_row['form_name'], 0, 1);
        $pdf->Cell(0, 10, 'Submission Date: ' . $form_row['submission_date'], 0, 1);
    }
} else {
    $pdf->Cell(0, 10, 'No form submissions found for this user.', 0, 1);
}

// Output the PDF
$pdf->Output('D', 'user_details.pdf'); // Download PDF as 'user_details.pdf'
exit;
?>
