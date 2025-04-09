<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upost</title>
    <link rel="stylesheet" href="css\main2.css">
</head>
<body>
    <div class="container">
        <div class="upload-pic-contanier">
            <label class="image-container" for="fileToUpload">
                <?php
                require_once "database/database.php";
                $stmt = $conn->query("SELECT file_name FROM images ORDER BY upload_date DESC LIMIT 1");
                $image = $stmt->fetch();
                if ($image && file_exists("uploads/" . $image['file_name'])) {
                    echo '<img src="uploads/' . htmlspecialchars($image['file_name']) . '" alt="Profile Picture" class="profile-image">';
                } else {
                    echo '<span class="upload-text">profile pic</span>';
                }
                ?>
            </label>   
            <form class="upload-button-container" action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
                <input type="submit" name="submit" value="Upload Image" class="upload-button">
            </form>
            </div>
        
        <div class="logout_container">
            <button class="logout_button">
                <a class="Log_out" href="index.php">Log Out</a>
            </button>
        </div>

    </div>
    </div>
     <div class="profile-container">
      <li><a href="#">change passowrd or username</a></li>
      <li><a href="#">help ? contact us</a></li>
      <li><a href="#">change email</a></li>
      <li><a href="privacy.php">our privacy policy</a></li>
      
</div>

<?php require 'partilas/footer.php'; ?>

    <script src="main.js"></script>
</body>
</html>