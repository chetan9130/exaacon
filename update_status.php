<?php
require 'config.php';  // Include database connection
session_start();

// Check if the form is submitted
if (isset($_POST['status']) && isset($_POST['user_id'])) {
    $status = $_POST['status'];
    $user_id = intval($_POST['user_id']);

    // Update the user's status in the database
    $stmt = $conn->prepare("UPDATE users SET form_status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $user_id);
    
    if ($stmt->execute()) {
        // Redirect back to the admin panel after updating
        header("Location: admin_panel.php");
    } else {
        echo "Error updating status.";
    }
} else {
    echo "Invalid request.";
}
?>
