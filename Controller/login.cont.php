<?php
    
    if($page == "traitementlogin" && isset($_POST)){
        //$test = requete bdd
        $u = new user($_POST['email'], $_POST['mdp']);
        $conn = $u->connection();
        if($conn === true){
            $_SESSION['user'] = $u;
            header("Location: ?page=home");
            exit;
        } else {
            echo $conn;
        }        

    } else {
        include_once("View/login.view.php");
    }
    