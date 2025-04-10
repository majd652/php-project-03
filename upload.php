<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "database/database.php";

if(isset($_POST["submit"])) {
    if(!isset($_FILES["fileToUpload"]) || $_FILES["fileToUpload"]["error"] !== UPLOAD_ERR_OK) {
        die("No file uploaded or upload error occurred");
    }

    $file = $_FILES["fileToUpload"];
    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    
   
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = array("jpg", "jpeg", "png", "gif");

    if($fileSize > 5000000) { 
        die("Your file is too large!");
    } else if(!in_array($fileExt, $allowed)) {
        die("You cannot upload files of this type!");
    }

    
    $fileNameNew = uniqid('', true) . "." . $fileExt;
    $fileDestination = $target_dir . $fileNameNew;

    if(move_uploaded_file($fileTmpName, $fileDestination)) {
        try {
           
            $sql = "INSERT INTO images (file_name, upload_date) VALUES (?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fileNameNew]);
            
            exit();
        } catch(PDOException $e) {
            header("Location: profile.php");
            die("Database Error: " . $e->getMessage());
        }
    } else {
        die("Upload failed. Error: " . error_get_last()['message']);
    }
} else {
    die("No file uploaded or form not submitted correctly");
}
?>

