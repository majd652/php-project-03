<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

<header>
    <div class="logo" id="logo">

    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="post.php">Posts</a></li>
            <?php if(isset($_SESSION['user'])):?>
            <?php else :?>
                <li><a href="login.php">login</a></li>
                <li><a href="signup.php">Sign-up</a></li>
            <?php endif;?>

        </ul>
    </nav>



    <footer>
        <script src="main.js"></script>
    </footer>
</body>
</html>
