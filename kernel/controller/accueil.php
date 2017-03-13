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
				$saisonChoisie = $this->saison->find('sai_id = ' . $_POST['saison']);
				
				$_SESSION['saison']['debut'] = $saisonChoisie[0]['sai_debut']; 
				$_SESSION['saison']['fin'] = $saisonChoisie[0]['sai_fin'];
			}
			
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







