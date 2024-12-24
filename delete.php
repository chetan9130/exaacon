<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Delete dependent records in the company_incorporation table
    $delete_dependents_stmt = $conn->prepare("DELETE FROM company_incorporation WHERE user_id = ?");
    $delete_dependents_stmt->bind_param("i", $id);
    $delete_dependents_stmt->execute();
    $delete_dependents_stmt->close();

    // Delete dependent records in the leave_license_submissions table
    $delete_leave_stmt = $conn->prepare("DELETE FROM leave_license_submissions WHERE user_id = ?");
    $delete_leave_stmt->bind_param("i", $id);
    $delete_leave_stmt->execute();
    $delete_leave_stmt->close();
    
    // Delete dependent records in the nursing_submissions table
    $delete_nursing_stmt = $conn->prepare("DELETE FROM nursing_submissions WHERE user_id = ?");
    $delete_nursing_stmt->bind_param("i", $id);
    $delete_nursing_stmt->execute();
    $delete_nursing_stmt->close();

    $delete_nursing_stmt = $conn->prepare("DELETE FROM barcode_submissions WHERE user_id = ?");
    $delete_nursing_stmt->bind_param("i", $id);
    $delete_nursing_stmt->execute();
    $delete_nursing_stmt->close();

    $delete_nursing_stmt = $conn->prepare("DELETE FROM gst_submissions WHERE user_id = ?");
    $delete_nursing_stmt->bind_param("i", $id);
    $delete_nursing_stmt->execute();
    $delete_nursing_stmt->close();

    $delete_nursing_stmt = $conn->prepare("DELETE FROM mpcb_submissions WHERE user_id = ?");
    $delete_nursing_stmt->bind_param("i", $id);
    $delete_nursing_stmt->execute();
    $delete_nursing_stmt->close();

    $delete_nursing_stmt = $conn->prepare("DELETE FROM partnership_submissions WHERE user_id = ?");
    $delete_nursing_stmt->bind_param("i", $id);
    $delete_nursing_stmt->execute();
    $delete_nursing_stmt->close();

    $delete_nursing_stmt = $conn->prepare("DELETE FROM udhyam_submissions WHERE user_id = ?");
    $delete_nursing_stmt->bind_param("i", $id);
    $delete_nursing_stmt->execute();
    $delete_nursing_stmt->close();
    
    // Delete dependent records in other tables (e.g., user_orders, user_profiles) if needed
    // Repeat similar delete statements for each dependent table
    
    // Now, delete the user from the users table
    $delete_user_stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $delete_user_stmt->bind_param("i", $id);

    if ($delete_user_stmt->execute()) {
        echo "<script>alert('All user data deleted successfully'); window.location.href='admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error deleting user');</script>";
    }

    $delete_user_stmt->close();
}
?>
