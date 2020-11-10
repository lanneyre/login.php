<?php

session_start();

// $_SESSION['nom'] = "Mickey";
// unset($_SESSION['nom']);
require_once 'Model/autoloader.php';
Autoloader::register();

database::createConnexion();
// $bdd = new database();
// $bdd->createConnexion();

var_dump(database::$_conn);

if(!empty($_GET['page'])) {
    $page = strtolower($_GET['page']);
} else {
    $page = "home";
}

// var_dump($page);

if(is_file("Controller/".$page.".cont.php")){
    require_once("Controller/".$page.".cont.php");
} else {
    if($page == "traitementlogin"){
        require_once("Controller/login.cont.php");
    } else {
        require_once("Controller/home.cont.php");
    }
    
}
