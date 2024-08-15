<?php
session_start();
include 'database.php'; // Include your database connection file

$error_message = ''; // Initialize the error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if username and password fields are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password']; // Use plain text password for comparison

        // Check if it's the default admin login
        if ($username === 'admin' && $password === 'adminpass') {
            $_SESSION['username'] = 'admin';
            $_SESSION['role'] = 'admin'; // Optional: Store role if needed
            header("Location: dashboard.php"); // Redirect to admin dashboard
            exit();
        }

        // Check user credentials in the users table
        $stmt = $conn->prepare("SELECT id, password, registration_complete FROM users WHERE username = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error); // Output detailed error message
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Direct comparison for plain text password
            if ($password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username; // Set session username correctly

                // Check if the user has completed their registration
                if ($user['registration_complete']) {
                    // User has completed registration; redirect to edit_info.php
                    header("Location: info_edit.php");
                } else {
                    // User has not completed registration; redirect to registration form
                    header("Location: page1.php");
                }
                exit();
            } else {
                $error_message = "Invalid password."; // Set error message
            }
        } else {
            $error_message = "No user found with that username."; // Set error message
        }
    } else {
        $error_message = "Username and password required."; // Set error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="log.css">
  <style>
    .error-message {
      color: red;
      font-weight: bold;
    }

    .inputBox1 input{
      padding: 10px;
      width: 60%;
      text-align: center;
      position: relative;
      border-radius: 20px;
      
    }
    .inputBox1 {
      text-align: center;
      border-radius: 20px;
      margin-top: -10px;
    }

  </style>
</head>
<body>
  <section>
    <div class="signin">
      <div class="content">
        <h2>Login Trainee</h2>
        <?php if (!empty($error_message)): ?>
          <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form class="form" action="login.php" method="POST">
          <div class="inputBox">
            <input type="text" name="username" required>
            <label>Username</label>
          </div>
          <div class="inputBox">
            <input type="password" name="password" required>
            <label>Password</label>
          </div>
          <div class="inputBox1">
            <input type="submit" value="Login">
          </div>
        </form>
        <div class="signup">
          <p>Don't have an account? <a href="signup.php" class="sign-up-link" onclick="openSignUpModal()">Sign up</a></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Sign Up Modal -->
  <div id="signupModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeSignUpModal()">&times;</span>
      <h2>Sign Up</h2>
      <form class="form" action="signup.php" method="POST">
        <div class="inputBox">
          <input type="text" name="username" required>
          <label>Username</label>
        </div>
        <div class="inputBox">
          <input type="password" name="password" required>
          <label>Password</label>
        </div>
        <div class="inputBox">
          <input type="email" name="email" required>
          <label>Email</label>
        </div>
        <div class="inputBox">
          <input type="submit" value="Sign Up">
        </div>
      </form>
    </div>
  </div>

  <script>
    function openSignUpModal() {
      document.getElementById('signupModal').style.display = 'block';
    }

    function closeSignUpModal() {
      document.getElementById('signupModal').style.display = 'none';
    }
  </script>
</body>
</html>
