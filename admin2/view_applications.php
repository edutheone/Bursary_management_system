<?php
include '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application page</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
   <?php 

// Get distinct wards dynamically
$ward_query = "SELECT DISTINCT ward FROM applications";
$ward_result = $conn->query($ward_query);

// 1. Check if ANY applications exist at all
if ($ward_result->num_rows > 0) {

    while ($ward_row = $ward_result->fetch_assoc()) {
        $ward = $ward_row['ward'];

        echo "<h2 class='ward-header' >$ward Ward Applications</h2>";

        $stmt = $conn->prepare("SELECT * FROM applications WHERE ward = ?");
        $stmt->bind_param("s", $ward);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<table border=1 width=100% cellpadding= 8 class='admin-table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>Phone</th>
                        <th>School</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = $result->fetch_assoc()) {
            // Determine status class for coloring
            $status_class = strtolower($row['status']);
            
            echo "<tr>
                    <td>" . htmlspecialchars($row['full_name']) . "</td>
                    <td>" . htmlspecialchars($row['id_number']) . "</td>
                    <td>" . htmlspecialchars($row['phone']) . "</td>
                    <td>" . htmlspecialchars($row['school']) . "</td>
                    <td><span class='badge $status_class'>{$row['status']}</span></td>
                    <td>
                        <a href='full_details.php?id={$row['application_id']}' class='btn-view'>View full info</a>
                        <form action='delete.php' method='post' style='display:inline;' 
                              onsubmit=\"return confirm('Are you sure, you want to delete the application?');\">
                            <input type='hidden' name='application_id' value='{$row['application_id']}'>
                            <button type='submit' class='btn-delete'>Clear</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</tbody></table><br>";
    }
} else {
    // 2. Fallback if the database table is empty
    echo "<div class='no-data-alert'>
            <h3>No applications made yet.</h3>
            <p>New applications will appear here once students submit their forms.</p>
          </div>";
}
?>

</body>
</html>