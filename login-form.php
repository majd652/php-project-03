<?php require "partials/header.php"; ?>
<div class="loginBody">
    <div class="container">
        <div class="loginBox">
            <h2>login to Upost</h2>
            <form action="login-check.php" method="POST" class="loginForm">
                <input class="userLog" type="text" name="username" id="username" placeholder="Phone, email, or username" required>
                <input class="passLog" type="password" name="password" id="password" placeholder="Password" required>
                <input class="loginBtn" type="submit" placeholder="log in">
            </form>
            <a href="#" class="forgot-password">Forgot password?</a>
            <p class="noAccount">Dont have an account?</p>
            <a href="register-form.php" class="logToSign">Sign up here</a>
        </div>
    </div>
</div>
<?php require "partials/footer.php"; ?>
