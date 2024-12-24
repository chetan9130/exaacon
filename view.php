<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "registration_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from query string
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = intval($_GET['id']);
    
    // Retrieve user details
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "Invalid ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Details</h2>
    <table>
        <tr>
            <th>ID</th>
            <td><?php echo htmlspecialchars($user['id']); ?></td>
        </tr>
        <tr>
            <th>Photo</th>
            <td>
                <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Photo" style="max-width: 150px;">
            </td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?php echo htmlspecialchars($user['phone']); ?></td>
        </tr>
        <tr>
            <th>Aadhaar</th>
            <td><?php echo htmlspecialchars($user['aadhaar']); ?></td>
        </tr>
        <tr>
            <th>PAN No</th>
            <td><?php echo htmlspecialchars($user['pan']); ?></td>
        </tr>
        <tr>
            <th>Permanent Address</th>
            <td><?php echo htmlspecialchars($user['perm_address']); ?></td>
        </tr>
        <tr>
            <th>Temporary Address</th>
            <td><?php echo htmlspecialchars($user['temp_address']); ?></td>
        </tr>
        <tr>
            <th>Education</th>
            <td><?php echo htmlspecialchars($user['education']); ?></td>
        </tr>
        
        <tr>
            <th>Signature</th>
            <td>
                <img src="<?php echo htmlspecialchars($user['signature']); ?>" alt="Signature" style="max-width: 150px;">
            </td>
        </tr>
        <tr>
            <th>Registration Date</th>
            <td><?php echo htmlspecialchars($user['created_at']); ?></td>
        </tr>
    </table>
    <a href="admin.php" class="action-btn view-btn">Back to List</a>
</div>

</body>
</html>

<?php
$conn->close();
?>
