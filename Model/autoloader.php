<?php

/**
 * Class Autoloader
 * Un autoloader permet de charger une class automatiquement au moment ou le script en a besoin.
 * si le script n'a pas besoin d'une class il e la chargera pas et donc economisera des ressources système
 * IL faut donc respecter une convention de nommage pour les class et les fichiers correspondant afin de pouvoir automatiser l'action
 * 
 */
class Autoloader{

    /**
     * Enregistre cet autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à la classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
        // Toutes les class doivent être rangée au même endroit ici dans mon dossier Model et ont toutes comme nom :[nomDelaClasse].class.php
        require_once 'Model/' . $class . '.class.php';
    }

}