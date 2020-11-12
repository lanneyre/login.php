<?php
    if($page == "createcompte" && isset($_POST)){
        $user = new user($_POST['email'], $_POST['mdp'], $_POST['nom'], $_POST['mdp2']);
        $inscription = $user->inscription();
        if($inscription === true){
            $_SESSION['user'] = $user;
            header("Location: ?page=home");
            exit;
        } else {
            echo $inscription;
        }
    }
    include_once("View/create.view.php");

    