<?php
session_start();
require "database/database.php";

$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);


$insert_user = $conn->prepare("INSERT INTO account (username,password) VALUES (:username, :wachtwoord)");
$insert_user->bindParam(":username", $_POST['username']);
$insert_user->bindParam(":wachtwoord", $hash);
$insert_user-> execute();
header("Location: login.php");
if (!isset($_POST["username"]) || !isset($_POST["password"])) {
    die("Error: Missing required fields.");
}


