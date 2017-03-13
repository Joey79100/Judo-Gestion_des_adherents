<?php
	/***************************************************************************************************/
	/* Fichier classic.php */
	/***************************************************************************************************/
	header('content-type: text/css');

	
	
	/*******************************************************************************************************************************************************/
	/*  Lecture des paramètres du fichier de configuration
	 *  et récupération du fichier des couleurs de référence
	 */
	$theme_settings = parse_ini_file("theme_settings.ini", true);					// Lecture des paramètres du thème : paramètres utilisateur & couleurs de référence
	
	
	
	
	if(isset($theme_settings['settings']['windows_version'])){
		$windows_2000 = $theme_settings['settings']['windows_version'] == "version_2000";	// Variation du thème (Est-ce Windows 2000)
		// echo "Windows 200000000000";
	}else{
		$windows_2000 = false;																	// Thème par défaut : 9x
		// echo "Windows 988888888888888";
	}
	
	
	
	// if(isset($theme_settings['tsettings']['classic_color_primary'])){
		// $col_primary = 'color_' . $theme_settings['settings']['classic_color_primary'];	// Couleur primaire (arrière-plans colorés)
	// }else{
		// $col_primary = 'color_' . 'teal';
	// }
	
	
	
	// if(isset($theme_settings['theme_settings']['classic_color_accent'])){
		// $col_accent = 'color_' . $theme_settings['settings']['classic_color_accent'];	// Couleur d'accentuation (éléments mis en valeur)
	// }else{
		// $col_accent = 'color_' . 'deeporange';
	// }
	
	
	
	
	
	/*******************************************************************************************************************************************************/
	/*  Définition des couleurs en fonction des paramètres
	 */
	
	
	
	
	/* COULEURS */
	
	$col = array();
	
	
	// Couleurs générales
	if($windows_2000){
		
		// Windows 2000
		
		$col['wallpaper']				= "#396ba5";
		$col['background']['normal']	= "#d6d3ce";
		$col['background']['light']		= "#d6d3ce";
		$col['background']['white']		= "#ffffff";
		$col['background']['selected']	= "#000080";
		
		$col['window']['active'] = "linear-gradient(to right, #0a246a, #a6caf0)";
		
		$col['border']['black']		= "#424142";
		$col['border']['dark']		= "#848284";
		$col['border']['grey']		= "#d6d3ce";
		$col['border']['light']		= "#d6d3ce";
		$col['border']['white']		= "#ffffff";
		
		$font['family']['main']		= "Tahoma";
		$font['size']['main']		= "11px";
		
	}else{
		
		// Windows 9x
		
		$col['wallpaper']				= "#008080";
		$col['background']['normal']	= "#c0c0c0";
		$col['background']['light']		= "#dfdfdf";
		$col['background']['white']		= "#ffffff";
		$col['background']['selected']	= "#000080";
		
		$col['window']['active'] = "linear-gradient(to right, #000080, #1084d0)";
		
		$col['border']['black']		= "#000000";
		$col['border']['dark']		= "#7f7f7f";
		$col['border']['grey']		= "#bfbfbf";
		$col['border']['light']		= "#dfdfdf";
		$col['border']['white']		= "#ffffff";
		
		$font['family']['main']		= "MS Sans Serif";
		$font['size']['main']		= "11px";
		
	}
	
	
	// Couleurs du texte
	$col['text']['black']		= "#000000";
	$col['text']['grey']		= "#808080";
	$col['text']['white']		= "#ffffff";
	
	
	
		
	
		$col['border']['darkred']	= "#880000";
		$col['border']['red']		= "#ff0000";
		$col['border']['yellow']	= "#ffff00";
		$col['border']['orange']	= "#ff8800";
	
	
	
	
	
	
	
	
	/* BORDURES */
	
	
	$border = array();
	
	
	$border['big']['out'] = "
		border-style:solid;
		border-width:1px;
		box-shadow: 1px 1px 0px 0px " . $col['border']['black'] . ",			/* Bottom right */
					-1px 2px 0px -1px " . $col['border']['black'] . ",			/* Bottom left */
					2px -1px 0px -1px " . $col['border']['black'] . ",			/* Top right */
					0px 0px 0px 1px " . $col['border']['grey'] . ";				/* All around */
					
		border-left-color: " . $col['border']['white'] . ";
		border-top-color: " . $col['border']['white'] . ";
		border-right-color: " . $col['border']['dark'] . ";
		border-bottom-color: " . $col['border']['dark'] . ";
	";
	/* Utilisée pour les boutons */
	
	$border['button']['off'] = "
		border-style:solid;
		border-width:1px;
		box-shadow: 1px 1px 0px 0px " . $col['border']['black'] . ",			/* Bottom right */
					-1px 2px 0px -1px " . $col['border']['black'] . ",			/* Bottom left */
					2px -1px 0px -1px " . $col['border']['black'] . ",			/* Top right */
					0px 0px 0px 1px " . $col['border']['grey'] . ",				/* All around */
				inset 1px 1px 0px 0px " . $col['border']['light'] . ";		/* inside */
					
		border-left-color: " . $col['border']['white'] . ";
		border-top-color: " . $col['border']['white'] . ";
		border-right-color: " . $col['border']['dark'] . ";
		border-bottom-color: " . $col['border']['dark'] . ";
	";
	/* Utilisée pour les boutons */
	
	
	
	
	$border['taskbar'] = "
		border-style:solid;
		border-width:1px 0;
		
		box-shadow: 1px 1px 0px 0px " . $col['border']['black'] . ",			/* Bottom right */
					-1px 2px 0px -1px " . $col['border']['black'] . ",			/* Bottom left */
					2px -1px 0px -1px " . $col['border']['black'] . ",			/* Top right */
					0px 0px 0px 1px " . $col['border']['grey'] . ";				/* All around */
					
		border-left-color: " . $col['border']['white'] . ";
		border-top-color: " . $col['border']['white'] . ";
		border-right-color: " . $col['border']['dark'] . ";
		border-bottom-color: " . $col['border']['dark'] . ";
	";
	
	
	
	
	
	
	
	
	
	
	
	
	$border['big']['in'] = "
		border-style:solid;
		border-width:1px;
		box-shadow: 
					1px 0px 0px 0px " . $col['border']['white'] . ",			/* Right border */
					-1px -1px 0px 0px " . $col['border']['dark'] . ",			/* Around: top & left */
					1px 1px 0px 0px " . $col['border']['white'] . ",			/* Bottom */
					0px 1px 0px 0px " . $col['border']['white'] . ",			/* Bottom left corner correction */
					0px 0px 0px 1px " . $col['border']['dark'] . ";			/* Bottom right corner */
					
		border-left-color: " . $col['border']['black'] . ";
		border-top-color: " . $col['border']['black'] . ";
		border-right-color: " . $col['border']['grey'] . ";
		border-bottom-color: " . $col['border']['grey'] . ";
	";
	/* Utilisée pour les boutons enfoncés */
	
	
	
	
	
	
	
	
	
?>


/***************************************************************************************************/
/* Fichier classic.php */
/***************************************************************************************************/

