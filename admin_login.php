<?php
session_start();
include 'database.php'; // Include your database connection file

$error_message = ''; // Initialize the error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if username and password fields are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password']; // Use plain text password for comparison

        // Prepared SQL query to prevent SQL injection
        $query = "SELECT id, password FROM admins WHERE username = ?";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Directly compare plain text passwords
            if ($password === $user['password']) {
                // Set session variables and redirect to the admin dashboard
                $_SESSION['admin_id'] = $user['id']; // Set session variable for admin
                $_SESSION['username'] = $username; // Store username in session
                header("Location: dashboard.php"); // Redirect to the admin dashboard
                exit();
            } else {
                $error_message = "Invalid password."; // Set error message
            }
        } else {
            $error_message = "No user found with that username."; // Set error message
        }
    } else {
        $error_message = "Username and password are required."; // Set error message
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="log.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    .error-message {
      color: red;
      font-weight: bold;
    }
    .inputBox1 input {
      padding: 10px;
      width: 60%;
      text-align: center;
      position: relative;
      border-radius: 20px;
    }
    .inputBox1 {
      text-align: center;
      border-radius: 20px;
      margin-top: -15px;
    }
    .eye-icon {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #aaa; /* Icon color */
      font-size: 20px; /* Adjust size */
    }
    .eye-icon.active {
      color: #000; /* Icon color when active */
    }
    .forgot-password {
      margin-top: -10px;
      text-align: right;
      padding: auto;
    }
    .forgot-password p {
      margin: 0;
    }
    .forgot-password a {
      color: white;
      text-decoration: none;
    }
    .forgot-password a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <section>
    <div class="signin">
      <div class="content">
        <h2>Admin</h2>
        <?php if (!empty($error_message)): ?>
          <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form class="form" action="admin_login.php" method="POST">
          <div class="inputBox">
            <input type="text" name="username" required>
            <label>Username</label>
          </div>

          <div class="inputBox">
            <input type="password" id="password" name="password" required>
            <label for="password">Password</label>
            <i class="fa fa-eye eye-icon" id="togglePassword" onclick="togglePassword()"></i>
          </div>

          <div class="forgot-password">
            <p><a href="admin_forgotpass.php">Forgot Password?</a></p>
          </div>

          <div class="inputBox1">
            <input type="submit" value="Login">
          </div>
        </form>
        <div class="signup">
          <p>Don't have an account? <a href="signup_admin.php" class="sign-up-link">Sign up</a></p>
        </div>
      </div>
    </div>
  </section>

  

  <script>
    function togglePassword() {
      var passwordField = document.getElementById('password');
      var eyeIcon = document.getElementById('togglePassword');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.add('active');
      } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('active');
      }
    }
  </script>
</body>
</html>
