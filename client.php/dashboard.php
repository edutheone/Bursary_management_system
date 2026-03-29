<?php
session_start();
include 'config.php';


// Protect page if not logged in
if (!isset($_SESSION['id_number'])) {
    header("Location: login.php");
    exit;
}

// Fetch user data using id_number
$id_number = $_SESSION['id_number'];
$query = "SELECT * FROM users WHERE id_number = '$id_number'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<header class="header">
    <h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?> 👋</h1>
    <nav>
        <a href="logout.php" class="btn logout">Logout</a>
    </nav>
</header>

<main class="dashboard-container">
    <section class="user-info">
        <h2>Confirm your details</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
        <p><strong>ID Number:</strong> <?php echo htmlspecialchars($user['id_number']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
        <p><strong>Ward:</strong> <?php echo htmlspecialchars($user['ward'] ?? 'Not set'); ?></p>

        <a href="dashboard1.php" class="btn"><button>View Updates</button></a>
    </section>
</main>

<footer class="footer">
    <p>&copy; 2025 Nyamira North Comrade Association. All Rights Reserved.</p>
</footer>
</body>
</html>