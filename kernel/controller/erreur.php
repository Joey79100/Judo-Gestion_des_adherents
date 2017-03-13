<?php
	require_once(APP."Controller.php");
	class erreur extends Controller{
		
		protected $models;
		
		public function __construct(){
			$this->models = array();
			parent::__construct($this->models);
		}
		
		
		
		public function index(){
			$this->render("index");
		}
		
		
		public function balancer($exception, $type, $infosAdditionnelles){
			$this->viewvar['erreur']['code'] = $exception->getCode();
			$this->viewvar['erreur']['type'] = $type;
			$infos_principales = array(
										"Message" => $exception->getMessage(),
										"Fichier" => $exception->getFile(),
										"Ligne" => $exception->getLine()
										);
			$this->viewvar['erreur']['debug'] = $exception->xdebug_message;
			
			$this->viewvar['erreur']['infos'] = array_merge($infos_principales, $infosAdditionnelles);
			
			
			$this->render("erreur");
		}
	}
?>