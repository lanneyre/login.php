<?php 
/**
 * Class permettant de générer la connexion à la bdd
 */
class database
{
	// attribut de configuration du server de bdd
	private static $_host = "localhost";
	private static $_user = "root";
	private static $_mdp = "";
	private static $_bdd = "loginmvc";
	private static $_driver = "mysql";

	// Attribut de class servant à stocker l'identifiant de connexion
	public static $_conn;

	// établie la connexion avec le serveur de bdd
	public static function createConnexion(){
		self::$_conn = new pdo(self::$_driver.":host=".self::$_host.";dbname=".self::$_bdd.";charset=UTF8", self::$_user, self::$_mdp);
	}
}
/*
// Cette version ci-dessous nécessite d'implémenter la class pour pouvoir l'utiliser
class database
{
	private $_host = "localhost";
	private $_user = "root";
	private $_mdp = "";
	private $_bdd = "loginmvc";
	private $_driver = "mysql";

	public $_conn;

	public function createConnexion(){
		$this->_conn = new pdo(self::$_driver.":host=".$this->_host.";dbname=".$this->_bdd.";charset=UTF8", $this->_user, $this->_mdp);
    }
    
    public function __construct(){
        $this->createConnexion();
    }
}*/