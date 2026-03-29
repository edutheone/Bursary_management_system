<?php
// Include the database connection
include 'config.php';

// Start session
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data safely
    $id_number = trim($_POST['id_number']);
    $password = trim($_POST['password']);

    // Validate empty fields
    if (empty($id_number) || empty($password)) {
        echo "<script>
                alert('Please fill in all fields.');
                window.history.back();
              </script>";
        exit;
    }

    // Prepare SQL query to prevent SQL injection
    if ($stmt = $conn->prepare("SELECT * FROM users WHERE id_number = ?")) {

        $stmt->bind_param("s", $id_number);
        $stmt->execute();

        // Get results
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();

            // Verify hashed password
            if (password_verify($password, $user['password'])) {

                // Store data in session
                $_SESSION['fullname']  = $user['fullname'];
                $_SESSION['id_number'] = $user['id_number'];
                $_SESSION['ward']      = $user['ward'];

                echo "<script>
                        alert('Login successful! Welcome, {$user['fullname']}');
                        window.location.href = 'dashboard.php';
                      </script>";
                exit;

            } else {
                echo "<script>
                        alert('Invalid password. Please try again.');
                        window.history.back();
                      </script>";
                exit;
            }

        } else {
            echo "<script>
                    alert('No account found with that ID number.');
                    window.history.back();
                  </script>";
            exit;
        }

        $stmt->close();
    }

    $conn->close();
}
?>
