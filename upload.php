<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "database/database.php";


ini_set('upload_max_filesize', '5M');
ini_set('post_max_size', '8M');
ini_set('max_execution_time', '300');
ini_set('memory_limit', '128M');


if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])) {
    
    var_dump($_FILES["fileToUpload"]);
    
    $target_dir = __DIR__ . "/uploads/";
    
    
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    
    $file = $_FILES["fileToUpload"];
    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];
    
    
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    $allowed = array("jpg", "jpeg", "png", "gif");

    if($fileError === 0) {
        if($fileSize > 5000000) { 
            die("Your file is too large!");
        } else if(!in_array($fileExt, $allowed)) {
            die("You cannot upload files of this type!");
        } else {
            
            $fileNameNew = uniqid('', true) . "." . $fileExt;
            $fileDestination = $target_dir . $fileNameNew;

            
            echo "Uploading file to: " . $fileDestination . "<br>";
            echo "Temporary file location: " . $fileTmpName . "<br>";

          
            if (!is_writable($target_dir)) {
                die("Upload directory is not writable!");
            }

            
            if(move_uploaded_file($fileTmpName, $fileDestination)) {
                
                try {
                    $sql = "INSERT INTO images (file_name, file_path, upload_date) VALUES (?, ?, NOW())";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$fileNameNew, $fileDestination]);
                    
                    header("Location: profile.php?upload=success");
                    exit();
                } catch(PDOException $e) {
                    die("Database Error: " . $e->getMessage());
                }
            } else {
                die("Upload failed. Error: " . error_get_last()['message']);
            }
        }
    } else {
        die("File upload error code: " . $fileError);
    }
} else {
    die("No file uploaded or form not submitted correctly");
}
?>

