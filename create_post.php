<?php
session_start();
require_once "database/database.php";


if (!isset($_SESSION['user_id'])) {
    die("Not logged in");
}


if (!isset($_SESSION['user_id'])) {
    try {
        $stmt = $conn->prepare("SELECT id FROM account WHERE username = ?");
        $stmt->execute([$_SESSION['user']]);
        $user = $stmt->fetch();
        
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
        } else {
            header("Location: login-form.php");
            exit();
        }
    } catch(PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
    try {
        $stmt = $conn->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");
        $result = $stmt->execute([$_SESSION['user_id'], $_POST['content']]);
        
        if (!$result) {
            error_log("Failed to insert post: " . print_r($stmt->errorInfo(), true));
            die("Failed to create post");
        }
        
        header("Location: homepage.php");
        exit();
    } catch (PDOException $e) {
        die("Error creating post: " . $e->getMessage());
    }
}
?>