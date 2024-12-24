<?php
//require 'admin_check.php'; // Include admin login check
require 'config.php'; // Include database connection

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid request!'); window.location.href='admin_panel.php';</script>";
    exit;
}

$user_id = intval($_GET['id']);

// Fetch the user's current data
$stmt = $conn->prepare("SELECT full_name, email, phone, aadhaar, birth_date, gender, address_line1, address_line2, country, city, region, postal_code FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('User not found!'); window.location.href='admin_panel.php';</script>";
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();

// Update user data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $aadhaar = htmlspecialchars($_POST['aadhaar']);
    $birth_date = htmlspecialchars($_POST['birth_date']);
    $gender = htmlspecialchars($_POST['gender']);
    $address_line1 = htmlspecialchars($_POST['address_line1']);
    $address_line2 = htmlspecialchars($_POST['address_line2']);
    $country = htmlspecialchars($_POST['country']);
    $city = htmlspecialchars($_POST['city']);
    $region = htmlspecialchars($_POST['region']);
    $postal_code = htmlspecialchars($_POST['postal_code']);

    $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ?, phone = ?, aadhaar = ?, birth_date = ?, gender = ?, address_line1 = ?, address_line2 = ?, country = ?, city = ?, region = ?, postal_code = ? WHERE id = ?");
    $stmt->bind_param("ssssssssssssi", $full_name, $email, $phone, $aadhaar, $birth_date, $gender, $address_line1, $address_line2, $country, $city, $region, $postal_code, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('User details updated successfully!'); window.location.href='admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error updating user details: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyle.css">
    <title>Edit User</title>
</head>
<body>
    <div class="admin-container">
        <h1>Edit User</h1>
        <form method="POST" class="form">
            <div class="input-box">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="input-box">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>
            <div class="input-box">
                <label for="aadhaar">Aadhaar</label>
                <input type="text" id="aadhaar" name="aadhaar" value="<?php echo htmlspecialchars($user['aadhaar']); ?>" required>
            </div>
            <div class="input-box">
                <label for="birth_date">Birth Date</label>
                <input type="date" id="birth_date" name="birth_date" value="<?php echo htmlspecialchars($user['birth_date']); ?>" required>
            </div>
            <div class="input-box">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="male" <?php echo $user['gender'] === 'male' ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo $user['gender'] === 'female' ? 'selected' : ''; ?>>Female</option>
                    <option value="prefer not to say" <?php echo $user['gender'] === 'prefer not to say' ? 'selected' : ''; ?>>Prefer not to say</option>
                </select>
            </div>
            <div class="input-box">
                <label for="address_line1">Address Line 1</label>
                <input type="text" id="address_line1" name="address_line1" value="<?php echo htmlspecialchars($user['address_line1']); ?>" required>
            </div>
            <div class="input-box">
                <label for="address_line2">Address Line 2</label>
                <input type="text" id="address_line2" name="address_line2" value="<?php echo htmlspecialchars($user['address_line2']); ?>" required>
            </div>
            <div class="input-box">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($user['country']); ?>" required>
            </div>
            <div class="input-box">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
            </div>
            <div class="input-box">
                <label for="region">Region</label>
                <input type="text" id="region" name="region" value="<?php echo htmlspecialchars($user['region']); ?>" required>
            </div>
            <div class="input-box">
                <label for="postal_code">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($user['postal_code']); ?>" required>
            </div>
            <button type="submit" class="submit-btn">Update User</button>
        </form>
    </div>
</body>
</html>
