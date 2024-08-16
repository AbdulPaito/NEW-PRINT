<?php
require_once('database.php'); // Ensure this includes your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete user from database
    $query = "DELETE FROM admins WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            $message = "User deleted successfully.";
        } else {
            $message = "Error deleting user: " . mysqli_error($conn);
        }
    } else {
        $message = "Prepare statement failed: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: dashboard.php?page=admin");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background-color: #fff;
            border: 2px solid #007BFF;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .message {
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons a, .buttons form {
            display: inline-block;
            margin: 5px;
        }
        .buttons a, .buttons input {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .buttons a:hover, .buttons input:hover {
            background-color: #0056b3;
        }
        .cancel {
            background-color: #6c757d;
        }
        .cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($message)) { ?>
            <div class="message"><?php echo $message; ?></div>
            <a href="dashboard.php?page=admin">Go back to Dashboard</a>
        <?php } else { ?>
            <div class="message">Are you sure you want to delete this user?</div>
            <div class="buttons">
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <input type="submit" value="Delete">
                </form>
                <a href="dashboard.php?page=admin" class="cancel">Cancel</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
