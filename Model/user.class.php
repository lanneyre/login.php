<?php

class user
{
    private $email;
    private $nom;
    private $mdp;
    private $mdp2;

    public function __construct($email, $mdp, $nom = "", $mdp2 = null){
        $this->email = $email;
        $this->nom = $nom;
        $this->mdp = $mdp;
        $this->mdp2 = $mdp2;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function cryptMdp($mdp){
        return password_hash($mdp, PASSWORD_DEFAULT);
    }

    public function validateur ($login = true){
        $error = "";
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $error .= "Email mal formé<br>";
        }
        if(empty($this->mdp)){
            $error .= "Mdp vide<br>";
        }
        if(!$login && empty($this->mdp2)){
            $error .= "Mdp2 vide<br>";
        }
        if(!$login && strlen($this->nom) < 3){
            $error .= "Le nom est trop court<br>";
        }
        if(!$login && $this->mdp !== $this->mdp2){
            $error .= "Les mots de passe ne correspondent pas<br>";
        }
        return $error;
    }

    public function inscription(){
        $error = $this->validateur(false);
        
        if(empty($error)){
            $sql = "INSERT INTO `user` (`email`, `nom`, `mdp`) VALUES (:email, :nom, :mdp) ";
            $req = database::$_conn->prepare($sql);
            $req->bindValue(":email", $this->email);
            $req->bindValue(":nom", $this->nom);
            $req->bindValue(":mdp", $this->cryptMdp($this->mdp));
            if($req->execute()) {
                return true;
            } else {
                return "L'email est déjà connu de nos services !";
            }
        }  else {
            return $error;
         }
    }

    public function connection (){
        $error = $this->validateur();

        if(empty($error)){

            $sql = "SELECT * from `user` WHERE email = :email";
            $req = database::$_conn->prepare($sql);
            $req->bindValue(":email", $this->email);
            $req->execute();

            if($req->rowCount() == 1){
                $user = $req->fetch();
                if(password_verify($this->mdp, $user['mdp'])){
                    $this->nom = $user['nom'];
                    // $this->mdp = $user['mdp'];   
                    return true; 
                } else {
                    return "La combinaison email/mdp n'existe pas !";
                }
            } else {
                return "La combinaison email/mdp n'existe pas !";
            }

        } else {
           return $error;
        }
    }
}
