<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "business_db";

    // Create database connection
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch form data
    $stmt = $conn->prepare("SELECT * FROM business_documents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        die("No record found.");
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Document</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { width: 80%; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        h1 { text-align: center; }
        .document { margin-bottom: 20px; }
        .document a { color: blue; text-decoration: underline; }
        button { display: block; margin: 20px auto; padding: 10px 20px; background: #4CAF50; color: #fff; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Business Document Details</h1>
        <div class="document">
            <strong>Directors List:</strong>
            <p><?= nl2br(htmlspecialchars($data['directors_list'])) ?></p>
        </div>
        <div class="document">
            <strong>Uploaded Files:</strong>
            <ul>
                <?php foreach ($data as $key => $value): ?>
                    <?php if (strpos($key, 'proof') !== false || strpos($key, 'document') !== false): ?>
                        <?php if (!empty($value)): ?>
                            <li><a href="<?= htmlspecialchars($value) ?>" target="_blank"><?= ucfirst(str_replace("_", " ", $key)) ?></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <button onclick="window.print()">Print Document</button>
    </div>
</body>
</html>
