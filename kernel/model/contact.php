<?php
require_once(APP . "model.php");

class contact extends model{
	protected $con_id;
	protected $con_contact;
	protected $con_type;
	protected $con_lien_parente;
	protected $con_adherent;
	
	
	
	public function __construct($con_id = null, $con_contact = null, $con_type = null, $con_lien_parente = null, $con_adherent = null){
		parent::__construct('contact', 'con_id', true, array('type_contact'=>'con_type', 'lien_parente'=>'con_lien_parente', 'adherent'=>'con_adherent'));
		$this->con_id = $con_id;
		$this->con_contact = $con_contact;
		$this->con_type = $con_type;
		$this->con_lien_parente = $con_lien_parente;
		$this->con_adherent = $con_adherent;
	}
	public function __destruct(){
		unset($con_id);
		unset($con_contact);
		unset($con_type);
		unset($con_lien_parente);
		unset($con_adherent);
	}
	
	
	
	public function getCon_id(){
		return $this->con_id;
	}
	public function setCon_id($nouveau){
		$this->con_id = $nouveau;
	}
	
	
	
	public function getCon_contact(){
		return $this->con_contact;
	}
	public function setCon_contact($nouveau){
		$this->con_contact = $nouveau;
	}
	
	
	
	public function getCon_type(){
		return $this->con_type;
	}
	public function setCon_type($nouveau){
		$this->con_type = $nouveau;
	}
	
	
	
	public function getCon_lien_parente(){
		return $this->con_lien_parente;
	}
	public function setCon_lien_parente($nouveau){
		$this->con_lien_parente = $nouveau;
	}
	
	
	
	public function getCon_adherent(){
		return $this->con_adherent;
	}
	public function setCon_adherent($nouveau){
		$this->con_adherent = $nouveau;
	}
}

?>