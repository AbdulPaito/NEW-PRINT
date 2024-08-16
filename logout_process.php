<?php
// Start or resume session
session_start();

// Perform logout actions
// Example: unset session variables, destroy session, redirect to login page
session_unset();
session_destroy();

// Redirect to login page or any other page after logout
header("Location: admin_login.php");
exit();
?>
