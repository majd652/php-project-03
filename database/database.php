<?php
<<<<<<< HEAD
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=localhost;dbname=upost", $username, $password);
=======

$username = "root";
$password= "";

try {
    $conn = new PDO ("mysql:host=localhost;dbname=upost", $username, $password);
>>>>>>> origin/main
}catch (PDOException $e){
    echo $e->getMessage();
}
