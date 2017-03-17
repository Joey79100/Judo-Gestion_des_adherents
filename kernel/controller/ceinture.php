<?php
	require_once(APP."Controller.php");
	class c_ceinture extends Controller{
		
		protected $models;
		
		public function __construct(){
			$this->models = array('ceinture', 'inscrire', 'suivre', 'adherent', 'saison', 'cours', 'famille', 'position');
			parent::__construct($this->models);
		}
		
		
		
		public function index(){
			$this->render("index");
		}
		
		
		
		public function passer(){
			
			// $nbmax = 12;
			$nbmax = null;
			if($nbmax != null){
				echo "<div class='debug'> NOTE : Seulement " . $nbmax . " enregistrements ont été chargés. </div>";
			}
			
			
			
			
			
			$idCours = $_POST['cours'];
			
			$idSaison = $this->saison->find('sai_debut = ' . $_SESSION['saison']['debut'] . ' AND sai_fin = ' . $_SESSION['saison']['fin'])
						[0]['sai_id'];
			
			$this->set(array('inscription' => $this->suivre->find('sui_cours = ' . $idCours . ' AND sui_saison = ' . $idSaison, 'sui_cours, sui_adherent', 1, array('saison', 'famille'), $nbmax)));
			
			
			
			$this->render("cours");
		}
		
		
		
		public function ajouter(){
			// Récupération de toutes les ceintures entrées dans la base
			$this->set(array('ceintures' => $this->ceinture->find(null, 'cei_id DESC')));
			
			$this->render("ajouter");
		}
		
		
		
		public function create(){
			$this->ceinture->setCei_libelle($_POST['nouvelleCeinture']);
			$this->ceinture->setCei_age_mini($_POST['ageNouvelleCeinture']);
			$this->ceinture->create();
			
			header("Location: ". CEINTURE ."ajouter");
		}
	}
?>