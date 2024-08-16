<?php

$host = 'localhost';  // Replace with your host
$user = ' ';   // Replace with your database username
$password = ' '; // Replace with your database password
$database = 'tesda'; // Replace with your database name

// Establish database connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate ID
if ($id <= 0) {
    die("Invalid ID");
}

// Check if the delete request is confirmed
if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    // Prepare and execute the delete query
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to profile page after successful deletion
        header("Location: dashboard.php?page=profile");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    exit();
}

mysqli_close($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Deletion</title>
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
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h2 {
            margin-top: 0;
        }
        .buttons {
            margin-top: 20px;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .cancel {
            background-color: #6c757d;
        }
        .cancel:hover {
            background-color: #5a6268;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Delete Confirmation</h2>
    <p>Are you sure you want to delete this information?</p>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="confirm" value="yes">
        <div class="buttons">
            <button type="submit">Delete</button>
            <button type="button" class="cancel" onclick="window.location.href='dashboard.php?page=profile'">Cancel</button>
        </div>
    </form>
</div>

</body>
</html>
