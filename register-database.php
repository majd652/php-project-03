<?php
session_start();
require "database/database.php";


if (!isset($_POST["username"]) || !isset($_POST["password"])) {
    die("Error: Missing required fields.");
}

try {
    $check_user = $conn->prepare("SELECT username FROM account WHERE username = ?");
    $check_user->execute([$_POST['username']]);
    
    if ($check_user->rowCount() > 0) {
        die("Error: Username already exists.");
    }

    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $insert_user = $conn->prepare("INSERT INTO account (username, wachtwoord) VALUES (:username, :wachtwoord)");
    $insert_user->bindParam(":username", $_POST['username']);
    $insert_user->bindParam(":wachtwoord", $hash);
    $insert_user->execute();

    
    header("Location: login-form.php");
    exit();
    
} catch(PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>


