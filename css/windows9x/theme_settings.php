<?php
	/***************************************************************************************************/
	/* Page de configuration du thème windows9x */
	/***************************************************************************************************/
	
	$fichierConf = "css/windows9x/theme_settings.ini";
	
	// define("COLOR", '/color_/i');	// Nom des couleurs dans le fichier de conf (color_blabla)
	define("VERSION", '/version_/i');	// Nom des versions dans le fichier de conf (version_blabla)
	
	// Si on vient de choisir de nouveaux paramètres, les entrer dans le fichier de conf
	if(isset($_POST['version'])){
		ini_write($fichierConf, 'settings', 'windows_version', $_POST['version']);
		// ini_write($fichierConf, 'settings', 'material_color_primary', $_POST['material_color_primary']);
		// ini_write($fichierConf, 'settings', 'material_color_accent', $_POST['material_color_accent']);
	}
	
	// Lecture des paramètres actuels
	$parametres = parse_ini_file($fichierConf, true);
?>

<form name='theme_settings' method='post'>
	<label for='version'>Version :</label>
	<select name='version'>
		<?php
			foreach($parametres as $uneVersion => $proprietesVersion){
				if(preg_match(VERSION, $uneVersion)){
					echo "<option value='" . $uneVersion . "' ";
					if($uneVersion == $parametres['settings']['windows_version']){
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