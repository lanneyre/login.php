<?php

session_start();

// $_SESSION['nom'] = "Mickey";
// unset($_SESSION['nom']);
require_once 'Model/autoloader.php';
Autoloader::register();

if(!empty($_GET['page'])) {
    $page = strtolower($_GET['page']);
} else {
    $page = "home";
}

// var_dump($page);

if(is_file("Controller/".$page.".cont.php")){
    require_once("Controller/".$page.".cont.php");
} else {
    require_once("Controller/home.cont.php");
}
