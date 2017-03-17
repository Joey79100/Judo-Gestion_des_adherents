
<div class='window'>
	<div class='title'></div>
	
	
	<form id='formsaison' method='post' style='display:none;'></form>
		<label for='saison' form='formsaison'>Saison :</label>
		<select name='saison' form='formsaison'>
		<?php
			/*
			 *	Affichage des différentes options (toutes les saisons disponibles dans la base)
			 */
			foreach($this->viewvar['saison'] as $uneSaison){
				echo "<option value='" . $uneSaison['sai_id'] . "'";
				
				if($uneSaison['sai_debut'] == $_SESSION['saison']['id']){			// Si l'option correspond à la saison choisie
					echo " selected";												// Alors afficher cette option par défaut
				}
				
				echo ">" . $uneSaison['sai_debut'] . " - " . $uneSaison['sai_fin'] . "</option>";
			}
			
		?>
		</select>
		<button type='submit' form='formsaison'>Changer</button>
	</form>
	
	<hr/>
	
	<?php
	
	
	var_dump($_SESSION);
	
	
	
	
	
		echo "
			<table>
				<tr>
					<th> Adhérent </th>
					<th> Ceinture </th>
					<th> Informations </th>
					<th> Ajouter à la saison </th>
				</tr>
			";
			
			foreach($this->viewvar['adherent'] as $unAdherent){
				echo "<tr>
				
					<td>
						<a href='modifier/" . $unAdherent['adh_id'] . "'>
						" . $unAdherent['adh_nom'] . " " . $unAdherent['adh_prenom'] . "
						</a>
					</td>";
				
				echo "
					<td>
						Champ Ceinture avec date
					</td>";
				
				echo "
					<td>
						Cases Certificat médical & Licence
					</td>";
				
				echo "
					<td>
						<form id='ajoutSaisonAdherent_" . $unAdherent['adh_id'] . "'style='display:none'></form>
						<button type='button' form='ajoutSaisonAdherent_" . $unAdherent['adh_id'] . "' class='boutonAjout'>Ajouter</button>
					</td>
				</tr>";
			}
			echo "</table>";
	?>
</div>