<?php
session_start();
require "database/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"]) || empty($_POST["wachtwoord"])) {
        die("Error: Missing required fields.");
    }

    $username = $_POST["username"];
    $password = $_POST["wachtwoord"];

    try {
        $stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["wachtwoord"])) {
            $_SESSION["user"] = $user["username"];
            header("Location: Upost.php");
            exit();
        } else {
            die("Error: Invalid username or password.");
        }
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
?>