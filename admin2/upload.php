<?php
include "../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $type = $_POST['type'];
    $uploaded_by = "Admin";

    $file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];

    $folder = "uploads/" . basename($file);

    if (move_uploaded_file($temp, $folder)) {

        $conn->query("INSERT INTO resources (title, filename, type, uploaded_by)
                      VALUES ('$title', '$file', '$type', '$uploaded_by')");

        echo "<script> alert('added succefully');window.location.href='admin.php'</script>";
    } else {
        echo "Upload failed!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="upload.css">
</head>
<body>
    
</body>
</html>
<h3>Upload Video / Note</h3>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Resource Title" required><br><br>

    <select name="type" required>
        <option value="">Select Type</option>
        <option value="video">Video</option>
        <option value="pdf">PDF Notes</option>
        <option value="image">Image</option>
        <option value="document">Document</option>
    </select><br><br>

    <input type="file" name="file" required><br><br>

    <button type="submit">Upload</button>
</form>

</body>
</html>
