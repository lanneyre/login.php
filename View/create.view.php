<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
</head>
<body>
    <fieldset>
        <legend>Créez votre compte</legend>
        <form action="?page=createCompte" method="post">
        <label for="nom">Nom</label> <input type="text" name="nom" id="nom"><br>
            <label for="email">Email</label> <input type="email" name="email" id="email"><br>
            <label for="mdp">MDP</label> <input type="password" name="mdp" id="mdp"><br>
            <label for="mdp2">Retapez votre mdp</label> <input type="password" name="mdp2" id="mdp2"><br>
            <input type="submit" value="S'inscrire"> <input type="reset" value="Annuler"> 
        </form>
    </fieldset>
    <a href="?page=home">Accueil</a>
</body>
</html>