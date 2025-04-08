<?php


require "database/database.php";

$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);


$insert_user = $conn->prepare("INSERT INTO account (username,wachtwoord) VALUES (:username, :wachtwoord)");
$insert_user->bindParam(":username", $_POST['username']);

if (!isset($_POST["username"]) || !isset($_POST["password"])) {
    die("Error: Missing required fields.");
}
if (password_verify($_POST['password'], $hash)) {
    header("location: login.php");
}
else {
    echo "no success"
}

