<?php
session_start();
include '../config.php';

$id_number = $_SESSION['id_number'];

$stmt = $conn->prepare("SELECT * FROM applications WHERE id_number = ?");
$stmt->bind_param("s", $id_number);
$stmt->execute();
$app = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bursary Update</title>
    <link rel="stylesheet" href="bursary.css">
</head>
<body>

<div class="container">
    <h2>Bursary Details</h2>

    <?php if ($app): ?>
        <p><strong>Name:</strong> <span><?= htmlspecialchars($app['full_name']) ?></span></p>
        <p><strong>Ward:</strong> <span><?= htmlspecialchars($app['ward']) ?></span></p>
        <p><strong>School:</strong> <span><?= htmlspecialchars($app['school']) ?></span></p>

        <p><strong>Status:</strong>
        <span class="status-text">
        <?php
        if ($app['status'] == 'Pending') {
            echo "<span style='color:orange;'>Application⏳ under review</span>";
        } elseif ($app['status'] == 'Approved') {
            echo "<span style='color:green;'>Bursary✅ Approved</span>";
        } elseif ($app['status'] == 'Rejected') {
            echo "<span style='color:red;'>Application❌ Rejected</span>";
        }
        ?>
        </span>
        </p>

    <?php else: ?>
        <div class="no-data">
            <p>You have not applied yet.</p>
            <a href="application.php" class="btn-apply">Apply Now</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>