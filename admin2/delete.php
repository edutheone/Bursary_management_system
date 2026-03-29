<?php
session_start();
include '../config.php';

if (isset($_POST['application_id'])) {

    $application_id = (int) $_POST['application_id'];

    //  Get document file names
    $stmt = $conn->prepare("SELECT * FROM documents WHERE application_id = ?");
    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $result = $stmt->get_result();

    //  Delete files from folders
    while ($row = $result->fetch_assoc()) {

        $paths = [
            "../bursaries/uploads/fee_structures/" . $row['fee_structure'],
            "../bursaries/uploads/fee_balances/" . $row['fee_balance'],
            "../bursaries/uploads/id_copies/" . $row['parent_id_copy'],
            "../bursaries/uploads/admission_letters/" . $row['admission_letter']
        ];

        foreach ($paths as $file) {
            if (!empty($file) && file_exists($file)) {
                unlink($file); // delete file
            }
        }
    }

    //delete from applications
    $stmt2 = $conn->prepare("DELETE FROM documents WHERE application_id = ?");
    $stmt2->bind_param("i", $application_id);
    $stmt2->execute();

    
    $stmt3 = $conn->prepare("DELETE FROM applications WHERE application_id = ?");
    $stmt3->bind_param("i", $application_id);

    if ($stmt3->execute()) {
        echo "<script>alert('✅ Application and all documents deleted successfully'); window.history.back();</script>";
    } else {
        echo "Error: " . $stmt3->error;
    }

} else {
    echo "Invalid request";
}
?>