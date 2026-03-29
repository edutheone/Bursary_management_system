<?php
session_start();
include '../config.php';

// Student ID stored after login
$id_number = $_SESSION['id_number'];

$stmt = $conn->prepare("SELECT * FROM applications WHERE id_number = ?");
$stmt->bind_param("s", $id_number);
$stmt->execute();

$result = $stmt->get_result();
$app = $result->fetch_assoc();
?>

<h2>My Bursary Application</h2>

<?php if($app){ ?>

<p><strong>Name:</strong> <?= $app['full_name'] ?></p>
<p><strong>Ward:</strong> <?= $app['ward'] ?></p>
<p><strong>School:</strong> <?= $app['school'] ?></p>

<h3>Application Status</h3>

<?php
$status = $app['status'];

if($status == "Pending"){
    echo "<p style='color:orange;font-size:18px;'>⏳ Your application is under review</p>";
}

elseif($status == "Approved"){
    echo "<p style='color:green;font-size:18px;'>✅ Congratulations! Your bursary has been approved</p>";
}

elseif($status == "Rejected"){
    echo "<p style='color:red;font-size:18px;'>❌ Unfortunately your application was not successful</p>";
}
?>

<?php } else { ?>

<p>You have not submitted a bursary application yet.</p>

<?php } ?>