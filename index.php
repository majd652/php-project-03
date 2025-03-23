<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Document</title>
        <link rel="stylesheet" href="css\main.css">
    </head>
    <body>
        <div id="logo" class="logo">
<!--            <img src="images/Screenshot 2025-02-27 161647.png" alt="Logo" width="70px">-->
        </div>
        <div class="container">
            <div class="login-box">
                <h2>Sign in to Upost</h2>
               
                <form  action="register-database.php" method="post"  id="login-form" class="login-form">
                    <input id="username" type="text" placeholder="Phone, email, or username" required>
                    <input id="wachtwoord" type="password" placeholder="Password" required>
                    <button type="submit">Sign in</button>
                </form>
                <a href="#" class="forgot-password">Forgot password?</a>
                <a href="signup.php" class="signup-link">Sign up for Upost</a>
            </div>
        </div>
    </body>
</html>
