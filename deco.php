<?php  
    session_start();
    // Pour détruire une session il faut l'avoir démarrer au préalable
    session_destroy();
    // Cette ligne n'est pas absolument nécessaire puisque qu'elle fait doublon avec la précédente mais c'est une bonne pratique qui ne coute rien
    unset($_SESSION);
    // Je reirige vers la page d'accueil qui se chargera de rediriger vers la page de login puisqu'il n'y a plus de session active
    header("Location: index.php");
    exit;