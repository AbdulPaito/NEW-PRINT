<?php
session_start();
include 'database.php'; // Include your database connection file

$error_message = '';
$success_message = '';

// Check if the session variable `reset_token` is set
if (!isset($_SESSION['reset_token'])) {
    die("Reset token is not set. Please request a new password reset.");
}

// Check if the token in the URL matches the session token
if (!isset($_GET['token']) || $_GET['token'] !== $_SESSION['reset_token']) {
    die("Invalid or expired token.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            $error_message = "New password and confirm password do not match.";
        } else {
            $username = $_SESSION['reset_username'];

            // Fetch user details
            $query = "SELECT password FROM admins WHERE username = ?";
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                die("Database prepare error: " . $conn->error);
            }
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verify current password
                if ($current_password === $user['password']) {
                    // Update the password
                    $update_query = "UPDATE admins SET password = ? WHERE username = ?";
                    $update_stmt = $conn->prepare($update_query);
                    if ($update_stmt === false) {
                        die("Database prepare error: " . $conn->error);
                    }
                    $update_stmt->bind_param("ss", $new_password, $username);
                    if ($update_stmt->execute()) {
                        $success_message = "Password updated successfully.";
                        header('Location: admin_login.php'); // Redirect to page1.php after successful registration

                        unset($_SESSION['reset_token']);
                        unset($_SESSION['reset_username']);
                    } else {
                        $error_message = "Failed to update password.";
                    }
                } else {
                    $error_message = "Current password is incorrect.";
                }
            } else {
                $error_message = "User not found.";
            }
        }
    } else {
        $error_message = "All fields are required.";
    }
}

// Prepare the token for use in the URL
$token = isset($_SESSION['reset_token']) ? htmlspecialchars(urlencode($_SESSION['reset_token'])) : '';
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="log.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
   .error-message {
      color: red;
      font-weight: bold;
    }
    .success-message {
      color: green;
      font-weight: bold;
    }
    .inputBox {
      text-align: center;
      border-radius: 20px;
      margin-top: -10px;
    }
    .inputBox input {
      padding: 10px;
      width: 60%;
      border-radius: 20px;
    }


    .inputBox1 input{
      padding: 10px;
      width: 60%;
      text-align: center;
      border-radius: 20px;
      
    }
    .inputBox1 {
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
        <h2>Change Password</h2>
        <?php if (!empty($error_message)): ?>
          <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
          <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        <form class="form" action="changepass_admin.php<?php echo !empty($token) ? '?token=' . $token : ''; ?>" method="POST">
        <div class="inputBox">
            <input type="password" id="current_password" name="current_password" required>
            <label for="current_password">Current Password</label>
            <i class="fa fa-eye eye-icon" id="toggleCurrentPassword" onclick="togglePassword('current_password', 'toggleCurrentPassword')"></i>
          </div>

          <div class="inputBox">
            <input type="password" id="new_password" name="new_password" required>
            <label for="new_password">New Password</label>
            <i class="fa fa-eye eye-icon" id="toggleNewPassword" onclick="togglePassword('new_password', 'toggleNewPassword')"></i>
          </div>

          <div class="inputBox">
            <input type="password" id="confirm_password" name="confirm_password" required>
            <label for="confirm_password">Confirm Password</label>
            <i class="fa fa-eye eye-icon" id="toggleConfirmPassword" onclick="togglePassword('confirm_password', 'toggleConfirmPassword')"></i>
          </div>

          <div class="inputBox1">
            <input type="submit" value="Update Password">
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
    function togglePassword(fieldId, iconId) {
      var passwordField = document.getElementById(fieldId);
      var eyeIcon = document.getElementById(iconId);
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
