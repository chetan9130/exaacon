<?php
require 'config.php';
session_start();

$stmt = $conn->prepare("SELECT id, full_name, email, time_created, membership_end_date, status FROM users");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminstyle.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="admin-container">
        <h1>Admin Panel</h1>

        <div class="stats">
            <h2>Users Summary</h2>
            <p>Total Users: <?php echo $result->num_rows; ?></p>
        </div>

        <div class="user-management">
            <h2>Manage Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Membership Start</th>
                        <th>Membership End</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['time_created']); ?></td>
                        <td><?php echo htmlspecialchars($row['membership_end_date']); ?></td>
                        <td>
                            <?php echo (strtotime($row['membership_end_date']) > time()) ? 'Active' : 'Expired'; ?>
                        </td>
                        <td>
                            <!-- Status Dropdown -->
                            <form action="update_status.php" method="POST" style="display:inline;">
                                <select name="status" onchange="this.form.submit()">
                                    <option value="Submitted" <?php if ($row['status'] == 'Submitted') echo 'selected'; ?>>Submitted</option>
                                    <option value="Review" <?php if ($row['status'] == 'Review') echo 'selected'; ?>>Review</option>
                                    <option value="Accepted" <?php if ($row['status'] == 'Accepted') echo 'selected'; ?>>Accepted</option>
                                    <option value="Rejected" <?php if ($row['status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
                                </select>
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            </form>

                            <a href="view_user.php?id=<?php echo $row['id']; ?>" class="btn view-btn">View</a>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>

                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
