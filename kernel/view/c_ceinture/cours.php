<?php
	$debug = false;
	$debug = true;
	// echo "<div class='window' style='background:#ccf;'><h1>\$this->viewvar['inscription']</h1>";
	// echo "<pre> ";
	// print_r($this->viewvar['inscription']);
	// echo "</pre>";
	// echo "</div>";
	
	$nbCours = 0;
	$i = 0;
	$tailleTab = count($this->viewvar['inscription']);
	

	
	
	// echo "<pre>";
	// print_r($this->viewvar);
	// echo "</pre>";
	
	
	
	
	
	
	// /*
	
	
	while($i < $tailleTab){
		$nbCours++;
		
		$cours_old = $this->viewvar['inscription'][$i]['sui_cours']['cou_id'];
		$cours     = $this->viewvar['inscription'][$i]['sui_cours']['cou_id'];
		
		echo "<div class='window'>
			<h1>" . $this->viewvar['inscription'][$i]['sui_cours']['cou_libelle'] . "</h1>
		
			<table class='liste_adherents'>	
			
				<tr>
					<th></th>
					<th> Nom </th>
					<th> Prénom </th>
					<th> Né(e) le </th>
					<th> AGE </th>
					<th> MF </th>
					<th> Ceinture </th>";
					if($debug){
						echo "<th> DEBUG </th>";
					}
				echo "</tr>
			";
			
		while($i < $tailleTab && $cours_old == $cours){
			// echo '<br/>Le cours ' . $cours;
			
			
			echo "
				<tr>
					<td> <input type='checkbox' id='" . $this->viewvar['inscription'][$i]['sui_adherent']['adh_id'] . "'/> </td>
					<td> " . $this->viewvar['inscription'][$i]['sui_adherent']['adh_nom'] . " </td>
					<td> " . $this->viewvar['inscription'][$i]['sui_adherent']['adh_prenom'] . " </td>";
					
					
					$date = new Datetime($this->viewvar['inscription'][$i]['sui_adherent']['adh_date_naissance'], new DateTimeZone('Europe/Paris'));
					
					
					echo "<td> " . $date->format('d f Y') . " </td>
					<td> " . "42" . " </td>
					<td> " . $this->viewvar['inscription'][$i]['sui_adherent']['adh_genre'] . " </td>
					<td> " . "Rose" . " </td>";
					if($debug){
						echo
						"<td> "
						. $this->viewvar['inscription'][$i]['sui_saison']['sai_id'] . ", "
						. $this->viewvar['inscription'][$i]['sui_adherent']['adh_id'] . ", "
						. $this->viewvar['inscription'][$i]['sui_cours']['cou_id'] . "
						</td>";
					}
					
					echo "
				</tr>
			";
			
			$cours = $this->viewvar['inscription'][$i]['sui_cours']['cou_id'];
			$i++;
		}
		echo "</table>";
		
		echo "
			<div class='tableau-boutons'>
				<div class='tableau-bouton-gauche'>
					<form name='passer_ceintures_" . $cours_old . "' method=post style='display:none;'></form>
					<button type='button' form='passer_ceintures_" . $cours_old . "'>Monter d'un niveau</button>
				</div>
			</div>
		
		</div>";
	}
	// */
	
	
	
	// echo "<div class='window'> Saison " . $_SESSION['saison']['debut'] . " - " . $_SESSION['saison']['fin'] . "</div>";
?>


