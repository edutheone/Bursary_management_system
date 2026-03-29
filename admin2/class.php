<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['class_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $desc = $_POST['description'];

    $conn->query("INSERT INTO classes(class_name,date,time,description) VALUES('$name','$date','$time','$desc')");
    echo "<script>alert('Class added successfully!');
          window.location.href='admin.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>assignments page</title></body>
    <link rel="stylesheet" href="class.css">
</head>
<body>

<form action="class.php" method="POST">
    <h3>Add Class</h3>
  <input type="text" name="class_name" placeholder="Class Name" required><br><br>
  <input type="date" name="date" required><br><br>
  <input type="time" name="time" required><br><br>
  <textarea name="description" placeholder="Description"></textarea><br><br>
  <button type="submit">Save</button>
</form>
</body>
</html>
