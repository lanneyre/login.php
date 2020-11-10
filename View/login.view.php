<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <fieldset>
        <legend>Connectez-vous</legend>
        <form action="?page=traitementLogin" method="post">
            <label for="email">Email</label> <input type="email" name="email" id="email"><br>
            <label for="mdp">MDP</label> <input type="password" name="mdp" id="mdp"><br>
            <input type="submit" value="Se connecter"> <input type="reset" value="Annuler"> 
        </form>
    </fieldset>
</body>
</html>