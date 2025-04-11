<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    
</body>
</html>
<div class="loginBody">
    <div class="container">
        <div class="loginBox">
            <h2>login to Upost</h2>
            <form action="login-check.php" method="POST" class="loginForm">
                <input class="userLog" type="text" name="username" id="username" 
                    placeholder="Phone, email, or username" required>
                <input class="passLog" type="password" name="wachtwoord" id="password" 
                    placeholder="Password" required>
                <input class="loginBtn" type="submit" value="Log in">
            </form>
            <a href="#" class="forgot-password">Forgot password?</a>
            <a href="register-form.php" class="logToSign">Sign up here</a>
        </div>
    </div>
</div>

