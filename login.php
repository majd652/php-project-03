<?php
require "database/database.php";

$stmt = $conn->prepare("SELECT * FROM posts WHERE gebruikersnaam =:username");
$stmt->bindParam(":username", $_POST['gebruikersnaam']);
$stmt->execute();
$users = $stmt->fetch();
var_dump($users);
