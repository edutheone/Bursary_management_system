<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join Us - north mugirango</title>
  <link rel="stylesheet" href="join.css">
</head>

<body>

  <!-- Header -->
  <header class="site-header">
    <div class="container header-content">
      <h1 class="logo">NYAMIRA NORTH WE BELIEVE IN HARD WORK AND DEDICATION</h1>
</header>
      

  <!-- Main Section -->
  <main class="main-section">
    <section class="join-container">
      <h2>Join Our youth Community</h2>
      <p class="intro-text">Register to be one of members :::</p>

      <form id="joinForm" class="join-form" method="POST" action="register.php">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

        <label for="text">id_Number:</label>
        <input type="text" id="text" name="id_number" placeholder="Enter your id_number" required>

    
        <label for="phone">Phone Number :</label>
        <input type="tel" id="phone" name="phone"  placeholder="2547XXXXXXXX" required>
       

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Create a password" required>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>

        <label for="ward">choose your ward</label>
        <select id="ward" name="ward" required>
          <option value="">Select your ward</option>
          <option value="bokeira">Bokeira</option>
          <option value="bomwagamo">Bomwagamo</option>
          <option value="ekerenyo">Ekerenyo</option>
          <option value="itibo">Itibo</option>
          <option value="magwagwa">Magwagwa</option>
</form>
          
        </select>

        

        <button type="submit" class="submit-btn">Create Account</button>

        <p class="login-text">
          Already have an account?
          <a href="login.PHP">Login here</a>
        </p>
      </form>
    </section>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <p>&copy; 2025 NYAMIRA NORTH. All rights reserved.</p>
  </footer>

  <!-- Simple Password Validation -->
 
</body>

</html>
