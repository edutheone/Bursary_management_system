<?php
session_start();
include 'config.php';
// If user is not logged in, redirect if needed
// if (!isset($_SESSION['admission'])) { header("Location: login.php"); exit; }

$id_number = $_SESSION['id_number'] ?? null;

$app = null;

if ($id_number) {
    $stmt = $conn->prepare("SELECT * FROM applications WHERE id_number = ?");
    $stmt->bind_param("s", $id_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $app = $result->fetch_assoc();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="dashboard1.css">

  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

  <div class="header">User Dashboard</div>

  <div class="container">

    <div class="section-box">
      <h2>Welcome to Your Dashboard</h2>
      <h3>Access services below</h3>
    </div>
    <div class="section-box">
  <h3>🎓 Bursary Status</h3>

  <?php if ($app): ?>

      <p><strong>Ward:</strong> <?= $app['ward'] ?></p>

      <p><strong>Status:</strong>
      <?php
        if ($app['status'] == 'Pending') {
            echo "<span style='color:orange;'>⏳ Pending</span>";
        } elseif ($app['status'] == 'Approved') {
            echo "<span style='color:green;'>✅ Approved</span>";
        } elseif ($app['status'] == 'Rejected') {
            echo "<span style='color:red;'>❌ Rejected</span>";
        }
      ?>
      </p>

  <?php else: ?>
      <p style="color:red;">❌ You have not applied for bursary yet.</p>
  <?php endif; ?>

</div>
-
    <!-- ICON BUTTON MENU -->
    <div class="icon-menu">

      <a href="https://wa.me/254711297314?text=Hello%20Admin" class="menu-item">
        <i class="fa-solid faphone"></i>
        <span>Contact Admin</span>
      </a>

      <a href="https://smart-tech.page.gd/" class="menu-item">
        <i class="fa-solid fa-laptop-code"></i>
        <span>Improve Computer Skills(optional)</span>
      </a>

      <a href="https://accounts.ecitizen.go.ke" class="menu-item">
        <i class="fa-solid fa-landmark"></i>
        <span> Access Government Services</span>
      </a>

       <a href="bursaries/bursary.php" class="menu-item">
       <i class="fa-solid fa-graduation-cap"></i>
         <span>Bursaries updates</span>
           </a>

      <a href="#" onclick="alert('Development section coming soon'); return false;" class="menu-item">
        <i class="fa-solid fa-building"></i>
        <span>Development updates</span>
      </a>

      <a href="logout.php" class="menu-item logout">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Logout</span>
      </a>

    </div>

  </div>

 <!-- END ICON MENU -->

<div class="container">

  <h2>WELCOME TO OUR UPDATES:</h2>

  <!-- Updates Section -->
  <div class="section-box">
    <h3>Updates</h3>

    <?php
    $class_query = $conn->query("SELECT * FROM classes ORDER BY date ASC");

    if ($class_query->num_rows > 0) {
        while ($row = $class_query->fetch_assoc()) {
            echo "
            <p>
              <strong>{$row['class_name']}</strong><br>
              Date: {$row['date']}<br>
              Time: {$row['time']}<br>
              {$row['description']}
            </p>
            <hr>";
        }
    } else {
        echo "<p>No update yet.</p>";
    }
    ?>
  </div>

  <!-- Videos Section -->
  <div class="section-box">
    <h3>Watch Videos 🎦</h3>

    <?php
    $video = $conn->query("SELECT * FROM resources WHERE type='video' ORDER BY uploaded_at DESC");

    if ($video->num_rows > 0) {
        while ($v = $video->fetch_assoc()) {
            echo "
            <p>
              <strong>{$v['title']}</strong><br>
              <video width='100%' controls>
                <source src='admin2/uploads/{$v['filename']}' type='video/mp4'>
              </video>
            </p>
            <hr>";
        }
    } else {
        echo "<p>No video available.</p>";
    }
    ?>

</div>
<?php
include 'contact1.php';
?>
</body>
</html>
