<?php
require_once(APP . "model.php");

class adherent extends model{
	protected $adh_id;
	protected $adh_nom;
	protected $adh_prenom;
	protected $adh_genre;
	protected $adh_date_naissance;
	protected $adh_adresse_postale;
	protected $adh_adresse_complement;
	protected $adh_code_postal;
	protected $adh_ville;
	protected $adh_certificat_medical;
	protected $adh_licence;
	protected $adh_licence_numero;
	protected $adh_famille;
	protected $adh_position;
	
	
		
	public function __construct($adh_id = null, $adh_nom = null, $adh_prenom = null, $adh_genre = null, 
								$adh_date_naissance = null, $adh_adresse_postale = null, $adh_adresse_complement = null, $adh_code_postal = null,
								$adh_ville = null, $adh_certificat_medical = null, $adh_licence = null, $adh_licence_numero = null,
								$adh_famille = null, $adh_position = null){
		parent::__construct('adherent', 'adh_id', true, array('famille'=>'adh_famille', 'position'=>'adh_position'));
		$this->adh_id = $adh_id;
		$this->adh_nom = $adh_nom;
		$this->adh_prenom = $adh_prenom;
		$this->adh_genre = $adh_genre;
		$this->adh_date_naissance = $adh_date_naissance;
		$this->adh_adresse_postale = $adh_adresse_postale;
		$this->adh_adresse_complement = $adh_adresse_complement;
		$this->adh_code_postal = $adh_code_postal;
		$this->adh_ville = $adh_ville;
		$this->adh_certificat_medical = $adh_certificat_medical;
		$this->adh_licence = $adh_licence;
		$this->adh_licence_numero = $adh_licence_numero;
		$this->adh_famille = $adh_famille;
		$this->adh_position = $adh_position;
	}
	public function __destruct(){
		unset($adh_id);
		unset($adh_nom);
		unset($adh_prenom);
		unset($adh_genre);
		unset($adh_date_naissance);
		unset($adh_adresse_postale);
		unset($adh_adresse_complement);
		unset($adh_code_postal);
		unset($adh_ville);
		unset($adh_certificat_medical);
		unset($adh_licence);
		unset($adh_licence_numero);
		unset($adh_famille);
		unset($adh_position);
	}
	
	
	
	public function getAdh_id(){
		return $this->adh_id;
	}
	public function setAdh_id($nouveau){
		$this->adh_id = $nouveau;
	}
	
	
	
	public function getAdh_nom(){
		return $this->adh_nom;
	}
	public function setAdh_nom($nouveau){
		$this->adh_nom = $nouveau;
	}
	
	
	
	public function getAdh_prenom(){
		return $this->adh_prenom;
	}
	public function setAdh_prenom($nouveau){
		$this->adh_prenom = $nouveau;
	}
	
	
	
	public function getAdh_genre(){
		return $this->adh_genre;
	}
	public function setAdh_genre($nouveau){
		$this->adh_genre = $nouveau;
	}
	
	
	
	public function getAdh_date_naissance(){
		return $this->adh_date_naissance;
	}
	public function setAdh_date_naissance($nouveau){
		$this->adh_date_naissance = $nouveau;
	}
	
	
	
	public function getAdh_adresse_postale(){
		return $this->adh_adresse_postale;
	}
	public function setAdh_adresse_postale($nouveau){
		$this->adh_adresse_postale = $nouveau;
	}
	
	
	
	public function getAdh_adresse_complement(){
		return $this->adh_adresse_complement;
	}
	public function setAdh_adresse_complement($nouveau){
		$this->adh_adresse_complement = $nouveau;
	}
	
	
	
	public function getAdh_code_postal(){
		return $this->adh_code_postal;
	}
	public function setAdh_code_postal($nouveau){
		$this->adh_code_postal = $nouveau;
	}
	
	
	
	public function getAdh_ville(){
		return $this->adh_ville;
	}
	public function setAdh_ville($nouveau){
		$this->adh_ville = $nouveau;
	}
	
	
	
	public function getAdh_certificat_medical(){
		return $this->adh_certificat_medical;
	}
	public function setAdh_certificat_medical($nouveau){
		$this->adh_certificat_medical = $nouveau;
	}
	
	
	
	public function getAdh_licence(){
		return $this->adh_licence;
	}
	public function setAdh_licence($nouveau){
		$this->adh_licence = $nouveau;
	}
	
	
	
	public function getAdh_licence_numero(){
		return $this->adh_licence_numero;
	}
	public function setAdh_licence_numero($nouveau){
		$this->adh_licence_numero = $nouveau;
	}
	
	
	
	public function getAdh_famille(){
		return $this->adh_famille;
	}
	public function setAdh_famille($nouveau){
		$this->adh_famille = $nouveau;
	}
	
	
	
	public function getAdh_position(){
		return $this->adh_position;
	}
	public function setAdh_position($nouveau){
		$this->adh_position = $nouveau;
	}
}

?>