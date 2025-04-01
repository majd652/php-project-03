<?php require "partials/header.php"; ?>
    <div class="content">
        <div class="card">
            <h2>Create your account</h2>
            <form class="signupForm" id="signup-form" action="register-database.php" method="POST">
                <input class="inputName" type="text" name="username" placeholder="username" required>
                <input class="inputPass" type="password" name="wachtwoord" placeholder="Password" required>
                <button type="submit" class="signupButton">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login-form.php">Log in</a></p>
        </div>
    </div>

<?php require "partials/footer.php"; ?>