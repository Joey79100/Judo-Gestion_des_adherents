<?php
require_once(APP . "model.php");

class position extends model{
	protected $pos_id;
	protected $pos_libelle;
	
	
	
	public function __construct($pos_id = null, $pos_libelle = null){
		parent::__construct('position', 'pos_id', true, null);
		$this->pos_id = $pos_id;
		$this->pos_libelle = $pos_libelle;
	}
	public function __destruct(){
		unset($pos_id);
		unset($pos_libelle);
	}
	
	
	
	public function getPos_id(){
		return $this->pos_id;
	}
	public function setPos_id($nouveau){
		$this->pos_id = $nouveau;
	}
	
	
	
	public function getPos_libelle(){
		return $this->pos_libelle;
	}
	public function setPos_libelle($nouveau){
		$this->pos_libelle = $nouveau;
	}
}

?>