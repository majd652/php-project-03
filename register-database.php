<?php
require "database/database.php";


$hash = password_hash($_POST["wachtwoord"], PASSWORD_DEFAULT);


$insert_user = $conn->prepare("INSERT INTO account (username,wachtwoord) VALUES (:username, :wachtwoord)");
$insert_user->bindParam(":username", $_POST['username']);
$insert_user->bindParam(":wachtwoord", $hash);
$insert_user->execute();



