<?php
require_once(APP . "model.php");

class suivre extends model{
	protected $sui_saison;
	protected $sui_adherent;
	protected $sui_cours;
	
	
	
	public function __construct($sui_saison = null, $sui_adherent = null, $sui_cours = null){
		parent::__construct('suivre', array('sui_saison', 'sui_adherent', 'sui_cours'), false, array('saison'=>'sui_saison', 'adherent'=>'sui_adherent', 'cours'=>'sui_cours'));
		$this->sui_saison = $sui_saison;
		$this->sui_adherent = $sui_adherent;
		$this->sui_cours = $sui_cours;
	}
	public function __destruct(){
		unset($sui_saison);
		unset($sui_adherent);
		unset($sui_cours);
	}
	
	
	
	public function getsui_saison(){
		return $this->sui_saison;
	}
	public function setsui_saison($nouveau){
		$this->sui_saison = $nouveau;
	}
	
	
	
	public function getsui_adherent(){
		return $this->sui_adherent;
	}
	public function setsui_adherent($nouveau){
		$this->sui_adherent = $nouveau;
	}
	
	
	
	public function getsui_cours(){
		return $this->sui_cours;
	}
	public function setsui_cours($nouveau){
		$this->sui_cours = $nouveau;
	}
}

?>