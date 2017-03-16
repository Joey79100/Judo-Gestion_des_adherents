<div class='window'>

<?php
	// echo "<div class='debug'><pre>";
	// print_r($this->viewvar);
	// echo "</pre></div>";
	
	$modif = !is_null($this->adherent->getAdh_id());
	
	$action = $modif ? "Modifier" : "Ajouter";
	echo "<div class='title'>" . $action . " un adhérent : Saison " . $_SESSION['saison']['debut'] . " - " . $_SESSION['saison']['fin'] . "</div>";
	
	
	if(!$modif){
		echo "
		<p> Entrez les informations nécessaires à l'ajout du nouvel adhérent. </p>
		<p> S'il s'agit d'un ancien adhérent vous pouvez commencer à taper son nom puis sélectionner l'adhérent qui s'affiche à l'écran, le formulaire se chargera alors de se renseigner ses informations. </p>";
	}
	echo "<hr/>";
	
	if($modif){
		echo "<form method='post' class='form-ajout-modif-adherent' name='modifAdherent' id='modifAdherent' action='" . ADHERENT . "update'>
				<input type='hidden' name='id' value='" . $this->viewvar['adherent']['adh_id'] . "' / >";
	}else{
		echo "<form method='post' class='form-ajout-modif-adherent' name='ajoutAdherent' id='ajoutAdherent' action='" . ADHERENT . "create'>";
	}
	
	
	echo "
		<fieldset>
			<legend>Identité</legend>
			
			<div class='form-ligne'>
				<div class='form-tiers-1'>
					<label for='nom' class='libelle'>Nom</label>
					<input id='nom' name='nom' id='nom' type='text' placeholder=\"Nom de l'adhérent\" required";
	
					if($modif){
						echo " value = '" . $this->viewvar['adherent']['adh_nom']. "' disabled";
					}
					
	echo "			/>
				</div>
				
				<div class='form-tiers-2'>
					<label for='prenom' class='libelle'>Prénom</label>
					<input name='prenom' id='prenom' type='text' placeholder=\"Prénom de l'adhérent\" required";
	
					if($modif){
						echo " value = '" . $this->viewvar['adherent']['adh_prenom']. "' disabled";
					}
					
	echo "			/>
				</div>
				
				<div class='form-tiers-3'>
					<label for='famille' class='libelle'>Famille</label>
					<input name='famille' id='famille' type='text' placeholder='Famille' required ";
	
					if($modif){
						echo " value = '" . $this->viewvar['adherent']['adh_famille']['fam_libelle']. "' disabled";
					}
					
	echo "			/>
				</div>
			</div>";
	
			
			
	echo "	<div class='form-ligne'>
				<div class='form-tiers-1'>
					<label for='sexe' class='libelle'>Genre</label>
					
					<div class='radio-button'>
						<label for='genre_m'>
							Masculin
						</label>
						<input type='radio' name='genre' id='genre_m' value='M' required ";
	
					if($modif){
						echo " disabled";
						if($this->viewvar['adherent']['adh_genre'] == 'M'){
							echo " checked";
						}
					}
					
	echo "			/>
					</div>
					
					<div class='radio-button'>
						<label for='genre_f'>
							Féminin
						</label>
						<input type='radio' name='genre' id='genre_f' value='F' required ";
	
					if($modif){
						echo " disabled";
						if($this->viewvar['adherent']['adh_genre'] == 'F'){
							echo " checked";
						}
					}
					
	echo "			/>
					</div>
				</div>
				
				<div class='form-tiers-2'>
					<label for='date_naissance' class='libelle'>Date de naissance</label>
					<input type='date' name='date_naissance' id='date_naissance' class='date_picker' placeholder='Jour/Mois/Année' required autocomplete='off'";
	
					if($modif){
						echo " value = '" . date_toFR($this->viewvar['adherent']['adh_date_naissance']). "' disabled";
					}
					
	echo "			/>
				</div>
				
				<div class='form-tiers-3'>
					<label for='age' class='libelle'>Âge</label>
					<input type='text' name='age' id='age' placeholder='Entrez une date' disabled ";
					
					if($modif){
						echo "value ='" . calculerAge($this->viewvar['adherent']['adh_date_naissance']) . "' ";
					}
					
	echo "			/>
				</div>
			</div>
		</fieldset>
		
		";
		
		
		
		
	echo "	
		<fieldset>
			<legend>Coordonnées</legend>
			
			<div class='form-ligne'>
				<label class='libelle'>
					Adresse
				</label>
				<input name='adresse' id='adresse' type='text' placeholder='N° de rue et adresse complète' required ";
	
					if($modif){
						echo " value='" . $this->viewvar['adherent']['adh_adresse_postale'] . "' ";
					}
					
	echo "		/>
			</div>
			
			<div class='form-ligne'>
				<label class='libelle'>
					Complément d'adresse
				</label>
				<input name='adresse2' id='adresse2' type='text' placeholder='Immeuble, appartement, ou autre information supplémentaire'";
	
					if($modif){
						echo " value='" . $this->viewvar['adherent']['adh_adresse_complement'] . "' ";
					}
					
	echo "		/>
			</div>
			
			<div class='form-ligne'>
				<div class='form-gauche'>
					<label class='libelle'>Code postal</label>
					<input name='code_postal' id='code_postal' type='text' placeholder='Code postal' required ";
	
					if($modif){
						echo " value='" . $this->viewvar['adherent']['adh_code_postal'] . "' ";
					}
					
	echo "			/>
				</div>
				
				<div class='form-droite'>
					<label for='ville' class='libelle'>Ville</label>
					<input name='ville' id='ville' type='text' placeholder='Ville' required ";
	
					if($modif){
						echo " value='" . $this->viewvar['adherent']['adh_ville'] . "' ";
					}
					
	echo "		/>
				</div>
			</div>
		</fieldset>
		
		
		
		
		
		
		<fieldset id='contacts'>
			<legend>Contacts</legend>
			<div id='lesContacts'>
				<!-- Ici les divs pour chaque contact sont ajoutées/enlevées grâce à du javascript -->
				
				
			</div>
			<button type='button' id='addContact' onclick='ajouterContact()'>Ajouter</button>
		</fieldset>
		
		
		
		
		
		<fieldset>
			<legend>Inscription</legend>
			
			<div class='form-ligne'>
				<div class='form-tiers-1'>
					<input name='certificat_medical' id='certificat_medical' type='checkbox' />
					<label for='certificat_medical'>
						Certificat médical fourni
					</label>
					
					<br/>
					
					<input name='licence' id='licence' type='checkbox' />
					<label for='licence'>
						Licence
					</label>
					<input name='licence_numero' type='text' placeholder='Numéro de licence' ";
					
					
					// Le numéro de licence étant unique, on bloque sa modification si le membre en possède déjà une
					if($modif && isset($this->viewvar['adherent']['adh_licence_numero'])){
						echo "disabled value='" . $this->viewvar['adherent']['adh_licence_numero'] . "' ";
					}
					
	echo "			/>
				
				</div>
				
				
			
		
		
		
		
				
				<div class='form-tiers-2'>
					<label for='position' class='libelle'>Position</label>
					<select name='position' id='position' class='largeur-100'>";
					
					// Création de la liste des positions
					foreach($this->viewvar['position'] as $position){
						echo "<option value='" . $position['pos_id'] . "' ";
						
						if($modif && $position['pos_id'] == $this->viewvar['adherent']['adh_position']){
							echo "selected";
						}
						
						echo ">";
						echo ucfirst($position['pos_libelle']);
						echo "</option>";
					}
						
					echo "
					</select>
				
					<br/>
					
					<label for='cours' class='libelle'>Cours suivi</label>
					<select name='cours' id='cours' class='largeur-100'>";
					
					// Création de la liste des cours
					foreach($this->viewvar['cours'] as $cours){
						echo "<option value='" . $cours['cou_id'] . "' data-age='" . $cours['cou_age'] . "' ";
						
						if($modif && $cours['cou_id'] == $this->viewvar['suivre']['sui_cours']){				// TODO: Récupérer le cours auquel l'adhérent est inscrit
							echo "selected";
						}
						
						echo ">";
						echo ucfirst($cours['cou_libelle']);
						echo "</option>";
					}
					
					echo "
					</select>
				</div>
					
				
					
				<div class='form-tiers-3'>
					<label for='cours' class='libelle'>Ceinture</label>
					<select name='ceinture' id='ceinture' class='largeur-100'>";
						
						// Création de la liste des ceintures
						foreach($this->viewvar['ceinture'] as $ceinture){
							echo "<option value='" . $ceinture['cei_id'] . "' data-age ='" . $ceinture['cei_age_mini'] . "' ";
							
							if($modif && $ceinture['cei_id'] == $this->viewvar['passer']['pas_ceinture']){
								echo " selected";
							}
							
							echo ">";
							echo ucfirst($ceinture['cei_libelle']);
							echo "</option>";
						}
					
					echo "
					</select>
					
					<br/>
					
					<label for='date_passage_ceinture' class='libelle'>Date de passage :</label>
					<input type='date' name='date_passage_ceinture' id='date_passage_ceinture' class='date_picker' placeholder='Jour/Mois/Année' required autocomplete='off'";
					
					if($modif){
						echo " value='" . date_toFR($this->viewvar['passer']['pas_date']) . "' ";
					}else{
						$dateDuJour = new DateTime();
						echo " value='" .$dateDuJour->format('j/m/Y') . "' ";
					}
					
					echo "
					/>
				</div>
			</div>
		</fieldset>
		
		
		
		
		
		<div class='form-boutons'>
			<button type='reset'>Réinitialiser</button>
			<button type='submit'>" . $action . " l'adhérent</button>
		</div>
	</form>
</div>";











?>































<?php



	
	/**************************************************************************************************************************************************/
	/**************************************************************************************************************************************************/
	/**************************************************************************************************************************************************/
	/**************************************************************************************************************************************************/
	/**************************************************************************************************************************************************/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	 *	Ajout/suppression de contacts
	 */
	 
	 // D'abord, passage au javascript des tableaux (nécessaire pour pouvoir 
	 // afficher les types de contact et liens de parenté à chaque nouveau contact,
	 // ainsi que la liste complète des adhérents pour l'autocomplétion)
	// echo "	<script type='text/javascript'>
				// const LIEN_PARENTE = " . json_encode($this->viewvar['lien_parente']) . ";
				// const TYPE_CONTACT = " . json_encode($this->viewvar['type_contact']) . ";
			// </script>" ;
	
	// Puis appel du fichier contact.js
	echo "	<script type='text/javascript' src='" . JS . "adherent/ajout-modif/contact.js" . "'></script>" ;
	
	echo "	<script type='text/javascript' src='" . JS . "adherent/ajout-modif/submit.js" . "'></script>" ;
	
	
	
	
	
	
	
	
	/*
	 * Affichage des datepicker (pour les dates de naissance et de passage de ceinture)
	 */
	echo "	<script src= '" . JS . "datepicker/datepicker.js'></script>";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	 * Préparation des données puor l'autocomplétion pour #nom et #famille (si on n'est PAS sur une page de MODIFICATION)
	 */
	
	if(!$modif){
		// Préparation de l'envoi de la liste des adhérents au script
		foreach($this->viewvar['adherent'] as $unAdh){
			$lesAdherents[] = array(
				'id' => $unAdh['adh_id'],
				'label' => $unAdh['adh_nom'] . " " . $unAdh['adh_prenom'] . " - " . $unAdh['adh_famille']['fam_libelle'],
				'value' => $unAdh['adh_nom']
			);
		}
		
		
		// Préparation de l'envoi de la liste des familles au script
		foreach($this->viewvar['famille'] as $uneFam){
			$lesFamilles[] = array(
				'id' => $uneFam['fam_id'],
				'label' => $uneFam['fam_libelle'],
				'value' => $uneFam['fam_libelle']
			);
		}
		
		
		
		// Envoi des listes sous forme de constantes
		echo "	<script type='text/javascript'>
					const ADHERENTS = " . json_encode($lesAdherents) . ";
					const FAMILLES = " . json_encode($lesFamilles) . ";
				</script>" ;
				
	}
	
	




	
	/*
	 * Préparation des données puor l'autocomplétion pour contacts, cours, etc
	 */
	 
	// Préparation de l'envoi de la liste des liens de parenté au script
	foreach($this->viewvar['lien_parente'] as $unLien){
		$lesLiens[] = array(
			'id' => $unLien['lie_id'],
			'label' => ucfirst($unLien['lie_libelle']),
			'value' => ucfirst($unLien['lie_libelle'])
		);
	}
	
	
	// Préparation de l'envoi de la liste des types de contact au script
	foreach($this->viewvar['type_contact'] as $unType){
		$lesTypes[] = array(
			'id' => $unType['typ_id'],
			'label' => $unType['typ_libelle'],
			'value' => $unType['typ_libelle']
		);
	}
	
	
	// Préparation de l'envoi de la liste des cours au script (nécessaire pour les alertes concernant le respect de l'âge)
	foreach($this->viewvar['cours'] as $unCours){
		$lesCours[] = $unCours;
	}
	
	
	// Préparation de l'envoi de la liste des ceintures au script (nécessaire pour les alertes concernant le respect de l'âge)
	foreach($this->viewvar['ceinture'] as $uneCeinture){
		$lesCeintures[] = $uneCeinture;
	}


	
	
	
	
	
	
	
	/*
	 * Chargement du script d'autocomplétion
	 */
	 
	// Envoi des listes sous forme de constantes
	echo "	<script type='text/javascript'>
				const LIENS_PARENTE = " . json_encode($lesLiens) . ";
				const TYPES_CONTACT = " . json_encode($lesTypes) . ";
				const COURS = " . json_encode($lesCours) . ";
				const CEINTURES = " . json_encode($lesCeintures) . ";
			</script>" ;

	// Appel du script d'autocomplétion
	echo "	<script src= '" . JS . "adherent/ajout-modif/autocomp.js'></script>";


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	 * Si on est sur la modification d'un adhérent, alors on affiche chaque contact
	 */
	
	echo "<script>";
	if($modif){
		foreach($this->viewvar['contact'] as $unContact){
			echo "ajouterContact(" . json_encode($unContact) . ");";
		}
	}else{
		echo "ajouterContact(null);";
	}
	echo "</script>";
	
	
	
	
	
	
	
	
	
	
	
	
	// Appel du script de vérification du formulaire
	// echo "	<script src= '" . JS . "adherent/ajout-modif/verif.js'></script>";
	
	
	
	
?>
