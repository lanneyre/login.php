<?php
    $test = true;
    if($page == "traitementlogin" && isset($_POST)){
        //$test = requete bdd

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error .= "Email mal formé<br>";
        }

        if(empty($_POST['mdp'])){
            $error .= "Mdp vide<br>";
        }

        if(empty($error)){
            $sql = "SELECT * from `user` WHERE email = :email AND mdp = :mdp";
            $req = database::$_conn->prepare($sql);
            $req->bindValue(":email", $_POST['email']);
            $req->bindValue(":mdp", $_POST['mdp']);
            $req->execute();

            if($req->rowCount() == 1){
                $user = $req->fetch();
                $_SESSION['email'] = $user['email'];
                $_SESSION['nom'] = $user['nom'];
                header("Location: ?page=home");
                exit;
            } else {
                unset($_SESSION);
                header("Location: ?page=home&error");
                exit;
            }

        } else {
            echo $error;
        }

    } else {
        include_once("View/login.view.php");
    }
    