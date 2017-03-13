<?php
require_once(APP . "model.php");

class type_contact extends model{
	protected $typ_id;
	protected $typ_libelle;
	
	
	
	public function __construct($typ_id = null, $typ_libelle = null){
		parent::__construct('type_contact', 'typ_id', true, null);
		$this->typ_id = $typ_id;
		$this->typ_libelle = $typ_libelle;
	}
	public function __destruct(){
		unset($typ_id);
		unset($typ_libelle);
	}
	
	
	
	public function getTyp_id(){
		return $this->typ_id;
	}
	public function setTyp_id($nouveau){
		$this->typ_id = $nouveau;
	}
	
	
	
	public function getTyp_libelle(){
		return $this->typ_libelle;
	}
	public function setTyp_libelle($nouveau){
		$this->typ_libelle = $nouveau;
	}
}

?>