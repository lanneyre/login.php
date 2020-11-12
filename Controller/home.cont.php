<?php

    var_dump($_SESSION);

    if(empty($_SESSION['user'])){
        include_once("View/login.view.php");
    } else {
        if($_SESSION['user']->connection() === true){
            include_once("View/home.view.php");
        } else {
            include_once("View/login.view.php");
        }
        
    }
    