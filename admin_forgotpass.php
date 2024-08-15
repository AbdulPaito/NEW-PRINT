<?php
session_start();
include 'database.php'; // Include your database connection file

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];

        // Prepared SQL query to prevent SQL injection
        $query = "SELECT id FROM admins WHERE username = ? AND email = ?";
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, generate a token and redirect to password reset form
            $token = bin2hex(random_bytes(32));
            $_SESSION['reset_token'] = $token;
            $_SESSION['reset_username'] = $username;

            // Store token in database or send to user via email
            // ...

            header("Location: changepass_admin.php?token=" . urlencode($token));
            exit();
        } else {
            $error_message = "No user found with that username and email.";
        }
    } else {
        $error_message = "Username and email are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="log.css">
  <style>
    .error-message {
      color: red;
      font-weight: bold;
    }
    .inputBox input {
      padding: 10px;
      width: 60%;
      position: relative;
      border-radius: 20px;
    }
    .inputBox {
     
      border-radius: 20px;
      margin-top: 15px;
    }
    .inputBox1 {
      text-align: center;
      border-radius: 20px;
      margin-top: 20px;
    }
   
    .inputBox {
      
      border-radius: 20px;
      margin-top: 10px;
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


  </style>
</head>
<body>
  <section>
    <div class="signin">
      <div class="content">
        <h2>Forgot Password</h2>
        <?php if (!empty($error_message)): ?>
          <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form class="form" action="admin_forgotpass.php" method="POST">
          <div class="inputBox">
            <input type="text" name="username" required>
            <label>Username</label>
          </div>

          <div class="inputBox">
            <input type="email" name="email" required>
            <label>Email</label>
          </div>

          <div class="inputBox1">
            <input type="submit" value="Request Password Reset">
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
