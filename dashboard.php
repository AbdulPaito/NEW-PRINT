<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to the login page if the session is not set
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dash.css">
    <script>
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = 'logout_process.php'; // Redirect to logout process
        }
    }
    </script>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Dashboard</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php?page=home">Home</a></li>
                <li><a href="dashboard.php?page=profile">Profile</a></li>
                <li><a href="dashboard.php?page=reports">Reports</a></li>
                <li><a href="dashboard.php?page=settings">Settings</a></li>
                <li><a href="dashboard.php?page=registration">Registration</a></li>
                <li><a href="dashboard.php?page=admin">Admin</a></li> 
                <li><a href="#" onclick="confirmLogout()">Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <?php
            // Include PHP code to handle page navigation
    
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                switch ($page) {
                    case 'home':
                        include 'home.php';
                        break;
                    case 'profile':
                        include 'profile.php';
                        break;
                    case 'reports':
                        include 'reports.php';
                        break;
                    case 'settings':
                        include 'settings.php';
                        break;
                    case 'registration':
                        include 'registration.php';
                        break;
                    case 'admin':
                        include 'admin.php'; // Include the admin page
                        break;
                    case 'logout':
                        header("Location: logout_process.php");
                        exit();
                        break;
                    default:
                        include 'home.php';
                        break;
                }
            } else {
                include 'home.php';
            }
            ?>
        </main>
    </div>
</body>
</html>
