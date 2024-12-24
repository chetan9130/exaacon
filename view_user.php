<?php
require 'config.php'; // Include database connection
session_start();

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user data based on the provided ID
    $stmt = $conn->prepare("SELECT id, photo,full_name, email, phone,aadhaar,birth_date, address_line1,address_line2,gender,country,
    city,region,postal_code, time_created,sign FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();

    if ($user_result->num_rows == 1) {
        $user = $user_result->fetch_assoc();

        // Fetch form submission details from multiple tables
        $submission_query = "
          SELECT 'Drug License' AS form_type, id AS form_id, form_name, submission_date
FROM drug_license_submissions
WHERE user_id = ?
UNION ALL
SELECT 'Barcode' AS form_type, id AS form_id, 'Barcode Form Submission ' AS form_name, submission_date
FROM barcode_submissions
WHERE user_id = ?
UNION ALL
SELECT 'Trademark' AS form_type, id AS form_id, 'trademark_name' AS form_name, submission_date
FROM trademark_submissions
WHERE user_id = ?
UNION ALL
SELECT 'Shopact' AS form_type, id AS form_id, form_name, submission_date
FROM shop_act_submissions
WHERE user_id = ?
UNION ALL
SELECT 'MPCB' AS form_type, id AS form_id, 'MPCB' AS form_name, submission_date
FROM mpcb_submissions
WHERE user_id = ?
UNION ALL
SELECT 'Company Registration' AS form_type, id AS form_id, 'Company_Registration_Submission' AS form_name, submission_date
FROM company_incorporation
WHERE user_id = ?
UNION ALL
SELECT 'GST Registration' AS form_type, id AS form_id,form_name, submission_date
FROM gst_submissions
WHERE user_id = ?
UNION ALL
SELECT 'Nursing Registration' AS form_type, id AS form_id,'Nursing Registration Form' AS form_name, created_at
FROM nursing_submissions
WHERE user_id = ?
UNION ALL
SELECT 'Partnership Deed Registration' AS form_type, id AS form_id,'Partnership Form' AS form_name, submission_date
FROM partnership_submissions
WHERE user_id = ?
UNION ALL
SELECT 'Udhyam Registration' AS form_type, id AS form_id,'Udhyam Form' AS form_name, submission_date
FROM udhyam_submissions
WHERE user_id = ?
 ";

        $form_stmt = $conn->prepare($submission_query);
        $form_stmt->bind_param("iiiiiiiiii", $user_id, $user_id, $user_id, $user_id,$user_id,$user_id,$user_id,$user_id,$user_id,$user_id );
        $form_stmt->execute();
        $form_result = $form_stmt->get_result();
    } else {
        die("User not found.");
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
    <link rel="stylesheet" href="adminstyle.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
            .print-button {
            margin-top: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-left:30px;
                    }

        .print-button:hover {
            background-color: #45a049;
        }

        .download-button {
    padding: 10px 20px;
    margin-top: 10px;
    background-color: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.download-button:hover {
    background-color: #0056b3;
}/* Basic body and container styling */
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

h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}

h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
}

/* Styling for the table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
}

th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
}

td {
    background-color: #f9f9f9;
}

td a {
    color: #007BFF;
    text-decoration: none;
}

td a:hover {
    text-decoration: underline;
}

/* Message when no form submissions are found */
p {
    font-size: 16px;
    color: #555;
}

/* Print button styling */
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

/* Back to Admin Panel Link */
a {
    display: inline-block;
    font-size: 16px;
    color: #007BFF;
    text-decoration: none;
    margin-top: 10px;
}

a:hover {
    text-decoration: underline;
}



    </style>
    <title>View User - Admin Panel</title>
</head>
<body>
    <div class="admin-container">
        <h1>View User Details</h1>

        <!-- User Details -->
        <div class="user-details">
        <p><strong>Photo:</strong> </p>
        <img src="uploads/<?php echo htmlspecialchars($user['photo']); ?>" alt="User Photo" style="width: 150px; height: auto;">

<!-- Download Button -->
<a href="uploads/<?php echo htmlspecialchars($user['photo']); ?>" download="<?php echo htmlspecialchars($user['photo']); ?>">
    <button type="button" class="download-button">Download Image</button>
</a>

            <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
            <p><strong>Adhaar No:</strong> <?php echo htmlspecialchars($user['aadhaar']); ?></p>
            <p><strong>Birth Date:</strong> <?php echo htmlspecialchars($user['birth_date']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address_line1']); ?></p>
            <p> <?php echo htmlspecialchars($user['address_line2']); ?></p>
            <p><strong>City:</strong> <?php echo htmlspecialchars($user['city']); ?></p>
            <p><strong>Postal Code:</strong> <?php echo htmlspecialchars($user['postal_code']); ?></p>
            <p><strong>Region:</strong> <?php echo htmlspecialchars($user['region']); ?></p>
            <p><strong>Country:</strong> <?php echo htmlspecialchars($user['country']); ?></p>
            <p><strong>Joined:</strong> <?php echo htmlspecialchars($user['time_created']); ?></p>
            <p><strong>Sign:</strong> </p>
            <img src="uploads/<?php echo htmlspecialchars($user['sign']); ?>" alt="User Photo" style="width: 150px; height: auto;">
            <a href="uploads/<?php echo htmlspecialchars($user['sign']); ?>" download="<?php echo htmlspecialchars($user['sign']); ?>">
    <button type="button" class="download-button">Download Image</button>
</a>
        </div>

        <!-- Form Submissions -->
        <div class="form-submissions">
            <h2>Form Submissions</h2>
            <?php if ($form_result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Form Type</th>
                            <th>Form Name</th>
                            <th>Submission Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($form_row = $form_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($form_row['form_type']); ?></td>
                                <td><?php echo htmlspecialchars($form_row['form_name']); ?></td>
                                <td><?php echo htmlspecialchars($form_row['submission_date']); ?></td>
                                <td>
    <a href="view_form.php?form_id=<?php echo urlencode($form_row['form_id']); ?>&form_type=<?php echo urlencode($form_row['form_type']); ?>">View</a>
</td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No form submissions found for this user.</p>
            <?php endif; ?>
        </div>
<!-- Generate PDF Button -->
<button class="print-button" onclick="window.print()">Generate PDF</button><br>
        <!-- Back to Admin Panel Link -->
        <a href="admin_panel.php">Back to Admin Panel</a>
    </div>
</body>
</html>
