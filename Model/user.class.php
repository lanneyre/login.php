<?php
/**
 * Model de l'objet user 
 * COntient la description de ce qu'est un utilisateur (attributs) et de ce qu'il peut faire
 */
class user
{
    // Un utilisateur se caractérise par : 
    private $email;
    private $nom;
    private $mdp;
    private $mdp2;

    // pour créer un user, nous avons besoin d'au minimum un email et un mdp
    // le nom et le second mdp sont optionnels

    // Constructeur de l'objet
    // Cette methode un peu particulière est automatiquement appeler au moment ou l'objet est créé avec le mot clé new
    public function __construct($email, $mdp, $nom = "", $mdp2 = null){
        $this->email = $email;
        $this->nom = $nom;
        $this->mdp = $mdp;
        $this->mdp2 = $mdp2;
    }

    // Méthode magique : getter
    public function __get($name)
    {
        return $this->$name;
    }

    // Méthode magique : setter
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    // Méthode permettant de hasher un mdp
    public function cryptMdp($mdp){
        return password_hash($mdp, PASSWORD_DEFAULT);
    }

    // Cette methode permet de valider les informations données par un utilisateur
    // l'argument $login permet de définir si les données proviennent du formulaire de login ou d'inscription
    // $login = true => les données viennent du login
    // $login = false => les données viennent de l'inscription
    public function validateur ($login = true){
        // $error contiendra toutes les erreurs
        $error = "";

        // je teste si l'email est mal formé
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $error .= "Email mal formé<br>";
        }
        // je teste si le mdp est vide
        if(empty($this->mdp)){
            $error .= "Mdp vide<br>";
        }

        // je teste si le second mdp est vide
        if(!$login && empty($this->mdp2)){
            $error .= "Mdp2 vide<br>";
        }

        // je teste si la longueur du nom est inférieur à 3 caractères 
        if(!$login && strlen($this->nom) < 3){
            $error .= "Le nom est trop court<br>";
        }

        // Je teste si les mdp ne correspondent pas
        if(!$login && $this->mdp !== $this->mdp2){
            $error .= "Les mots de passe ne correspondent pas<br>";
        }

        // je renvoie les erreurs
        return $error;
    }

    // permet d'inscrire un utilisateur
    public function inscription(){
        // Je checke la validité des données
        $error = $this->validateur(false);
        
        if(empty($error)){
            // Si c'est bon je créé une requete préparée d'insertion 
            $sql = "INSERT INTO `user` (`email`, `nom`, `mdp`) VALUES (:email, :nom, :mdp) ";
            // En choisisant de faire une requete préparée, j'évite les attaques par injection sql
            $req = database::$_conn->prepare($sql);
            // Il doit forcement y avoir autant de bindValue ou bindParam que de valeur à remplacer dans la requete
            $req->bindValue(":email", $this->email);
            $req->bindValue(":nom", $this->nom);
            $req->bindValue(":mdp", $this->cryptMdp($this->mdp));
            // Si la requete se passe bien
            if($req->execute()) { 
                // Je renvoi true
                return true;
            } else {
                // Sinon cela veux dire que l'email rentré existe déjà en bdd
                return "L'email est déjà connu de nos services !";
            }
        }  else {
            // Dans tous les autres cas je renvoi les erreurs
            return $error;
         }
    }
    // Permet de connecter un utilisateur
    public function connection (){
        // Je checke la validité des données
        $error = $this->validateur();

        if(empty($error)){
            // Si c'est bon je créé une requete préparée pour aller chercher un utilisateur
            $sql = "SELECT * from `user` WHERE email = :email";
            $req = database::$_conn->prepare($sql);
            $req->bindValue(":email", $this->email);
            $req->execute();
            // Si la requete me renvoi une ligne cela veut dire qu'il y a un email correspondant
            // Il ne peut pas y avoir plus d'une ligne renvoyée car l'email est une clé primaire et donc ne peut pas être en plusieurs exemplaire dans la bdd
            if($req->rowCount() == 1){
                // je recupère la ligne en question
                $user = $req->fetch();
                // Je n'ai plus qu'a vérifier le mdp
                if(password_verify($this->mdp, $user['mdp'])){
                    // Si c'est bon je finis de remplir l'objet
                    $this->nom = $user['nom'];
                    // $this->mdp = $user['mdp'];   
                    // Et je renvoi vrai
                    return true; 
                } else {
                    // Sinon cela veux dire que le mot de passe n'est pas bon
                    // Pour des raisons de sécurité j'évite de dire ce qui ne va pas mais j'informe l'utilisateur que la combinaison est mauvaise
                    return "La combinaison email/mdp n'existe pas !";
                }
            } else {
                // Pour des raisons de sécurité j'évite de dire ce qui ne va pas mais j'informe l'utilisateur que la combinaison est mauvaise
                return "La combinaison email/mdp n'existe pas !";
            }

        } else {
            // J'indique les erreurs dans le formulaire
           return $error;
        }
    }
}
