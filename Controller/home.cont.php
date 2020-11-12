<?php

    // var_dump($_SESSION);
    // Sécurité de session : si aucun user n'est stocké en session je redirige vers la page de login
    if(empty($_SESSION['user'])){
        include_once("View/login.view.php");
    } else {
        // Sécurité : je vérifie si l'utilisateur en session à le droit d'accéder à cette page
        if($_SESSION['user']->connection() === true){
            include_once("View/home.view.php");
        } else {
            // Si non il doit se loguer !
            include_once("View/login.view.php");
        }
        
    }
    