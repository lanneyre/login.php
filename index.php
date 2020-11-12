<?php

// Je met en place mon autoloader dès le début afin de charger les classes et permettre le stockage d'objet en session
require_once 'Model/autoloader.php';
Autoloader::register();
// Si je démarre une session et que j'y ai stocké un objet (ex: une instance de user), je vais avoir une fatale error : 
/*
    Fatal error: main(): The script tried to execute a method or access a property of an incomplete object. Please ensure that the class definition &quot;user&quot; of the object you are trying to operate on was loaded _before_ unserialize() gets called or provide an autoloader to load the class definition
*/
session_start();

// Ma classe database possède la fonction statique createConnexion me permettant de générer un identifiant de connexion et donc de dialoguer avec la bdd
database::createConnexion();

// La même chose mais en instanciant la classe database
// $bdd = new database();
// $bdd->createConnexion();

// Affiche l'identifiant de connexion à la bdd
// var_dump(database::$_conn);

// Si la variable page contenue dans l'url existe et n'est pas vide, je met ma variable $page à la valeur demandé dans tous les autres cas, c'est je met la valeur par défaut home
if(!empty($_GET['page'])) {
    $page = strtolower($_GET['page']);
} else {
    $page = "home";
}

// var_dump($page);

// Je teste si le controleur existe pour pouvoir l'inclure dans ma page
if(is_file("Controller/".$page.".cont.php")){
    require_once("Controller/".$page.".cont.php");
} else {
    // pour les traitements de formulaire, le controlleur n'existe pas tel quel; j'ai donc besoin de rediriger vers le bon en fonction de la page demandée
    if($page == "traitementlogin"){
        require_once("Controller/login.cont.php");
    } else if($page == "createcompte"){
        require_once("Controller/create.cont.php");
    } else {
        // dans tous les autres cas je charge la page home
        require_once("Controller/home.cont.php");
    }
}
