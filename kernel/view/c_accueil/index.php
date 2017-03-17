<div class='window'>
	<div class='title'>Travailler sur la saison</div>
	<form id='formsaison' method='post' style='display:none;'></form>
		<label for='saison' form='formsaison'>Saison :</label>
		<select name='saison' form='formsaison'>
		<?php
			/*
			 *	Affichage des différentes options (toutes les saisons disponibles dans la base)
			 */
			foreach($this->viewvar['saisons'] as $uneSaison){
				echo "<option value='" . $uneSaison['sai_id'] . "'";
				
				if(isset($_SESSION['saison']['debut'])){								// Si on a déjà choisi une saison
					if($uneSaison['sai_debut'] == $_SESSION['saison']['debut']){			// Si l'option correspond à la saison choisie
						echo " selected";												// Alors afficher cette option par défaut
					}
				}else{																	// Sinon (si on n'a pas choisi nous-même une saison)
					if($uneSaison['sai_debut'] == getSaisonActuelle()[0]){					// Si l'option correspond à la saison actuelle
						echo " selected";												// Alors afficher cette option par défaut
					}
				}
				echo ">" . $uneSaison['sai_debut'] . " - " . $uneSaison['sai_fin'] . "</option>";
			}
			
		?>
		</select>
		<button type='submit' form='formsaison'>Changer</button>
	</form>
</div>

<div class='window'>
	<div class='title'>Opérations courantes</div>
	
	Page de test de l'interface avec formulaire : <a href='accueil/testinterface_form'>Cliquer ici</a>
	<br/>
	Page de test de l'interface avec tableau : <a href='accueil/testinterface_table'>Cliquer ici</a>
	<br/>
	Ces pages sont accessibles depuis le menu <strong>Autres</strong> dans le menu de navigation en haut de cette page.
	Et, oui, il y a du texte pour rien dire puisqu'il faut bien donner l'impression d'un vrai site, donc avec des choses écrites,
	même si là ça a aucun sens. Potager.
</div>
