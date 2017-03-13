<?php
require_once(APP . "model.php");

class lien_parente extends model{
	protected $lie_id;
	protected $lie_libelle;
	
	
	
	public function __construct($lie_id = null, $lie_libelle = null){
		parent::__construct('lien_parente', 'lie_id', true, null);
		$this->lie_id = $lie_id;
		$this->lie_libelle = $lie_libelle;
	}
	public function __destruct(){
		unset($lie_id);
		unset($lie_libelle);
	}
	
	
	
	public function getLie_id(){
		return $this->lie_id;
	}
	public function setLie_id($nouveau){
		$this->lie_id = $nouveau;
	}
	
	
	
	public function getLie_libelle(){
		return $this->lie_libelle;
	}
	public function setLie_libelle($nouveau){
		$this->lie_libelle = $nouveau;
	}
}

?>