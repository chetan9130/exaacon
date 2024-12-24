<?php
require 'config.php'; // Include database connection
session_start();

// Validate and retrieve form_id and form_type from the URL
if (isset($_GET['form_id']) && isset($_GET['form_type'])) {
    $form_id = intval($_GET['form_id']);
    $form_type = $_GET['form_type'];

    // Define the table name based on the form type
    $tables = [
        'Drug License' => 'drug_license_submissions',
        'Barcode' => 'barcode_submissions',
        'Trademark' => 'trademark_submissions',
        'Shopact' => 'shop_act_submissions',
        'MPCB' => 'mpcb_submissions',
        'Company Registration' => 'company_incorporation',
        'GST Registration' => 'gst_submissions',
        'Nursing Registration' => 'nursing_submissions',
        'Partnership Deed Registration' => 'partnership_submissions',
        'Udhyam Registration' => 'udhyam_submissions'
    ];

    if (array_key_exists($form_type, $tables)) {
        $table_name = $tables[$form_type];

        // Fetch form data from the corresponding table
        $query = "SELECT * FROM $table_name WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $form_id);
        $stmt->execute();
        $form_result = $stmt->get_result();

        if ($form_result->num_rows == 1) {
            $form_data = $form_result->fetch_assoc();
        } else {
            die("Form data not found.");
        }
    } else {
        die("Invalid form type.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Form Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        img {
            max-width: 200px;
            max-height: 200px;
            
        }
        .print-button {
    display: block;
    width: 200px;
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    margin: 20px auto;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.print-button:hover {
    background-color: #0056b3;
}
        .print-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Details - <?php echo htmlspecialchars($form_type); ?></h1>
        <table>
            <tbody>
                <?php foreach ($form_data as $key => $value): ?>
                    <tr>
                        <th><?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $key))); ?></th>
                        <td>
                        <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $value)): ?>
    <img src="<?php echo htmlspecialchars($value); ?>" alt="Image" style="width: 150px; height: 150px; object-fit: cover;">
    <br>
    <a href="<?php echo htmlspecialchars($value); ?>" download>Download</a>
<?php elseif (preg_match('/\.(pdf)$/i', $value)): ?>
    <embed src="document.pdf" width="600" height="400" type="application/pdf">

    <br>
    <a href="<?php echo htmlspecialchars($value); ?>" download>Download PDF</a>
<?php else: ?>
    <?php echo htmlspecialchars($value); ?>
<?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button class="print-button" onclick="window.print()">Generate PDF</button><br>
        <a href="javascript:history.back()">Go Back</a>
    </div>
</body>
</html>
