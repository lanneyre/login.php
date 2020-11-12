<?php
    // traitement du formulaire
    if($page == "traitementlogin" && isset($_POST)){
        
        // Je créé un utilisateur avec le mail et le mdp donnés par l'utilisateur dans le formulaire de login
        $u = new user($_POST['email'], $_POST['mdp']);
        // Je regarde si l'utilsateur existe
        $conn = $u->connection();
        // Si l'utilisateur correspond
        if($conn === true){
            // Je stocke l'utilisateur en session 
            $_SESSION['user'] = $u;
            // je redirige la page vers la page d'accueil
            header("Location: ?page=home");
            // exit permet d'arreter le script : si cette ligne est lancé, rien en dessous n'existe.
            exit;
        } else {
            // J'affiche les messages d'erreurs
            echo $conn;
        }        
    } 
    // J'inclue la vue de login
    include_once("View/login.view.php");
    