<?php
require_once(APP . "model.php");

class ceinture extends model{
	protected $cei_id;
	protected $cei_libelle;
	protected $cei_age_mini;
	
	
	
	public function __construct($cei_id = null, $cei_libelle = null, $cei_age_mini = null){
		parent::__construct('ceinture', 'cei_id', true, null);
		$this->cei_id = $cei_id;
		$this->cei_libelle = $cei_libelle;
		$this->cei_age_mini = $cei_age_mini;
	}
	public function __destruct(){
		unset($cei_id);
		unset($cei_libelle);
		unset($cei_age_mini);
	}
	
	
	
	public function getCei_id(){
		return $this->cei_id;
	}
	public function setCei_id($nouveau){
		$this->cei_id = $nouveau;
	}
	
	
	
	public function getCei_libelle(){
		return $this->cei_libelle;
	}
	public function setCei_libelle($nouveau){
		$this->cei_libelle = $nouveau;
	}
	
	
	
	
	public function getCei_age_mini(){
		return $this->cei_age_mini;
	}
	public function setCei_age_mini($nouveau){
		$this->cei_age_mini = $nouveau;
	}
}

?>