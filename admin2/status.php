<?php
include '../config.php';

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    die("Invalid request");
}

$id = $_GET['id'];
$status = $_GET['status'];

$allowed = ['Pending', 'Approved', 'Rejected'];

if (!in_array($status, $allowed)) {
    die("Invalid status");
}

$stmt = $conn->prepare("UPDATE applications SET status = ? WHERE application_id = ?");
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    header("Location: view_applications.php");
} else {
    echo "Error updating status";
}
?>