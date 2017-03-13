<?php
	/***************************************************************************************************/
	/* Page de configuration du thème material */
	/***************************************************************************************************/
	
	$fichierConf = "css/material/theme_settings.ini";
	
	define("COLOR", '/color_/i');	// Nom des couleurs dans le fichier de conf (color_blabla)
	define("THEME", '/theme_/i');	// Nom des thèmes dans le fichier de conf (theme_blabla)
	
	// Si on vient de choisir de nouveaux paramètres, les entrer dans le fichier de conf
	if(isset($_POST['material_theme']) && isset($_POST['material_color_primary']) && isset($_POST['material_color_accent'])){
		ini_write($fichierConf, 'settings', 'material_theme', $_POST['material_theme']);
		ini_write($fichierConf, 'settings', 'material_color_primary', $_POST['material_color_primary']);
		ini_write($fichierConf, 'settings', 'material_color_accent', $_POST['material_color_accent']);
	}
	
	// Lecture des paramètres actuels
	$lesCouleurs = parse_ini_file($fichierConf, true);
?>
<form name='theme_settings' method='post'>
	<div class='form-ligne'>
		<label for='material_theme'>Thème :</label>
		<select name='material_theme'>
			<?php
				foreach($lesCouleurs as $unTheme => $proprietesTheme){
					if(preg_match(THEME, $unTheme)){
						echo "<option value='" . $unTheme . "' ";
						if($unTheme == $lesCouleurs['settings']['material_theme']){
							echo "selected";
						}
						echo ">" . $proprietesTheme['name'] . "</option>";
					}
				}
			?>
		</select>
	</div>
	
	
	<div class='form-ligne'>
		<div class='form-gauche'>
			<label for='material_color_primary'>Couleur principale :</label>
			<select name='material_color_primary'>
			
			<?php
				foreach($lesCouleurs as $uneCouleur => $proprietesCouleur){
					if(preg_match(COLOR, $uneCouleur)){
						echo "<option value='" . $uneCouleur . "' ";
						if($uneCouleur == $lesCouleurs['settings']['material_color_primary']){
							echo "selected";
						}
						echo ">" . $proprietesCouleur['name'] . "</option>";
					}
				}
			?>
			
			</select>
		</div>
		
		
		<div class='form-droite'>
			<label for='material_color_accent'>Couleur d'accentuation :</label>
			<select name='material_color_accent'>
			
			<?php
				foreach($lesCouleurs as $uneCouleur => $proprietesCouleur){
					if(preg_match(COLOR, $uneCouleur)){
						echo "<option value='" . $uneCouleur . "' ";
						if($uneCouleur == $lesCouleurs['settings']['material_color_accent']){
							echo "selected";
						}
						echo ">" . $proprietesCouleur['name'] . "</option>";
					}
				}
			?>
			</select>
		</div>
	</div>
	

	
	
	<div class='form-boutons'>
		<button type='submit'>Choisir</button>
	</div>
<form>


