<?php
	
	
	
	
	
	/*
	 * Si la saison affichée est différente de la session actuelle, on en avertit l'utilisateur
	 */
	 
	if($_SESSION['saison']['debut'] != getSaisonActuelle()[0]){
		echo "
			<div class='window'>
				<h1> Note </h1>
				Vous consultez la liste des adhérents de la saison " . $_SESSION['saison']['debut'] . " - " . $_SESSION['saison']['fin'] . ".<br/><br/>
				
				<div class='form-boutons'>
					<form id='retourPresent' method='post' style='display:none'>
						<input type='hidden' name='retournerVersLePresent' value='bla' />
					</form>
					<button type='submit' form='retourPresent'>Retour vers le présent</button>
				</div>
				
			</div>";
	}
	
	
	
	
	
	
	
	
	
	
	$nbCours = 0;
	$nbAdherents = 0;
	
	// Pour chaque cours, une fenêtre
	
	foreach($this->viewvar['lesAdherentsTries'] as $unCours){
		
		
		echo "<div class='window'>
			<span>
				<h1 class='div_cours_titre' id='div_cours_titre_" . $unCours['cou_id'] . "'>" . $unCours['cou_libelle'] . "</h1>
				<button type='button' id='div_cours_" . $unCours['cou_id'] . "_button' class='boutonOuvertureCours'>-</button>
			</span>
			
			<div class='div_cours' id='div_cours_" . $unCours['cou_id'] . "'>
			
				<table class='liste_adherents'>	
				
					<tr>
						<th> FAMILLE </th>
						<th> Contact </th>
						<th> Adresse </th>
						<th> Nom </th>
						<th> Prénom </th>
						<th> Position </th>
						<th> Né(e) le </th>
						<th> AGE </th>
						<th> MF </th>
						<th> Ceinture </th>
						<th> CM </th>
						<th> Licence </th>";
					echo "</tr>
				";
			
			
			
			/*
			 * Affichage de tous les adhérents du cours
			 */
			
			
			foreach($unCours['lesAdherents'] as $unAdherent){
				echo
					"<tr id='adherent_" . $unAdherent['adh_id'] . "' >" .
						"<td> " . strtoupper($unAdherent['adh_famille']['fam_libelle']) . " </td>";
					
					
						// Affichage des contacts
						echo "<td style='text-align:center;width:100%'> <table class='tableau-interne'>";
						
						if($unAdherent['adh_contacts']){			// Condition juste pour le cas où l'adhérent n'a pas de contact... cas qui n'arrivera pas avec des vraies données
							
							foreach($unAdherent['adh_contacts'] as $unContact){
								$idLienContact = $unContact['con_lien_parente'];
								$idTypeContact = $unContact['con_type'];
								
								echo
									"<tr>" .
										"<td style='width:35%'>" . ucfirst($this->viewvar['lien_parente'][$idLienContact]['lie_libelle'] ) . "</td>" .
										"<td style='width:20%'>" . $this->viewvar['type_contact'][$idTypeContact]['typ_libelle'] . "</td>" .
										"<td style='width:45%'>" . $unContact['con_contact'] . "</td>" .
									"</tr>";
							}
						}
						
						
						echo "</table> </td>";
				
				echo "		
						<td style='text-align:left;'> "
							. $unAdherent['adh_adresse_postale'] . "<br/>"
							. $unAdherent['adh_code_postal'] . " "
							.  $unAdherent['adh_ville'] . "
						</td>
						
						<td> " . $unAdherent['adh_nom'] . " </td>
						<td> " . $unAdherent['adh_prenom'] . " </td>
						<td> " . ucfirst($unAdherent['adh_position']['pos_libelle']) . " </td>
						<td> " . date_ToFR($unAdherent['adh_date_naissance']) . " </td>
						<td> " . "TODO..." . " </td>
						<td> " . $unAdherent['adh_genre'] . " </td>
						<td> ";

				$idAdherent = $unAdherent['adh_id'];
				echo ucfirst($unAdherent['adh_ceinture']['cei_libelle'] ?? "N/A");		// Afficher la ceinture s'il y a, sinon 'N/A'
				
				echo	" </td>
						<td> " . ($unAdherent['adh_certificat_medical'] ? "Oui" : "Non") . " </td>
						<td> " . ($unAdherent['adh_licence'] ? $unAdherent['adh_licence_numero'] : "N/A") .
						" </td>";
						
						echo "
					</tr>
				";
				
				// $cours = $this->viewvar['suivre'][$i]['sui_cours']['cou_id'];
				// echo '<br/>Le cours ' . $cours;
				
				
				// $i++;		// Affichage de l'élément terminé : lecture du prochain adhérent
			}
			echo "</table>";
			
			
			
			
			
			
			/*
			 * Affichage des boutons : PASSER DES CEINTURES / FICHE DE RENSEIGNEMENT / FICHE DE PRESENCE
			 */
			echo "
				<div class='tableau-boutons'>
					<div class='tableau-bouton-gauche'>
						<form id='passer_ceintures_" . $unCours['cou_id'] . "' method=post style='display:none;' action='" . WEBROOT . "ceinture/passer'>
							<input type='hidden' name='cours'  value='" . $unCours['cou_id'] . "'>
						</form>
						<button type='submit' form='passer_ceintures_" . $unCours['cou_id'] . "' formaction='" . WEBROOT . "ceinture/passer'>Passer des ceintures</button>
					</div>
					
					<div class='tableau-bouton-droite'>
						<form id='fiche_renseignements_" . $unCours['cou_id'] . "' method=post style='display:none;'></form>
						<button type='button' form='fiche_renseignements_" . $unCours['cou_id'] . "'>Fiche de renseignements</button>
						
						<form id='fiche_presence_" . $unCours['cou_id'] . "' method=post style='display:none;'></form>
						<button type='button' form='fiche_presence_" . $unCours['cou_id'] . "'>Fiche de présence</button>
					</div>
				</div>
			</div>
		</div>";
	}
?>






<?php
	// echo "
		// <div class='window'>
			// <h1>Statistiques</h1>
			// Nombre de cours : " . $nbCours . "<br/>
			// Nombre d'adhérents : " . $i . "<br/>
		// </div>
	// ";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
	// Ouverture / Fermeture de chaque cours
	echo "	<script src= '" . JS . "adherent/liste_par_cours/affichage_cours.js'></script>";
	
		
		
?>
