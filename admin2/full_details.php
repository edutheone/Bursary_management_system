<?php
include '../config.php';

$id = $_GET['id'];

// Fetch application
$stmt = $conn->prepare("SELECT * FROM applications WHERE application_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$app = $stmt->get_result()->fetch_assoc();

// Fetch documents
$stmt2 = $conn->prepare("SELECT * FROM documents WHERE application_id = ?");
$stmt2->bind_param("i", $id);
$stmt2->execute();
$docs = $stmt2->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html len="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale = 1.0">
    <title>Applicant details</title>
    <link rel="stylesheet" href="style.css">
<body>
    

<h2>Student Full Information</h2>

<h3>PERSONAL INFO</h3>
<p>Name: <?= $app['full_name'] ?></p>
<p>ID: <?= $app['id_number'] ?></p>
<p>Phone: <?= $app['phone'] ?></p>
<p>Email: <?= $app['email'] ?></p>
<p>DOB: <?= $app['date_of_birth'] ?></p>
<p>Ward: <?= $app['ward'] ?></p>
<p>Disability: <?= $app['disability'] ?></p>
<p>Orphan Status: <?= $app['orphan_status'] ?></p>

<h3>EDUCATION</h3>
<p>School: <?= $app['school'] ?></p>
<p>Course: <?= $app['course'] ?></p>
<p>Admission No: <?= $app['admission_number'] ?></p>
<p>Admission Date: <?= $app['admission_date'] ?></p>

<h3>BACKGROUND</h3>
<p>Parent: <?= $app['parent_name'] ?></p>
<p>Phone: <?= $app['parent_phone'] ?></p>
<p>Occupation: <?= $app['occupation'] ?></p>
<p>Income: <?= $app['income'] ?></p>

<h3>DOCUMENTS</h3>
<p><a href="../bursaries/uploads/admission_letters/<?=htmlspecialchars( $docs['admission_letter'] )?>" target="_blank">View Admission Letter</a></p>
<p><a href="../bursaries/uploads/fee_structures/<?= htmlspecialchars($docs['fee_structure'] )?>" target="_blank">View Fee Structure</a></p>
<p><a href="../bursaries/uploads/id_copies/<?= htmlspecialchars($docs['parent_id_copy'])?>" target="_blank">View Parent ID</a></p>
<p><a href="../bursaries/uploads/fee_balances/<?= htmlspecialchars($docs['fee_balance'] )?>" target="_blank">View Fee Balance</a></p>

<h3>STATUS</h3>
<p>Current Status: <strong><?= $app['status'] ?></strong></p>

<a href="status.php?id=<?= $id ?>&status=Approved">✅ Approve</a> |
<a href="status.php?id=<?= $id ?>&status=Rejected">❌ Reject</a>
</body>
</html>