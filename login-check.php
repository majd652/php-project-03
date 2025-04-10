<?php
global $conn;
session_start();
require "database/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        die("Error: Missing required fields.");
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $stmt = $conn->prepare("SELECT * FROM account WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["username"];
            header("Location: upload.php");
            exit();
        } else {
            die("Error: Invalid username or password.");
        }
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
?>