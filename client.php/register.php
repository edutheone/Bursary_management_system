<?php 
include 'config.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $fullname   = trim($_POST["fullname"]);
    $id_number  = trim($_POST["id_number"]);
    $phone      = trim($_POST["phone"]);
    $password   = trim($_POST["password"]);
    $confirm    = trim($_POST["confirm-password"]);
    $ward       = trim($_POST["ward"]);

    // validation
    if (empty($fullname) || empty($id_number) || empty($phone) || 
        empty($password) || empty($confirm) || empty($ward)) {

        echo "<script>alert('FILL ALL AREAS.'); window.history.back();</script>";
        exit;
    }

    // password match
    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    // hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // check if ID already exists
    $check_id = "SELECT * FROM users WHERE id_number = '$id_number'";
    $id_result = mysqli_query($conn, $check_id);

    if (mysqli_num_rows($id_result) > 0) {
        echo "<script>
              alert('ID Number already registered. Please login.');
              window.location.href='login.php';
              </script>";
        exit;
    }

    // check if phone exists
    $check_phone = "SELECT * FROM users WHERE phone = '$phone'";
    $phone_result = mysqli_query($conn, $check_phone);

    if (mysqli_num_rows($phone_result) > 0) {
        echo "<script>
              alert('Phone already registered. Please login.');
              window.location.href='login.php';
              </script>";
        exit;
    }

    // save user
    $sql = "INSERT INTO users(fullname, id_number, phone, password, ward)
            VALUES ('$fullname', '$id_number', '$phone', '$hashed_password', '$ward')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Account created successfully! Login now.'); 
              window.location.href='login.php';</script>";
    } else {
        error_log('DB Error: ' . mysqli_error($conn));
        echo "<script>alert('Error creating account. Try again later.'); 
              window.history.back();</script>";
    }
}
?>
