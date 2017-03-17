<?php
	require_once(APP."Controller.php");
	class c_settings extends Controller{
		
		protected $models;
		
		public function __construct(){
			$this->models = array('position');
			parent::__construct($this->models);
		}
		
		
		
		public function index(){
			$this->render("index");
		}
		
		
		/*
		 *	Permet de changer l'apparence globale de l'application grâce aux thèmes installés dans le dossier CSS (un thème = un dossier).
		 */
		public function theme(){
			if (isset($_POST['theme_choisi'])){
				$nouveauTheme = $_POST['theme_choisi'];
				
				$chemin_conf = CONF . "/settings.ini";
				ini_write($chemin_conf, "theme", "theme", $nouveauTheme);
			}
			
			$this->render("themes");
		}
		
		/*
		 *	Page de réglages pour les paramètres de connexion à la base de données.
		 */
		public function database(){
			$this->render("database");
		}
		
		public function database_connexion(){
			
			$chemin_conf = CONF . "/settings.ini";
			
			/*
			 * Ecriture des nouveaux paramètres
			 */
			if (isset($_POST['host']) && $_POST['host'] != null){
				$host = $_POST['host'];
				ini_write($chemin_conf, "database", "host", $host);
			}
			
			if (isset($_POST['port']) && $_POST['port'] != null){
				$port = $_POST['port'];
				ini_write($chemin_conf, "database", "port", $port);
			}
			
			if (isset($_POST['type']) && $_POST['type'] != null){
				$type = $_POST['type'];
				ini_write($chemin_conf, "database", "type", $type);
			}
			
			if (isset($_POST['name']) && $_POST['name'] != null){
				$name = $_POST['name'];
				ini_write($chemin_conf, "database", "name", $name);
			}
			
			if (isset($_POST['user']) && $_POST['user'] != null){
				$user = $_POST['user'];
				ini_write($chemin_conf, "database", "user", $user);
			}
			
			if (isset($_POST['password']) && $_POST['password'] != null){
				$password = $_POST['password'];
				ini_write($chemin_conf, "database", "password", $password);
			}
			
			
			
			// echo "<pre>";
			// print_r($this);
			// echo "</pre>";
			
			
			
			try{
				$this->position->find(null, null, null, null, null);
			}catch (PDOException $e){
				erreur($e);
			}
			
			$this->render("database_connexion");
		}
	}
?>







