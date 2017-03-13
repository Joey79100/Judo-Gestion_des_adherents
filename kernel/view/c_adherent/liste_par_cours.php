<?php
	$debug = true;		// Affiche une colonne supplémentaires avec les données brutes de la base
	
	
	// echo "<div class='window' style='background:#ccf;'><h1>\$this->viewvar['inscription']</h1>";
	// echo "<pre> ";
	// print_r($this->viewvar['inscription']);
	// echo "</pre>";
	// echo "</div>";
	
	
	
	
	
	
	
	// echo "<div class='debug'><pre>";
	// print_r($this->viewvar['inscription']);
	// echo "</pre></div>";
	
	
	
	
	$nbCours = 0;
	$i = 0;
	$tailleTab = count($this->viewvar['inscription']);
	
	
	
	
	
	
	
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
	
	
	
	
	
	
	
	// echo "<div class='debug'> <pre>";
	// print_r($this->viewvar);
	// echo "</pre> </div>";
	
	
		
	
	
	
	
	
	
	while($i < $tailleTab){
		
		$cours_old = $this->viewvar['inscription'][$i]['sui_cours']['cou_id'];
		$cours     = $this->viewvar['inscription'][$i]['sui_cours']['cou_id'];
			
		$nbCours++;
		
		echo "<div class='window'>
			<span>
				<h1 class='div_cours_titre' id='div_cours_titre_" . $nbCours . "'>" . $this->viewvar['inscription'][$i]['sui_cours']['cou_libelle'] . "</h1>
				<button type='button' id='div_cours_" . $nbCours . "_button' class='boutonOuvertureCours'>-</button>
			</span>
			
			<div class='div_cours' id='div_cours_" . $nbCours . "'>
			
				<table class='liste_adherents'>	
				
					<tr>
						<th> FAMILLE </th>
						<th colspan=2> Contact </th>
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
						if($debug){
							echo "<th> SAI, ADH, COU </th>";
						}
					echo "</tr>
				";
			
			while($i < $tailleTab && $cours_old == $cours){
				echo "
					<tr>
						<td> " . strtoupper($this->viewvar['inscription'][$i]['sui_adherent']['adh_famille']['fam_libelle']) . " </td>
						<td> " . "T" . " </td>
						<td> " . "05.04.03.02.01" . " </td>
						<td> " . $this->viewvar['inscription'][$i]['sui_adherent']['adh_adresse_postale'] . " "
							   . $this->viewvar['inscription'][$i]['sui_adherent']['adh_code_postal'] . " " .  $this->viewvar['inscription'][$i]['sui_adherent']['adh_ville'] . " </td>
						<td> " . $this->viewvar['inscription'][$i]['sui_adherent']['adh_nom'] . " </td>
						<td> " . $this->viewvar['inscription'][$i]['sui_adherent']['adh_prenom'] . " </td>
						<td> " . ucfirst($this->viewvar['inscription'][$i]['sui_adherent']['adh_position']['pos_libelle']) . " </td>
						<td> " . $this->viewvar['inscription'][$i]['sui_adherent']['adh_date_naissance'] . " </td>
						<td> " . "42" . " </td>
						<td> " . $this->viewvar['inscription'][$i]['sui_adherent']['adh_genre'] . " </td>
						<td> " . "Rose" . " </td>
						<td> ";
						
						if($this->viewvar['inscription'][$i]['sui_adherent']['adh_certificat_medical']){
							echo "Oui";
						}else{
							echo "Non";
						}
						echo "</td>	<td>";
						if($this->viewvar['inscription'][$i]['sui_adherent']['adh_licence']){
							echo $this->viewvar['inscription'][$i]['sui_adherent']['adh_licence_numero'];
						}else{
							echo "N/A";
						}
						echo "
						</td>";
						
						if($debug){
							echo
							"<td> "
							. $this->viewvar['inscription'][$i]['sui_saison'] . ", "
							. $this->viewvar['inscription'][$i]['sui_adherent']['adh_id'] . ", "
							. $this->viewvar['inscription'][$i]['sui_cours']['cou_id'] . "
							</td>";
						}
						
						echo "
					</tr>
				";
				
				$cours = $this->viewvar['inscription'][$i]['sui_cours']['cou_id'];
				// echo '<br/>Le cours ' . $cours;
				
				$i++;		// Affichage de l'élément terminé : lecture du prochain adhérent
			}
			echo "</table>";
			
			
			/*
			 * Affichage des boutons : PASSER DES CEINTURES / FICHE DE RENSEIGNEMENT / FICHE DE PRESENCE
			 */
			echo "
				<div class='tableau-boutons'>
					<div class='tableau-bouton-gauche'>
						<form id='passer_ceintures_" . $cours_old . "' method=post style='display:none;' action='" . WEBROOT . "ceinture/passer'>
							<input type='hidden' name='cours'  value='" . $cours_old . "'>
						</form>
						<button type='submit' form='passer_ceintures_" . $cours_old . "' formaction='" . WEBROOT . "ceinture/passer'>Passer des ceintures</button>
					</div>
					
					<div class='tableau-bouton-droite'>
						<form id='fiche_renseignements_" . $cours_old . "' method=post style='display:none;'></form>
						<button type='button' form='fiche_renseignements_" . $cours_old . "'>Fiche de renseignements</button>
						
						<form id='fiche_presence_" . $cours_old . "' method=post style='display:none;'></form>
						<button type='button' form='fiche_presence_" . $cours_old . "'>Fiche de présence</button>
					</div>
				</div>
			</div>
		</div>";
	}
?>






<?php
	echo "
	<div class='window'>
		<h1>Statistiques</h1>
		Nombre de cours : " . $nbCours . "<br/>
		Nombre d'adhérents : " . $i . "<br/>
	</div>
	";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// Resource jQuery
	echo "	<script src='https://code.jquery.com/jquery-1.12.4.js'></script>";
	echo "	<script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>";
	
	
	// Ouverture / Fermeture de chaque cours
	echo "	<script src= '" . JS . "adherent/liste_par_cours/affichage_cours.js'></script>";
	
	
	// echo "
		// <script>
			// $('#div_cours_titre_1').click(function(){
				// if($(this).html() == '-'){
					// $(this).html('+');
				// }
				// else{
					// $(this).html('-');
				// }
				// $('#div_cours_1').slideToggle();
			// });
		// </script>
		// ";
		
		
?>
