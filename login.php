<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Upost</title>
    <link rel="stylesheet" href="css\main.css">
</head>
<body>
    <div id="logo" class="logo">
        <!--<img src="images/Screenshot 2025-02-27 161647.png" alt="Logo" width="70px">-->
    </div>
    <div class="container">
        <div class="login-box">
            <h2>Sign in to Upost</h2>
            <form action="login-check.php" method="POST" class="login-form">
                <input type="text" name="username" id="username" placeholder="Phone, email, or username" required>
                <input type="password" name="wachtwoord" id="wachtwoord" placeholder="Password" required>
                <button type="submit">Sign in</button>
            </form>
            <a href="#" class="forgot-password">Forgot password?</a>
            <a href="signup.php" class="signup-link">Sign up for Upost</a>
        </div>
    </div>
</body>
</html>
