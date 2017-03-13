	<?php
		// Récupération du fichier de conf du site pour déterminer le thème actuel
		// S'il n'existe pas alors on le crée
		$chemin_conf = CONF . "/settings.ini";
		if(file_exists($chemin_conf)){
			$conf  = parse_ini_file($chemin_conf, true);
		}else{
			ini_write($chemin_conf, 'theme', 'theme', 'material');
			$conf  = parse_ini_file($chemin_conf, true);
		}
		$theme_actuel = $conf ['theme']['theme'];
		
		// Récupération des sous-dossiers du répertoire pour lister tous les thèmes disponibles
		$repertoireThemes = ROOT . "css/*";
		$lesThemes = glob($repertoireThemes, GLOB_ONLYDIR);
	?>
	
	
	
	<div class='window'>
		<h1>Changer l'apparence de l'application</h1>
		<hr/>
		<br/>
		<form method='post' action='theme'>
				
			<select name='theme_choisi'>
			<?php
			
				/*
				 * Pour chaque thème disponible, on affiche une option afin de pouvoir les sélectionner
				 */
				 
				foreach($lesThemes as $unDossierTheme){
					$theme_id = basename ($unDossierTheme);					// L'id du thème est le nom de son dossier
					
					
					/*
					 * Récupération du nom 'français' du thème dans son fichier de conf s'il existe
					 */
					
					$chemin_conf_theme = $unDossierTheme . "/theme_settings.ini";
					if(file_exists($chemin_conf_theme)){
						$conf_theme = parse_ini_file($chemin_conf_theme, true);
		
						if(isset($conf_theme['settings']['theme_name'])){
							$theme_nom = $conf_theme['settings']['theme_name'];		// Libellé du thème (pris dans le ini du thème)
						}
					}else{
						$theme_nom = $theme_id;
					}
					
					
					/*
					 * Affichage des options disponibles
					 */
					 
					echo "<option value='" . $theme_id . "' ";
					if ($theme_id == $theme_actuel){
						// Si l'ption correspond au thème appliqué, alors cette option sera sélectionnée par défaut
						echo "selected ";
					}
					echo ">";
					
					echo " '" . $theme_nom . "' - css/" . $theme_id;
					echo "</option>";
				}
			?>
			</select>
			
			<button type='submit'>Valider</button>
		</form>
	</div>
	<br/>

	

<?php

	/*
	 * Affichage des paramètres spécifiques du thème actuel si ledit thème possède un fichier theme_settings.php (page des réglages spécifiques du thème)
	 */
	
	$conf_theme = ROOT . "css/" . $theme_actuel . "/theme_settings.php";
	
	if (file_exists($conf_theme)){			// Si le thème possède une page de configuration
		echo "
			<div class='window'>
			<h1>Paramètres du thème '" . $theme_actuel . "'</h1>";
			
			require_once ($conf_theme);		// Alors l'inclure dans la page

		echo "</div>";
	}
?>




