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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
    </div>
    <ul class="sidebar-menu">
        <li><a href="dashboard.php?page=home"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="dashboard.php?page=profile"><i class="fas fa-user"></i> Profile</a></li>
        <li><a href="dashboard.php?page=reports"><i class="fas fa-chart-line"></i> Reports</a></li>
        <li><a href="dashboard.php?page=settings"><i class="fas fa-cog"></i> Settings</a></li>
        <li><a href="dashboard.php?page=registration"><i class="fas fa-clipboard-list"></i> Registration</a></li>
        <li><a href="dashboard.php?page=admin"><i class="fas fa-user-shield"></i> Admin</a></li>
        <li><a href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
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
