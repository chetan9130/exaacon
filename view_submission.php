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
    // Get the submission ID to edit the form
    $submission_id = $_POST['submission_id'];
    // Fetch the data for that submission
   
    $query = "SELECT * FROM drug_license_submissions WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $submission_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $submission = $result->fetch_assoc();
    $stmt->close();
}

$query = "SELECT * FROM drug_license_submissions WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Submissions</title>
</head>
<body>
    <h1>Your Document Submissions</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Company Type</th>
                <th>Form Name</th>
                <th>View</th>
                <th>Edit</th><?php
session_start();
require 'config.php'; // Include database connection

// Check if the user ID is provided in the query string
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid user ID.'); window.location.href='admin_dashboard.php';</script>";
    exit;
}

$user_id = intval($_GET['id']);

// Fetch user details from the database
$query = "SELECT 
    full_name, email, phone, aadhaar, birth_date, gender, 
    address_line1, address_line2, country, city, region, postal_code, photo, sign 
FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows === 0) {
    echo "<script>alert('User not found.'); window.location.href='admin_dashboard.php';</script>";
    exit;
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyle.css"> <!-- Your custom stylesheet -->
    <title>View User Details</title>
</head>
<body>
    <div class="user-details-container">
        <h1>User Details</h1>

        <table class="user-details-table">
            <tr>
                <th>Full Name:</th>
                <td><?php echo htmlspecialchars($user['full_name']); ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>
            <tr>
                <th>Phone:</th>
                <td><?php echo htmlspecialchars($user['phone']); ?></td>
            </tr>
            <tr>
                <th>Aadhaar:</th>
                <td><?php echo htmlspecialchars($user['aadhaar']); ?></td>
            </tr>
            <tr>
                <th>Birth Date:</th>
                <td><?php echo htmlspecialchars($user['birth_date']); ?></td>
            </tr>
            <tr>
                <th>Gender:</th>
                <td><?php echo htmlspecialchars($user['gender']); ?></td>
            </tr>
            <tr>
                <th>Address Line 1:</th>
                <td><?php echo htmlspecialchars($user['address_line1']); ?></td>
            </tr>
            <tr>
                <th>Address Line 2:</th>
                <td><?php echo htmlspecialchars($user['address_line2']); ?></td>
            </tr>
            <tr>
                <th>Country:</th>
                <td><?php echo htmlspecialchars($user['country']); ?></td>
            </tr>
            <tr>
                <th>City:</th>
                <td><?php echo htmlspecialchars($user['city']); ?></td>
            </tr>
            <tr>
                <th>Region:</th>
                <td><?php echo htmlspecialchars($user['region']); ?></td>
            </tr>
            <tr>
                <th>Postal Code:</th>
                <td><?php echo htmlspecialchars($user['postal_code']); ?></td>
            </tr>
            <tr>
                <th>Photo:</th>
                <td>
                    <?php if (!empty($user['photo'])): ?>
                        <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="User Photo" width="150" height="150">
                    <?php else: ?>
                        No photo uploaded.
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Signature:</th>
                <td>
                    <?php if (!empty($user['sign'])): ?>
                        <img src="<?php echo htmlspecialchars($user['sign']); ?>" alt="User Signature" width="150" height="50">
                    <?php else: ?>
                        No signature uploaded.
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <a href="edit_user.php?id=<?php echo $user_id; ?>" class="edit-btn">Edit User</a>
        <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>
</body>
</html>

            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['entity_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['form_name']); ?></td>
                    <td>
                        <a href="view_submission.php?submission_id=<?php echo $row['id']; ?>">View</a>
                    </td>
                    <td>
                        <form method="post" action="edit_submission.php">
                            <input type="hidden" name="submission_id" value="<?php echo $row['id']; ?>" />
                            <input type="submit" value="Edit" />
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You haven't submitted any documents yet.</p>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
