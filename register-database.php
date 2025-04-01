<?php


require "database/database.php";

$hash = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);


$insert_user = $conn->prepare("INSERT INTO posts (gebruikersnaam,wachtwoord) VALUES (:gebruikersnaam, :wachtwoord)");
$insert_user->bindParam(":gebruikersnaam", $_POST['gebruikersnaam']);

if (!isset($_POST["gebruikersnaam"]) || !isset($_POST["wachtwoord"])) {
    die("Error: Missing required fields.");
}

