<?php
session_start();
include 'database.php'; // Include your database connection file

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $password = $_POST['password']; // Use plain text password
        $email = $_POST['email'];

        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM admins WHERE username = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = "Username already exists.";
        } else {
            // Insert new user into the database with plain text password
            $stmt = $conn->prepare("INSERT INTO admins (username, password, email) VALUES (?, ?, ?)");
            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("sss", $username, $password, $email);
            if ($stmt->execute()) {
                $success_message = "Account created successfully.";
                header('Location: admin_login.php'); // Redirect to login page
                exit();
            } else {
                die("Execute failed: " . $stmt->error);
            }
        }
    } else {
        $error_message = "All fields are required.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="log.css">
  <link rel="stylesheet" href="log.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    .error-container {
      color: red;
      font-weight: bold;
      position: relative;
     
    }
    
   
      
    .inputBox2 input{
      padding: 10px;
      width: 60%;
      text-align: center;
      border-radius: 20px;
      
    }
    .inputBox2 {
      text-align: center;
      border-radius: 20px;
      margin-top: -10px;
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
  </style>
</head>
<body>
  <section>
    <div class="signin">
      <div class="content">
        <h2>Sign Up</h2>
        <?php if (!empty($error_message)): ?>
          <div class="error-container"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form class="form" action="signup_admin.php" method="POST">
          <div class="inputBox">
            <input type="text" name="username" required>
            <label>Username</label>
          </div>

          <div class="inputBox">
            <input type="password" id="password" name="password" required>
            <label for="password">Password</label>
            <i class="fa fa-eye eye-icon" id="togglePassword" onclick="togglePassword()"></i>
          </div>

          <div class="inputBox">
            <input type="email" name="email" required>
            <label>Email</label>
          </div>
          <div class="inputBox2">
            <input type="submit" value="Sign Up">
          </div>
        </form>
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