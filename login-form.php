<?php require "partials/header.php"; ?>
<div class="container">
    <div class="login-box">
        <h2>login to Upost</h2>
        <form action="login-check.php" method="POST" class="login-form">
            <input type="text" name="gebruikersnaam" id="gebruikersnaam" placeholder="Phone, email, or username" required>
            <input type="password" name="wachtwoord" id="wachtwoord" placeholder="Password" required>
            <input type="submit">
        </form>
        <a href="#" class="forgot-password">Forgot password?</a>
        <p>Dont have an account?</p>
        <a href="signup.php" class="signup-link">Sign up for Upost</a>
    </div>
</div>

<?php require "partials/footer.php"; ?>
