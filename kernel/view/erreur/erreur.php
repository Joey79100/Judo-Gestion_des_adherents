<div class='window'>
	<h1>
	<?php
		echo "Erreur (" . strtoupper($this->viewvar['erreur']['type']) . ")";
	?>
	</h1>
	
	<?php 
		echo "<div class='detail-erreur'> <table>   <th colspan='2'>Détail de l'erreur</th>";
			foreach($this->viewvar['erreur']['infos'] as $typeInfo => $uneInfo){
				echo "<tr> <td>" . ucfirst($typeInfo) . "</td> <td>";
				if($this->viewvar['erreur']['type'] == 'sql'){
					echo utf8_encode($uneInfo);
				}else{
					echo $uneInfo;
				}
				echo "</td> </tr>";
			}
			
		echo "</table> </div>";
		
		
		
		// TODO : Ajouter une ligne dans la conf pour activer/désactiver le détail des erreurs
		if($debug_options = true){
			echo "<br/><br/>";
			echo "<div class='detail-erreur'> <table class='xdebug'>
					<th colspan='5'>Informations supplémentaires</th>";
			echo $this->viewvar['erreur']['debug'];
			echo "</table> </div>";
		}
	?>
	
	<div class="form-boutons">
		<form id='go_accueil' action='<?php echo WEBROOT; ?>' style='display:none;'></form>
		<button type="submit" form='go_accueil'>Retour à l'accueil</button>
		
		<?php
			if($this->viewvar['erreur']['type'] == 'sql'){
				echo "
					<form id='go_dbsettings' action='" . WEBROOT . "settings/database' style='display:none;'></form>
					<button type='submit' form='go_dbsettings'>Paramètres base de données</button>
				";
			}
		?>
	</div>
</div>