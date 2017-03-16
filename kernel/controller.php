<?php
	class Controller{
		protected $viewvar = array();
		public $layout;
		
		
		
		
		public function __construct($lesModels, $layout = "default"){
			foreach(makeArray($lesModels) as $unModel){
				$this->loadModel($unModel);
			}
			$this->layout = $layout;
		}
		
		
		
		/**
		*	loadModel - Charge le model passé en paramètre
		*	@param $model Le model à charger
		*/		
		public function loadModel($model){
			require_once(MODEL . $model.'.php');
			$this->$model = new $model();
		}
		
		
		
		/**
		*	set - Prépare variables pour la vue
		*	@param $v variable array() venant du controller
		*/
		public function set($nouvellesDonnees = array()){
			/*
			*	En gros, un object controller a une propriété viewvar (un tableau)
			*   De base il est vide. Quand on fait un set on le remplit avec le tableau passé en paramètre.
			*/
			if($nouvellesDonnees != null){
				$this->viewvar = array_merge($this->viewvar, $nouvellesDonnees);
			}
			
			// echo "<br/> Viewvar : <br/> <pre>";
			// print_r ($this->viewvar);
			// echo "</pre>";
			
		}
		
		
		
		/**
		*	render - appelle la vue associée pour l'affichage
		*	@param $vue le nom de la vue à l'afficher
		*/
		public function render($vue){
			extract($this->viewvar);							// Tableau de données
			
			$cheminVue = VIEW . get_class($this) . '/' . $vue . '.php';
			
			try{
				if(file_exists($cheminVue)){
					ob_start();											// Mise en attente de l'affichage
					
					require($cheminVue);								// Importation de la vue demandée
					$content = ob_get_clean();							// Récupération du contenu de la vue récupérée juste avant
					
					require(LAYOUT . $this->layout.'.php');				// Appel du template, qui intègrera le contenu de la vue automatiquement
				}else{
					throw new Exception("404 : Le fichier demandé est introuvable.");
				}
			} catch (Exception $e){
				erreur($e, 'http', array("Page recherchée" => $cheminVue));
			}
		}
	}
?>