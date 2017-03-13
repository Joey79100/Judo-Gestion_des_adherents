<?php
require_once(APP . "model.php");

class famille extends model{
	protected $fam_id;
	protected $fam_libelle;
	
	
	
	public function __construct($fam_id = null, $fam_libelle = null){
		parent::__construct('famille', 'fam_id', true, null);
		$this->fam_id = $fam_id;
		$this->fam_libelle = $fam_libelle;
	}
	public function __destruct(){
		unset($fam_id);
		unset($fam_libelle);
	}
	
	
	
	public function getFam_id(){
		return $this->fam_id;
	}
	public function setFam_id($nouveau){
		$this->fam_id = $nouveau;
	}
	
	
	
	public function getFam_libelle(){
		return $this->fam_libelle;
	}
	public function setFam_libelle($nouveau){
		$this->fam_libelle = $nouveau;
	}
}

?>