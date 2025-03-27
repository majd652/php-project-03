<?php require "partials/header.php"; ?>
<h1>Inlog formulier</h1>
<form action="login.php" method="post">
    <label for="gebruikersnaam">Uw gebruikersnaam</label>
    <input type="text" name="gebruikersnaam" id="gebruikersnaam" placeholder="username">
    <label for="wachtwoord">Uw wachtwoord</label>
    <input type="password" name="wachtwoord" id="wachtwoord">
    <input type="submit" value="Log nu in">
</form>

<?php require "partials/footer.php"; ?>
