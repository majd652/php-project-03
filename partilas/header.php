<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upost</title>
    <link rel="stylesheet" href="css/main2.css">
</head>
<body>
<?php
require_once "check_admin.php";
$isAdmin = isset($_SESSION['user_id']) ? isAdmin($conn, $_SESSION['user_id']) : false;
?>
    <nav class="navlink">
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <?php if ($isAdmin): ?>
                <li><a href="admin.php" class="admin-link">Admin Panel</a></li>
            <?php endif; ?>
            <li><a href="register-form.php">Register</a></li>
            <li><a href="login-form.php">Login</a></li>
        </ul>
    </nav>
    <main>