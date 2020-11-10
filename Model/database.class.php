<?php 
/**
 * 
 */
class database
{
	private static $_host = "localhost";
	private static $_user = "root";
	private static $_mdp = "";
	private static $_bdd = "loginmvc";

	public static $_conn;

	public static function createConnexion(){
		self::$_conn = new pdo("mysql:host=".self::$_host.";dbname=".self::$_bdd.";charset=UTF8", self::$_user, self::$_mdp);
	}
}
/*
class database
{
	private $_host = "localhost";
	private $_user = "root";
	private $_mdp = "";
	private $_bdd = "loginmvc";

	public $_conn;

	public function createConnexion(){
		$this->_conn = new pdo("mysql:host=".$this->_host.";dbname=".$this->_bdd.";charset=UTF8", $this->_user, $this->_mdp);
    }
    
    public function __construct(){
        $this->createConnexion();
    }
}*/