<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
<div class="signupBody">
    <div class="content">
        <div class="card">
            <h2>Create your account</h2>
            <form class="signupForm" id="signup-form" action="register-database.php" method="POST">
                <input class="inputName" type="text" name="username" placeholder="username" required>
                <input class="inputPass" type="password" name="password" placeholder="Password" required>
                <button type="submit" class="signupButton">Sign Up</button>
            </form>
            <p>Already have an account? <a class="signToLog" href="login-form.php">Log in</a></p>
        </div>
    </div>
</div>
