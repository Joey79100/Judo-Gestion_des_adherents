<?php
require_once(APP . "model.php");

class passer extends model{
	protected $pas_saison;
	protected $pas_adherent;
	protected $pas_ceinture;
	protected $pas_date;
	
	
	
	/********************************************************/
	/* !!!!!  GERER LE CAS DE LA DOUBLE CLE PRIMAIRE  !!!!! */
	/********************************************************/
	
	public function __construct($pas_saison = null, $pas_adherent = null, $pas_ceinture = null, $pas_date = null){
		parent::__construct('passer', 'pas_saison', false, array('saison'=>'pas_saison', 'adherent'=>'pas_adherent', 'ceinture'=>'pas_ceinture'));
		$this->pas_saison = $pas_saison;
		$this->pas_adherent = $pas_adherent;
		$this->pas_ceinture = $pas_ceinture;
		$this->pas_date = $pas_date;
	}
	public function __destruct(){
		unset($pas_saison);
		unset($pas_adherent);
		unset($pas_ceinture);
		unset($pas_date);
	}
	
	
	
	public function getPas_saison(){
		return $this->pas_saison;
	}
	public function setPas_saison($nouveau){
		$this->pas_saison = $nouveau;
	}
	
	
	
	public function getPas_adherent(){
		return $this->pas_adherent;
	}
	public function setPas_adherent($nouveau){
		$this->pas_adherent = $nouveau;
	}
	
	
	
	public function getPas_ceinture(){
		return $this->pas_ceinture;
	}
	public function setPas_ceinture($nouveau){
		$this->pas_ceinture = $nouveau;
	}
	
	
	
	public function getPas_date(){
		return $this->pas_date;
	}
	public function setPas_date($nouveau){
		$this->pas_date = $nouveau;
	}
}

?>