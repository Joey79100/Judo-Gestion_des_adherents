<?php
require_once(APP . "model.php");

class saison extends model{
	protected $sai_id;
	protected $sai_debut;
	protected $sai_fin;
	
	
	
	public function __construct($sai_id = null, $sai_debut = null, $sai_fin = null){
		parent::__construct('saison', 'sai_id', true, null);
		$this->sai_id = $sai_id;
		$this->sai_debut = $sai_debut;
		$this->sai_fin = $sai_fin;
	}
	public function __destruct(){
		unset($sai_id);
		unset($sai_debut);
		unset($sai_fin);
	}
	
	
	
	public function getSai_id(){
		return $this->sai_id;
	}
	public function setSai_id($nouveau){
		$this->sai_id = $nouveau;
	}
	
	
	
	public function getSai_debut(){
		return $this->sai_debut;
	}
	public function setSai_debut($nouveau){
		$this->sai_debut = $nouveau;
	}
	
	
	
	
	public function getSai_fin(){
		return $this->sai_fin;
	}
	public function setSai_fin($nouveau){
		$this->sai_fin = $nouveau;
	}
}

?>