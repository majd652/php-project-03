<?php
<<<<<<< HEAD

require "database/database.php";

$hash = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);


$insert_user = $conn->prepare("INSERT INTO posts (gebruikersnaam,wachtwoord) VALUES (:gebruikersnaam, :wachtwoord)");
$insert_user->bindParam(":gebruikersnaam", $_POST['gebruikersnaam']);
=======
require "database/database.php";

if (!isset($_POST["username"]) || !isset($_POST["wachtwoord"])) {
    die("Error: Missing required fields.");
}

$hash = password_hash($_POST["wachtwoord"], PASSWORD_DEFAULT);

$insert_user = $conn->prepare("INSERT INTO account (username, wachtwoord) VALUES (:username, :wachtwoord)");
$insert_user->bindParam(":username", $_POST['username']);
>>>>>>> origin/main
$insert_user->bindParam(":wachtwoord", $hash);
$insert_user->execute();

header("location: index.php");
<<<<<<< HEAD
=======


>>>>>>> origin/main
