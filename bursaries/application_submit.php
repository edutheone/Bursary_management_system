<?php
session_start();
include '../config.php';

// Show errors (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. GET FORM DATA
    $full_name = trim($_POST['full_name']);
    $id_number = trim($_POST['id_number']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $date_of_birth = $_POST['date'];
    $ward = $_POST['ward'];
    $disability = $_POST['disability'];
    $orphan_status = $_POST['ophan'];

    $school = $_POST['school'];
    $course = $_POST['course'];
    $admission_number = $_POST['admission'];
    $admission_date = $_POST['ad_date'];

    $parent_name = $_POST['parent'];
    $parent_phone = $_POST['p_phone'];
    $occupation = $_POST['occupation'];
    $income = $_POST['income'];

    // 2. CHECK DUPLICATE
    $check = $conn->prepare("SELECT application_id FROM applications WHERE id_number = ?");
    $check->bind_param("s", $id_number);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>alert('You have already submitted an application
        check on your portal regularly for updates'); window.history.back();</script>";
        exit;
    }

    // 3. INSERT APPLICATION
    $stmt = $conn->prepare("
        INSERT INTO applications (
            full_name, id_number, phone, email, date_of_birth,
            ward, disability, orphan_status,
            school, course, admission_number, admission_date,
            parent_name, parent_phone, occupation, income
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssssssssssssssd",
        $full_name, $id_number, $phone, $email, $date_of_birth,
        $ward, $disability, $orphan_status,
        $school, $course, $admission_number, $admission_date,
        $parent_name, $parent_phone, $occupation, $income
    );

    if ($stmt->execute()) {

        $application_id = $stmt->insert_id;

        // 4. FILE UPLOAD FUNCTION (FIXED)
        function uploadFile($file, $folder) {

            if ($file['error'] !== 0) {
                return null;
            }

            $allowed_types = ['pdf', 'jpg', 'jpeg', 'png'];
            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($file_ext, $allowed_types)) {
                die("❌ Invalid file type: " . $file['name']);
            }

            // ✅ Generate unique filename ONLY
            $new_name = uniqid() . "_" . time() . "." . $file_ext;

            // ✅ Correct folder path (relative to this file)
            $upload_path = "uploads/$folder/";

            // Create folder if it doesn't exist
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $target = $upload_path . $new_name;

            if (move_uploaded_file($file['tmp_name'], $target)) {
                return $new_name; // ✅ ONLY return filename
            } else {
                die("❌ Error uploading file: " . $file['name']);
            }
        }

        // 5. UPLOAD FILES
        $admission_letter = uploadFile($_FILES['admission_letter'], "admission_letters");
        $fee_structure = uploadFile($_FILES['fee_structure'], "fee_structures");
        $id_copy = uploadFile($_FILES['id_copy'], "id_copies");
        $fee_balance = uploadFile($_FILES['fee_balance'], "fee_balances");

        // 6. INSERT DOCUMENTS
        $stmt2 = $conn->prepare("
            INSERT INTO documents (
                application_id,
                admission_letter,
                fee_structure,
                parent_id_copy,
                fee_balance
            )
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt2->bind_param(
            "issss",
            $application_id,
            $admission_letter,
            $fee_structure,
            $id_copy,
            $fee_balance
        );

        if ($stmt2->execute()) {
            echo "<script>
                alert('✅ Application submitted successfully. check your portal regularly for status change');
                window.location.href = '../dashboard1.php';
            </script>";
        } else {
            echo "❌ Error saving documents: " . $conn->error;
        }

        $stmt2->close();

    } else {
        echo "❌ Error saving application: " . $conn->error;
    }

    $stmt->close();
}
?>