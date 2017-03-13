<?php
	/***************************************************************************************************/
	/* Page de configuration du thème windows9x */
	/***************************************************************************************************/
	
	$fichierConf = "css/windowsxp/theme_settings.ini";
	
	// define("COLOR", '/color_/i');	// Nom des couleurs dans le fichier de conf (color_blabla)
	define("THEME", '/theme_/i');	// Nom des versions dans le fichier de conf (version_blabla)
	
	// Si on vient de choisir de nouveaux paramètres, les entrer dans le fichier de conf
	if(isset($_POST['theme_xp'])){
		ini_write($fichierConf, 'settings', 'xp_theme', $_POST['theme_xp']);
	}
	
	// Lecture des paramètres actuels
	$parametres = parse_ini_file($fichierConf, true);
?>

<form name='theme_settings' method='post'>
	<label for='theme_xp'>Thème :</label>
	<select name='theme_xp'>
		<?php
			foreach($parametres as $uneVersion => $proprietesVersion){
				if(preg_match(THEME, $uneVersion)){
					echo "<option value='" . $uneVersion . "' ";
					if($uneVersion == $parametres['settings']['xp_theme']){
						echo "selected";
					}
					echo ">" . $proprietesVersion['name'] . "</option>";
				}
			}
		?>
	</select>
	
	<div class='form-boutons'>
		<button type='submit'>Choisir</button>
	</div>
<form>