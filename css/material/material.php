<?php
	/***************************************************************************************************/
	/* Fichier material.php */
	/***************************************************************************************************/
	header('content-type: text/css');

	
	
	/*******************************************************************************************************************************************************/
	/*  Lecture des paramètres du fichier de configuration
	 *  et récupération du fichier des couleurs de référence
	 */
	$theme_settings = parse_ini_file("theme_settings.ini", true);				// Lecture des paramètres du thème : paramètres utilisateur & couleurs de référence
	
	
	
	
	if(isset($theme_settings['settings']['material_theme'])){
		$col_theme = $theme_settings['settings']['material_theme'];			// Couleur du thème (sombre ou clair)
	}else{
		$col_theme = 'theme_light';
	}
	
	
	
	if(isset($theme_settings['settings']['material_color_primary'])){
		$col_primary = $theme_settings['settings']['material_color_primary'];	// Couleur primaire (arrière-plans colorés)
	}else{
		$col_primary = 'color_bluegrey';
	}
	
	
	
	if(isset($theme_settings['settings']['material_color_accent'])){
		$col_accent = $theme_settings['settings']['material_color_accent'];	// Couleur d'accentuation (éléments mis en valeur)
	}else{
		$col_accent = 'color_teal';
	}
	
	
	
	
	
	/*******************************************************************************************************************************************************/
	/*  Définition des couleurs en fonction des paramètres
	 */
	
	
	if($col_theme == 'theme_dark'){
		// Couleurs générales
		$col['background'][1]	= "#000000";
		$col['background'][2]	= "#212121";
		$col['background'][3]	= "#303030";
		$col['background'][4]	= "#424242";
		$col['background'][5]	= "#767676";
		$col['primary']['BRIGHT']	= $theme_settings[$col_primary][300];
		$col['primary']['NORMAL']	= $theme_settings[$col_primary][600];
		$col['primary']['DARK']		= $theme_settings[$col_primary][800];
		$col['accent']['BRIGHT']	= $theme_settings[$col_accent][200];
		$col['accent']['NORMAL']	= $theme_settings[$col_accent][500];
		$col['accent']['DARK']		= $theme_settings[$col_accent][700];
		
		// Couleurs du texte
		$col['text']['main']			= "#ffffff";
		$col['text']['grey']			= " rgba(255,255,255, 0.4)";
		$col['text']['primary']			= "#ffffff";
		$col['text']['primary_grey']	= " rgba(255,255,255, 0.4)";
		
		// Couleurs - autres
		$col['grey']		= " rgba(255,255,255, 0.3)";
		$col['separator']	= " rgba(255,255,255, 0.1)";
		$col['shadow']		= " rgba(0,0,0, 0.75)";
	}else{
		if($col_theme == 'theme_bluegrey'){
			// Couleurs générales
			$col['background'][1]	= "#1f292e";
			$col['background'][2]	= "#263238";
			$col['background'][3]	= "#37474f";
			$col['background'][4]	= "#455a64";
			$col['background'][5]	= "#656e73";
			$col['primary']['BRIGHT']	= $theme_settings[$col_primary][300];
			$col['primary']['NORMAL']	= $theme_settings[$col_primary][500];
			$col['primary']['DARK']		= $theme_settings[$col_primary][800];
			$col['accent']['BRIGHT'] 	= $theme_settings[$col_accent][200];
			$col['accent']['NORMAL'] 	= $theme_settings[$col_accent][400];
			$col['accent']['DARK']   	= $theme_settings[$col_accent][700];
			
			// Couleurs du texte
			$col['text']['main']			= "#ffffff";
			$col['text']['grey']			= " rgba(255,255,255, 0.4)";
			$col['text']['primary']			= "#ffffff";
			$col['text']['primary_grey']	= " rgba(255,255,255, 0.4)";
			
			// Couleurs - autres
			$col['grey']		= " rgba(255,255,255, 0.3)";
			$col['separator']	= " rgba(255,255,255, 0.1)";
			$col['shadow']		= " rgba(0,0,0, 0.6)";
		}else{
			// Couleurs générales
			$col['background'][1]	= "#c5c5c5";
			$col['background'][2]	= "#e5e5e5";
			$col['background'][3]	= "#f5f5f5";
			$col['background'][4]	= "#fafafa";
			$col['background'][5]	= "#ffffff";
			$col['primary']['BRIGHT']	= $theme_settings[$col_primary][300];
			$col['primary']['NORMAL']	= $theme_settings[$col_primary][600];
			$col['primary']['DARK']		= $theme_settings[$col_primary][800];
			$col['accent']['BRIGHT']	= $theme_settings[$col_accent][100];
			$col['accent']['NORMAL']	= $theme_settings[$col_accent][500];
			$col['accent']['DARK']		= $theme_settings[$col_accent][700];
			
			// Couleurs du texte
			$col['text']['main']			= "#000000";
			$col['text']['grey']			= " rgba(0,0,0, 0.4)";
			$col['text']['primary']			= "#ffffff";
			$col['text']['primary_grey']	= " rgba(0,0,0, 0.4)";
			
			// Couleurs - autres
			$col['grey']		= " rgba(0,0,0, 0.3)";
			$col['separator']	= " rgba(0,0,0, 0.1)";
			$col['shadow']		= " rgba(0,0,0, 0.5)";
		}
	}

	
	$shadow['SMALLER']	= "box-shadow: 0px 1px 2px 0px" . $col['shadow'] . ";";
	$shadow['SMALL']	= "box-shadow: 0px 2px 4px 0px" . $col['shadow'] . ";";
	$shadow['SMALL_u']	= "box-shadow: 0px 2px 4px 0px" . $col['shadow'] . ",
						               0px 1px 0px 0px" . $col['accent']['NORMAL'] . ";";
	$shadow['NORMAL']	= "box-shadow: 0px 6px 8px 0px" . $col['shadow'] . ";";
	$shadow['BIG']		= "box-shadow: 0px 12px 16px 0px" . $col['shadow'] . ";";
	$shadow['BIGGER']	= "box-shadow: 0px 20px 32px 0px" . $col['shadow'] . ";";
	
	$border['size'] = "0.13em";
	
	$size['height']['menu']['sous-menu'] = "2.6em";
	$size['height']['nombre_elements'] = "4";
?>


/***************************************************************************************************/
/* Fichier material.php */
/***************************************************************************************************/

