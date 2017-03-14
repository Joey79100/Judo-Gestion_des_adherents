<?php
	require_once(APP."controller.php");
	class c_adherent extends Controller{
		
		protected $models;
		
		public function __construct(){
			// $this->models = array('adherent', 'famille', 'position');
			$this->models = array('adherent', 'ceinture', 'contact', 'cours', 'famille', 'inscrire', 'lien_parente', 'passer', 'position', 'saison', 'suivre', 'type_contact');
			parent::__construct($this->models);
		}
		
		
		
		
		
		public function index(){
			$this->render("index");
		}
		
		
		
		
		
		/*
		 * modifier()			Affiche la page d'ajout/modification vide afin de pouvoir ajouter un adhérent à la base, ainsi que les 
		 *						informations permettant de le contacter (un "contact"), et ses informations liées à l'inscription telles 
		 *						que le cours auquel il participe cette saison, sa ceinture, la date à laquelle il l'a acquise, etc
		 *						(vue identique à la fonction modifier())
		 */
		public function ajouter(){
			$this->set(array('famille' => $this->famille->find()));
			$this->set(array('lien_parente' => $this->lien_parente->find()));
			$this->set(array('type_contact' => $this->type_contact->find()));
			$this->set(array('position' => $this->position->find()));
			$this->set(array('cours' => $this->cours->find()));
			$this->set(array('ceinture' => $this->ceinture->find()));
			$this->set(array('adherent' => $this->adherent->find(null, "adh_nom, adh_prenom", null, array("position"), 2)));
			
			$this->render("ajout_modif");
		}
		
		
		
		
		
		/*
		 * create()				Appelé depuis la page d'ajout : récupère toutes les données adhérent du formulaire de la page d'ajout :
		 *						Identité, contacts, inscription, cours suivi, ceinture et dernière date de passage, et les insère dans
		 *						la base.
		 */
		public function create(){
			echo "<br/><b>c_adherent::create() -> \$_POST : </b>";
			var_dump($_POST);
			echo "<br/>";
			echo "<hr/>";
			
			// die("STOP");
			
			
			/***************************************************************************************************/
			
			/*
			 * Informations générales de l'adhérent
			 */
			 
			$this->adherent->setAdh_nom($_POST['nom']);
			$this->adherent->setAdh_prenom($_POST['prenom']);
			$this->adherent->setAdh_genre($_POST['genre']);
			$this->adherent->setAdh_date_naissance(date_toSQL($_POST['date_naissance']));
			
			$this->adherent->setAdh_adresse_postale($_POST['adresse']);
			$this->adherent->setAdh_adresse_complement($_POST['adresse2'] ?: null);
			$this->adherent->setAdh_code_postal($_POST['code_postal']);
			$this->adherent->setAdh_ville($_POST['ville']);
			
			$this->adherent->setAdh_certificat_medical(isset($_POST['certificat_medical']) ? true : false);
			$this->adherent->setAdh_licence(isset($_POST['licence']) ? true : false);
			$this->adherent->setAdh_licence_numero($_POST['licence_numero'] ?? null);
			
			echo "<br/><b>c_adherent::create() -> \$this->adherent : </b>";
			var_dump($this->adherent);
			// die();
			
			/***************************************************************************************************/
			
			/*
			 * Détermination de la position
			 */
			
			$this->adherent->setAdh_position($_POST['position']);
			
			
			/***************************************************************************************************/
			
			/*
			 * Vérification de l'existence de la famille, et sinon création d'une nouvelle
			 */
			 
			$nom_famille = $_POST['famille'];
			
			
			// Recherche de la famille dans la base
			$laFamille = $this->famille->find("fam_libelle = '" . $nom_famille . "'");
			
			// Si la famille existe pas, l'utiliser, sinon, la créer
			if($laFamille){
				$this->famille->setFam_id($laFamille[0]['fam_id']);
			}else{
				$this->famille->setFam_libelle($nom_famille);
				$this->famille->create();
			}
			
			
			// Récupération de l'ID de la famille
			$this->adherent->setAdh_famille($this->famille->getFam_id());
			
			
			/***************************************************************************************************/
			
			/*
			 * Création de l'adhérent
			 */
			
			$this->adherent->create();
			
			
			/***************************************************************************************************/
			
			/*
			 * Création des contacts
			 */
			
			// Recherche de toutes les données liées à un contact (on cherche tous les champs lien_contact_XX)
			foreach($_POST as $nomColonne => $valeurColonne){
				if(preg_match('/lien_contact/', $nomColonne)){
					// Elément lien_contact_XX trouvé : on récupère XX
					$int = filter_var($nomColonne, FILTER_SANITIZE_NUMBER_INT);
					
					$this->contact->setCon_lien_parente($this->getIdLienParente($_POST['lien_contact_' . $int]));
					$this->contact->setCon_type($_POST['type_contact_' . $int]);
					$this->contact->setCon_contact($_POST['data_contact_' . $int]);
					$this->contact->setCon_adherent($this->adherent->getAdh_id());
					
					$this->contact->create();
				}
			}
			
			
			
			/***************************************************************************************************/
			
			/*
			 * Inscription de l'adhérent pour la saison sélectionnée
			 */
			 
			$saison = $this->saison->find("sai_debut = " . $_SESSION['saison']['debut'] . " AND sai_fin = " . $_SESSION['saison']['fin']);
			
			
			$this->inscrire->setIns_saison($saison[0]['sai_id']);
			$this->inscrire->setIns_adherent($this->adherent->getAdh_id());
			
			$this->inscrire->create();
			
			
			/***************************************************************************************************/
			
			/*
			 * Affectation du membre à un cours pour la saison
			 */
			
			$this->suivre->setSui_saison($this->inscrire->getIns_saison());
			$this->suivre->setSui_adherent($this->inscrire->getIns_adherent());
			$this->suivre->setSui_cours($_POST['cours']);
			
			$this->suivre->create();
			
			
			/***************************************************************************************************/
			
			/*
			 * Affectation d'une ceinture et enregistrement de la date de passage
			 */
			 
			$this->passer->setPas_saison($this->inscrire->getIns_saison());
			$this->passer->setPas_adherent($this->inscrire->getIns_adherent());
			$this->passer->setPas_ceinture($_POST['ceinture']);
			$this->passer->setPas_date(date_toSQL($_POST['date_passage_ceinture']));
			
			$this->passer->create();
			
			
			/***************************************************************************************************/
		}
		
		
		
		
		
		/*
		 * modifier()			Affiche la page d'ajout/modification pré-remplie pour l'adhérent demandé
		 *						Page chargée automatiquement lors de la sélection de l'un des membres listés dans la liste
		 *						d'autocomplétion du champ Nom de la page d'ajout
		 *						(vue identique à la fonction ajouter())
		 *
		 * @param $adh_id		l'ID de l'adhérent à modifier - si non précisé, redirection vers la page d'ajout
		 */
		public function modifier($adh_id = null){
			if(!is_numeric($adh_id)){
				// Si on n'a pas un numéro dans l'URL on redirige vers Ajouter
				header("Location: " . ADHERENT . "ajouter");
			}else{
				$saison_id = $this->saison->find("sai_debut = " . $_SESSION['saison']['debut']. " AND sai_fin = " . $_SESSION['saison']['fin'])[0]['sai_id'];
				
				$this->set(array('lien_parente' => $this->lien_parente->find()));
				$this->set(array('type_contact' => $this->type_contact->find()));
				$this->set(array('position' => $this->position->find()));
				$this->set(array('cours' => $this->cours->find()));
				$this->set(array('ceinture' => $this->ceinture->find()));
				
				$this->adherent->setAdh_id($adh_id);
				$this->set(array('adherent' => $this->adherent->read(null, 2)));
				$this->set(array('contact' => $this->contact->find("con_adherent = " . $this->adherent->getAdh_id(), null, null, array('adherent'), 2)));
				$this->set(array('suivre' => $this->suivre->find("sui_adherent = " . $this->adherent->getAdh_id() . " AND sui_saison = " . $saison_id)[0]));
				$this->set(array('passer' => $this->passer->find("pas_adherent = " . $this->adherent->getAdh_id() . " AND pas_saison = " . $saison_id, "pas_date DESC", 1)[0]));
				
				$this->render("ajout_modif");
			}
		}
		
		
		
		
		
		/*
		 * update()				Appelé depuis la page de modification : récupère toutes les données adhérent du formulaire ayant été
		 *						modifiées et met ainsi à jour l'adhérent dans la base, ainsi que ses informations.
		 *						Les contacts ayant été chargés et n'étant plus présents lors de l'envoi du formulaire sont supprimés
		 *						de la base.
		 */
		public function update(){
			
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			
			
			
			/*
			 * Récupération de toutes les données du formulaire
			 */
			$this->adherent->setAdh_id($_POST['id']);
			
			$this->adherent->setAdh_adresse_postale($_POST['adresse']);
			$this->adherent->setAdh_adresse_complement($_POST['adresse2'] ?? "");
			$this->adherent->setAdh_code_postal($_POST['code_postal']);
			$this->adherent->setAdh_ville($_POST['ville']);
			
			$this->adherent->setAdh_position($_POST['position']);
			$this->adherent->setAdh_certificat_medical(isset($_POST['certificat_medical']) ? true : false);
			$this->adherent->setAdh_licence(isset($_POST['licence']) ? true : false);
			$this->adherent->setAdh_licence_numero($_POST['licence_numero'] ?? null);
			
			echo "<hr/>";
			
			// Mise à jour de l'adhérent
			$this->adherent->update();
			
			
			
			
			echo "<hr/>";
			
			
			
			// Ajout dans la base des contacts qui ont été ajoutés dans le formulaire
			if(isset($_POST['contactsAAjouter'])){
				$contactsAAjouter = explode("," , $_POST['contactsAAjouter']);
				
				foreach($contactsAAjouter as $unContact){
					echo "<br/> Création du contact " . $unContact . "...<br/>";
					
					$this->contact->setCon_contact($_POST['data_contact_' . $unContact]);
					$this->contact->setCon_lien_parente($this->getIdLienParente($_POST['lien_contact_' . $unContact]));
					$this->contact->setCon_type($_POST['type_contact_' . $unContact]);
					$this->contact->setCon_adherent($this->adherent->getAdh_id());
					
					// echo "<pre>";
					// print_r($this->contact);
					// echo "</pre>";
					
					$this->contact->create();
				}
			}
			
			echo "<hr/>";
			
			
			// Modification dans la base des contacts qui ont été modifiés dans le formulaire
			if(isset($_POST['contactsAModifier'])){
				$contactsAModifier = explode("," , $_POST['contactsAModifier']);
				
				foreach($contactsAModifier as $unContact){
					echo "<br/> Mise à jour du contact " . $unContact . "...<br/>";
					
					$this->contact->setCon_id($unContact);
					
					$this->contact->setCon_contact($_POST['data_contact_' . $unContact]);
					$this->contact->setCon_lien_parente($this->getIdLienParente($_POST['lien_contact_' . $unContact]));
					$this->contact->setCon_type($_POST['type_contact_' . $unContact]);
					$this->contact->setCon_adherent($this->adherent->getAdh_id());
					
					
					$this->contact->update();
				}
			}
			
			echo "<hr/>";
			
			
			// Suppression dans la base des contacts qui ont été supprimés dans le formulaire
			if(isset($_POST['contactsASupprimer'])){
				$contactsASupprimer = explode("," , $_POST['contactsASupprimer']);
				
				foreach($contactsASupprimer as $unContact){
					echo "<br/> Suppression du contact " . $unContact . "<br/>";
					$this->contact->setCon_id($unContact);
					
					$this->contact->delete();
				}
			}
			
			echo "<hr/>";
			
			
			
			// exit(header("Location: " . ADHERENT . 'modifier/' . $_POST['id']));
		}
		
		
		
		
		
		/*
		 * liste_par_cours()	Affiche, pour chaque cours enregistré, une liste des adhérents y participant pendant la saison
		 *						sélectionnée à l'accueil
		 */
		public function liste_par_cours(){
			
			
			
			/*
			 * Récupération de la saison à afficher. Si l'utilisateur a cliqué sur "Retourner vers le présent"
			 * (possible uniquement si la session affichée est différente de la saison actuelle) alors on récupère la saison actuelle.
			 */
			
			if(isset($_POST['retournerVersLePresent'])){
				$_SESSION['saison']['debut'] = getSaisonActuelle()[0];
				$_SESSION['saison']['fin'] = getSaisonActuelle()[1];
			}
			
			$saisonDebut = $_SESSION['saison']['debut'];
			$saisonFin = $_SESSION['saison']['fin'];
			
			$saisonId = $this->saison->find('sai_debut = ' . $saisonDebut . ' AND sai_fin = ' . $saisonFin)[0]['sai_id'];
			
			
			
			
			
			
			
			
			
			
			// Récupération des adhérents ordonnés par cours pour la saison choisie
			
			
			$nbmax = null;
			// $nbmax = 15;
			if($nbmax != null){
				echo "<div class='debug'> NOTE : Seulement " . $nbmax . " enregistrements ont été chargés. </div>";
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			$lesAdherentsClassesParCours = array();
			$tousLesCours = $this->cours->find();
			
			
			// Pour chaque cours existant...
			foreach($tousLesCours as $unCours){
				
				
				// Chercher tous les gens qui y sont inscrit (enfin, leur numéro)
				$inscritsAuCours = $this->suivre->find('sui_saison = ' . $saisonId . ' AND sui_cours = ' . $unCours['cou_id']);
				
				
				// Pour chaque inscrit à ce cours...
				foreach($inscritsAuCours as $unInscrit){
					
					// Trouver toutes les infos propres à l'adhérent
					$adherentsDunCours[$unInscrit['sui_adherent']] = $this->adherent->read($unInscrit['sui_adherent']);
					
					
					
					// Trouver la dernière ceinture de l'adhérent...
					$lePassageDeCeinture = $this->passer->find('pas_saison = ' . $saisonId . 'AND pas_adherent = ' . $unInscrit['sui_adherent'], 'pas_date DESC', 1)[0];
					
					// ...et la lui mettre
					$adherentsDunCours[$unInscrit['sui_adherent']]['adh_ceinture'] = $lePassageDeCeinture['cei_libelle'] ?? null;		//  MARCHE PAS  /!\
					
					
				}
				
				$lesAdherentsClassesParCours[$unCours['cou_id']] = $adherentsDunCours;
				$adherentsDunCours = null;
			}
			
			
			echo "<br/>";
			echo "\$lesAdherentsClassesParCours : <br/><pre>";
			print_r($lesAdherentsClassesParCours);
			echo "</pre>";
			
			
			
			
			
			
			
			
			
			
			
			die();
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			$this->set(array('suivre' => $this->suivre->find('sui_saison = ' . $saisonId, 'sui_cours, sui_adherent', $nbmax, null, -1)));
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			/*
			 * Récupération de tous les passages de ceintures (afin de déterminer quelle ceinture porte actuellement chacun des adhérents)
			 * Quand il y a plusieurs ceintures pour le même adhérent, seul le dernier passage est retenu (pour la saison demandée en tous cas).
			 *
			 * Pour chaque adhérent (récupérés via leur inscription dans un cours puisqu'on les affiche classés par cours), on récupère la ceinture qui va bien.
			 */
			
			foreach($this->viewvar['suivre'] as $uneLigne){
				// Recherche du dernier passage de ceinture en date l'adhérent
				$uneLigne = $this->passer->find('pas_saison = ' . $saisonId . ' AND pas_adherent = ' . $uneLigne['sui_adherent']['adh_id'], 'pas_date DESC', 1, array('saison', 'adherent'), 1)[0];
				
				// Si l'adhérent a bien une ceinture (théoriquement il en aura toujours en circonstances réelles, mais pas avec les données test pas forcément)
				// Alors on ajoute la ceinture à l'index correspondant à l'ID de l'adhérent pour retrouver facilement la bonne ceinture quand on l'affichera dans la vue
				if($uneLigne){
					$lesCeintures[$uneLigne['pas_adherent']] = $uneLigne['pas_ceinture'];
				}
			}
			// Une fois fini on enregistre les ceintures dans le viewvar, comme d'hab
			
			$this->set(array('ceinture_adherent' => $lesCeintures));
			
			// echo "<br/><div class='debug'><pre>";
			// print_r($lesCeintures);
			// echo "</pre></div>";
			
			// die();
			
			// echo "<br/><div class='debug'><pre>";
			// print_r($this->viewvar['passer']);
			// echo "</pre></div>";
			
			// die();
			
			$this->render("liste_par_cours");
		}
	
	
	
	
			
		/*
		 * getIdLienParente - Récupère l'ID du lien de parenté passé en paramètre en fonction de son libellé, et s'il n'existe pas, le crée.
		 *
		 * return		l'id du lien de parenté correspondant au libellé fourni en paramètre
		 */
		private function getIdLienParente($libelle){
			
			// On cherche si ce lien de parenté existe (sans tiret, sans majuscule)
			
			$libelle = str_replace("-", " ", strtolower($libelle));
			$lienParente_base = $this->lien_parente->find("lie_libelle = '" . $libelle . "' ")[0] ?? null;
			
			if($lienParente_base){
				// S'il existe, alors on récupère son ID
				
				$idLien = $lienParente_base['lie_id'];
			}else{
				// S'il n'existe pas, alors on le crée
				
				$this->lien_parente->setLie_libelle($libelle);
				$this->lien_parente->create();
				
				$idLien = $this->lien_parente->getLie_id();
			}
			
			return $idLien;
		}
	}
?>