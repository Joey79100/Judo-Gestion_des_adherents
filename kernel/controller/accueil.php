<?php
	require_once(APP."Controller.php");
	class c_accueil extends Controller{
		
		// protected $models;
		
		public function __construct(){
			$this->models = array('saison');
			parent::__construct($this->models);
		}
		
		
		
		public function index(){
			// Recherche des saisons disponibles pour affichage dans le menu
			$this->set(array('saisons' => $this->saison->find()));
			
			if(isset($_POST['saison'])){
				$saisonChoisie = $this->saison->read($_POST['saison']);
				
				$_SESSION['saison']['id'] = $_POST['saison'];	// Est-ce utile ?
				$_SESSION['saison']['debut'] = $saisonChoisie['sai_debut']; 
				$_SESSION['saison']['fin'] = $saisonChoisie['sai_fin'];
			}else{
				$saisonChoisie = $this->saison->find("sai_debut = " . $_SESSION['saison']['debut'] . "AND sai_fin = " . $_SESSION['saison']['fin'])[0];
				
				$_SESSION['saison']['id'] = $saisonChoisie['sai_id'];	// Est-ce utile ?
			}
			
			// var_dump($_SESSION);
			
			$this->render("index");
		}
		
		
		
		public function testinterface_form(){
			$this->render("test_interface_form");
		}
		
		
		
		public function testinterface_table(){
			$this->render("test_interface_table");
		}
	}
?>







