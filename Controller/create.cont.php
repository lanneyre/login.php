<?php
    /* Normalement la creation d'un compte aurait pu faire partie du controleur de login (c'est en quelques sortes le même module d'authentification) mais pour plus de claretée, j'ai fait le choix 
        d'avoir un code plus court et plus simple en séparant l'inscription et le login
    */
    // traitement du formulaire d'inscription
    if($page == "createcompte" && isset($_POST)){
        // Je créé un utilisateur avec les informations données par l'utilisateur dans le formulaire d'inscription
        $user = new user($_POST['email'], $_POST['mdp'], $_POST['nom'], $_POST['mdp2']);
        // je tente d'inscrire l'utilisateur
        $inscription = $user->inscription();
        // Si tout ce passe bien
        if($inscription === true){
            // Je stocke l'utilisateur en session 
            $_SESSION['user'] = $user;
            // je redirige la page vers la page d'accueil
            header("Location: ?page=home");
            // exit permet d'arreter le script : si cette ligne est lancé, rien en dessous n'existe.
            exit;
        } else {
            // J'affiche les messages d'erreurs
            echo $inscription;
        }
    }
    // J'inclue la vue d'inscription
    include_once("View/create.view.php");

    