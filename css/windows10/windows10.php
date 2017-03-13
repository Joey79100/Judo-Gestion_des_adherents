<?php
	/***************************************************************************************************/
	/* Fichier classic.php */
	/***************************************************************************************************/
	header('content-type: text/css');

	
	
	/*******************************************************************************************************************************************************/
	/*  Lecture des paramètres du fichier de configuration
	 *  et récupération du fichier des couleurs de référence
	 */
	$theme_settings = parse_ini_file("theme_settings.ini", true);		// Lecture des paramètres du thème : paramètres utilisateur & couleurs de référence
	
	
	
	if(isset($theme_settings['settings']['windows_theme'])){
		$col_theme = $theme_settings['settings']['windows_theme'];			// Couleur du thème (sombre ou clair)
	}else{
		$col_theme = 'theme_win32';
	}
	
	
	
	
	/*******************************************************************************************************************************************************/
	/*  Définition des couleurs en fonction des paramètres
	 */
	
	
	
	
	/* COULEURS */
	
	$col = array();
	
	
	// Couleurs générales
	if($col_theme == 'theme_metro_light'){
		
		$col['wallpaper']				= "#396ba5";
		$col['background']['dark']		= "#ece9d8";
		$col['background']['normal']	= "#f0eee1";
		$col['background']['white']		= "#ffffff";
		$col['background']['selected']	= "#316ac5";
		
		
		$col['window']['active']	= "linear-gradient(to bottom,
		
			#0e59ec 0%, #4197fd 5%, #0d55e1 20%, #0e56e8 55%, #116bfc 80%, #116bfc 85%, #1061fa 95%, #0b44cd 98%
			
			)";
		
		$col['title']['active']		= "#ffffff";
		$col['shadow']['title']		= "rgba(0,0,0, 0.5)";
		$col['shadow']['menu']		= "rgba(0,0,0, 0.5)";
		
		$col['border']['window']['dark']		= "#0831d9";
		$col['border']['window']['normal']		= "#0850d8";
		$col['border']['window']['light']		= "#186cf2";
		
		$col['border']['button']['disabled']	= "#c9c7ba";
		$col['border']['button']['enabled']		= "#003c74";
		$col['border']['input']					= "#7f9db9";
		
		$col['separator']['grey']	= "#cdceb0";
		$col['separator']['white']	= "#ffffff";
		
	}else{
		if($col_theme == 'theme_metro_dark'){
		
		$col['wallpaper']				= "#575667";
		$col['background']['dark']		= "#ece9d8";
		$col['background']['normal']	= "#e0dfe4";
		$col['background']['white']		= "#ffffff";
		$col['background']['selected']	= "#575667";
		
		
		$col['window']['active']	= "linear-gradient(to bottom,
		
			#65657d 0%, #ffffff 7%, #a3a2bd 17%, #ffffff 90%, #767691 100%
			
			)";
		
		$col['title']['active']		= "#000000";
		$col['shadow']['title']		= "rgba(128,128,128, 0.5)";
		$col['shadow']['menu']		= "rgba(0,0,0, 0.5)";
		
		$col['border']['window']['dark']		= "#666472";
		$col['border']['window']['normal']		= "#fdfbff";
		$col['border']['window']['light']		= "#65626d";
		
		$col['border']['button']['disabled']	= "#c9c7ba";
		$col['border']['button']['enabled']		= "#003c74";
		$col['border']['input']					= "#7e9cb8";
		
		$col['separator']['grey']	= "#cdceb0";
		$col['separator']['white']	= "#ffffff";
		
		}else{
		
		$col['wallpaper']				= "#9dacbd";
		$col['background']['dark']		= "#ece9d8";
		$col['background']['normal']	= "#ece9d8";
		$col['background']['white']		= "#ffffff";
		$col['background']['selected']	= "#737d34";
		
		
		$col['window']['active']	= "linear-gradient(to bottom,
		
			#8fa36a 0%, #e9f3c8 8%, #aab883 18%, #abb984 40%, #bccc90 65%, #cdd99e 85%, #b8c78d 95%, #8fa36a 100%
			
			)";
		
		$col['title']['active']		= "#ffffff";
		$col['shadow']['title']		= "rgba(46,57,6, 1.0)";
		$col['shadow']['menu']		= "rgba(0,0,0, 0.5)";
		
		$col['border']['window']['dark']		= "#5e764e";
		$col['border']['window']['normal']		= "#a4b07c";
		$col['border']['window']['light']		= "#aebe86";
		
		$col['border']['button']['disabled']	= "#c9c7ba";
		$col['border']['button']['enabled']		= "#003c74";
		$col['border']['input']					= "#7f9db9";
		
		$col['separator']['grey']	= "#cdceb0";
		$col['separator']['white']	= "#ffffff";
		
		}
	}
	
	
	
	// Couleurs du texte
	$col['text']['black']		= "#000000";
	$col['text']['grey']		= "#aca899";
	$col['text']['white']		= "#ffffff";
	
	
	
	$font['family']['main']		= "Tahoma";
	$font['size']['main']		= "11px";
	$font['family']['title']	= "Trebuchet MS";
	$font['size']['title']		= "13px";
	
	
	
	
	
	
	
	
	/* BORDURES */
	$border = array();
	
	
	/* Utilisés pour les fenêtres et la barre des tâches */
	
	$border['window'] = "
		border-style:solid;
		border-radius: 3px 3px 0px 0px;
		
		border-width:0px;
		
		box-shadow: 0px 0px 0px 1px " . $col['border']['window']['light'] . ",
					0px 0px 0px 2px " . $col['border']['window']['normal'] . ",
					0px 0px 0px 3px " . $col['border']['window']['dark'] . ";
	";
	
	$border['taskbar'] = "
		border-style:solid;
		border-width:1px 0;
	";
	
	
	
	
	
	
	/* Utilisés pour les boutons */
	
	$border['button']['disabled'] = "
		border-style: solid;
		border-radius: 3px;
		border-width: 1px;
		border-color: " . $col['border']['button']['disabled'] . ";
	";
	
	$border['button']['off'] = "
		border-style: solid;
		border-radius: 3px;
		border-width: 1px;
		border-color: " . $col['border']['button']['enabled'] . ";
		
		
		box-shadow: inset	0px -6px 8px -10px " . "#000000" . ",
					inset	0px 6px 8px 4px " . "#ffffff" . ",
					inset 	0px 0px 3px -1px " . $col['border']['window']['light'] . ";
	";
	
	$border['button']['on'] = "
		box-shadow: inset	0px -6px 8px 0px " . "#ffffff" . ",
					inset	0px 6px 8px -8px " . "#000000" . ",
					inset 0px 0px 2px 0px " . $col['border']['window']['light'] . ";
	";
	
	
	
	
	
	
	$border['input'] = "
		border-style:solid;
		border-width:1px;
		border-color: " . $col['border']['input'] . ";
	";
	
	
	
	
	
	
	
	
	
	$border['th'] = "
		border-bottom-style:solid;
		border-bottom-width:1px;
		border-bottom-color: " . $col['separator']['grey'] . ";
		
		box-shadow: inset	0px -3px 1px -2px " . $col['separator']['grey'] . ",
							5px 0px 0px -4px " . $col['separator']['grey'] . ",
							6px 0px 0px -4px " . $col['separator']['white'] . ";
		
	";
	
	
	
	
	
	
	$border['menu'] = "
		border-width: 2px;
		border-style: solid;
		border-color: " . $col['background']['white'] . ";
		
		box-shadow: 0px 0px 0px 1px " . $col['separator']['grey'] . ",
					4px 4px 2px -1px " . $col['shadow']['menu'] . ";
	";
	
	
?>


/***************************************************************************************************/
/* Fichier classic.php */
/***************************************************************************************************/

