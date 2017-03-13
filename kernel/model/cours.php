<?php
require_once(APP . "model.php");

class cours extends model{
	protected $cou_id;
	protected $cou_libelle;
	protected $cou_age;
	
	
	
	public function __construct($cou_id = null, $cou_libelle = null, $cou_age = null){
		parent::__construct('cours', 'cou_id', true, null);
		$this->cou_id = $cou_id;
		$this->cou_libelle = $cou_libelle;
		$this->cou_age = $cou_age;
	}
	public function __destruct(){
		unset($cou_id);
		unset($cou_libelle);
		unset($cou_age);
	}
	
	
	
	public function getCou_id(){
		return $this->cou_id;
	}
	public function setCou_id($nouveau){
		$this->cou_id = $nouveau;
	}
	
	
	
	public function getCou_libelle(){
		return $this->cou_libelle;
	}
	public function setCou_libelle($nouveau){
		$this->cou_libelle = $nouveau;
	}
	
	
	
	
	public function getCou_age(){
		return $this->cou_age;
	}
	public function setCou_age($nouveau){
		$this->cou_age = $nouveau;
	}
}

?>