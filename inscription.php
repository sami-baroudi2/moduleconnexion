<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="inscription" content="Formulaire d'inscription">
    <title>Mon formulaire d'inscription</title>
</html>
<body>
    <form method="POST" action="">
        <label for="login">Login</label>
        <input type="text" name="login" required>

        <label for="nom">Nom</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>

        <label for="password2">Confirmation</label>
        <input for="password" name="password2" required>

        <input type="submit" name="submit" value="Je m'inscris !">

</form>     
