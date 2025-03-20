<?php require "partials/header.php"; ?>
    <form action="register-database.php" method="post">
        <label for="gebruikersnaam">gebruikersnaam</label>
        <input type="text" name="gebruikersnaam" id="gebruikersnaam" placeholder="">
        <label for="wachtwoord">wachtwoord</label>
        <input type="password" name="wachtwoord" id="wachtwoord">
        <input type="submit" value="Accoumt aanmaken">
    </form>

<?php require "partials/footer.php"; ?>