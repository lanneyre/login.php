<?php

    var_dump($_SESSION);

    if(empty($_SESSION)){
        include_once("View/login.view.php");
    } else {
        include_once("View/home.view.php");
    }
    