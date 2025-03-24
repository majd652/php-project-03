<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Upost</title>
    <link rel="stylesheet" href="css\main.css">
</head>
<body class="signupBody">
<div class="content">
    <div class="card">
        <h2>Create your account</h2>
        <form class="signupForm" id="signup-form" action="register-database.php" method="POST">
            <input class="inputName" type="text" name="username" placeholder="Name" required>
            <input class="inputMail" type="email" name="email" placeholder="Email" required>
            <input class="inputPass" type="password" name="wachtwoord" placeholder="Password" required>
            <button type="submit" class="signupButton">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Log in</a></p>
    </div>
</div>
</body>
</html>