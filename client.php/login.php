<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h1>Welcome Back</h1>
        <p class="subtitle">NYAMIRA NORTH</p>

        <form id="loginForm" class="login-form" action="login1.php" method="POST">
    <div class="form-group">
        <label for="id_number">ID Number</label>
        <input type="text" id="id_number" name="id_number" placeholder="id_number" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
    </div>

    <button type="submit" class="btn-login">Login</button>

     <p class="signup-text">
                Don't have an account? <a href="join.php">register</a>
            </p>

            <p id="error-message"></p>
        </form>
    </div>


</body>
</html>
