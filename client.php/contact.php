
<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $phone = $_POST['phone'];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

   if( $stmt->execute()){
    echo "<script>alert('message sent successfully wait for responce.'); window.history.back();</script>";
   }
   else{
    echo "<p>Error:".$stmt->error.'</p>';
   }

    $stmt->close();
    exit;
}


header("Location: dashboard1.php");
exit;
?>