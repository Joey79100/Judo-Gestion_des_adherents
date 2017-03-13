<?php
require_once(APP . "model.php");

class inscrire extends model{
	protected $ins_saison;
	protected $ins_adherent;
	
	
	
	public function __construct($ins_saison = null, $ins_adherent = null){
		parent::__construct('inscrire', array('ins_saison', 'ins_adherent'), false, array('saison'=>'ins_saison', 'adherent'=>'ins_adherent'));
		$this->ins_saison = $ins_saison;
		$this->ins_adherent = $ins_adherent;
	}
	public function __destruct(){
		unset($ins_saison);
		unset($ins_adherent);
	}
	
	
	
	public function getIns_saison(){
		return $this->ins_saison;
	}
	public function setIns_saison($nouveau){
		$this->ins_saison = $nouveau;
	}
	
	
	
	public function getIns_adherent(){
		return $this->ins_adherent;
	}
	public function setIns_adherent($nouveau){
		$this->ins_adherent = $nouveau;
	}
}

?>