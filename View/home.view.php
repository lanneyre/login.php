<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue dans le site de login</title>
</head>
<body>
    <h1>Bienvenue <?php echo $_SESSION['user']->nom;?></h1>
    <h2>Sur ce site</h2>

    <a href="deco.php">Se déconnecter</a>
</body>
</html>