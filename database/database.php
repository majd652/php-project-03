<?php
$username = "root";
$password= "";

try {
    $conn = new PDO ("mysql:host=localhost;dbname=upost", $username, $password);
}
catch (PDOException $e){
    echo $e->getMessage();
}
