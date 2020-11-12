<?php

class user
{
    private $email;
    private $nom;
    private $mdp;

    public function __construct($email, $mdp, $nom = ""){
        $this->email = $email;
        $this->nom = $nom;
        $this->mdp = /*$this->cryptMdp*/($mdp);
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

    public function connection (){
        $error = "";

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $error .= "Email mal formé<br>";
        }

        if(empty($this->mdp)){
            $error .= "Mdp vide<br>";
        }

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
