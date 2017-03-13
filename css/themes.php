<?php
	header('content-type: text/css');
	
	/*
	 * Ici on ne s'occupe pas directement de styliser le site, mais plutôt de charger toutes les feuilles de style du thème actuellement définit
	 * dans le fichier de configuration du thème.
	 */
	
	
	
	/*
	 * Lecture du fichier de configuration et récupération du thème actuel.
	 * Si le fichier de configuration est absent ou bien qu'aucun thème n'est défini, alors on choisira un thème par défaut.
	 */
	$chemin_conf_site = "../conf/settings.ini";
	
	if(file_exists($chemin_conf_site)){
		$conf_site = parse_ini_file($chemin_conf_site, true);		// Lecture du fichier de configuration
		
		if(isset($conf_site['theme']['theme'])){
			$theme = $conf_site['theme']['theme'];						// Récupération du thème choisi dans le fichier de configuration
		}else{
			require_once('../functions.php');							// Importation du fichier 'functions.php' car il possède la fonction ini_write
			$theme = 'material';
			ini_write($chemin_conf_site, 'theme', 'theme', $theme);		// Et écriture de ce thème dans le fichier de conf
		}
	}else{
		require_once('../functions.php');							// Importation du fichier 'functions.php' car il possède la fonction ini_write
		$theme = 'material';										// Sinon, affichage du thème par défaut
		ini_write($chemin_conf_site, 'theme', 'theme', $theme);		// Et écriture de ce thème dans le fichier de conf
	}
	
	
	
	
	
	
	/*
	 * Ouverture du répertoire du thème choisi
	 */
	$repertoireTheme = $theme . '/*';				// Définit le répertoire où trouver les fichiers du thème
	$lesFichiers = glob($repertoireTheme);			// Récupère dans un tableau tous les fichiers présents dans le dossier
	
	
	
	
	/*
	 * Récupération des premiers fichiers : le fichier [nom-du-theme].php pour lire les variables utilisées, puis le fichier des polices
	 */
	if(file_exists($theme . '/' . $theme . '.php')){
		require_once($theme . '/' . $theme . '.php');		// Fichier CSS principal à être chargé AVANT TOUS LES AUTRES FICHIERS CSS
	}
	
	if(file_exists($theme . '/fonts.css')){
		require_once($theme . '/fonts.css');				// Fichier CSS des polices à être chargé AVANT TOUS LES AUTRES FICHIERS CSS
	}
	
	
	
	
	/*
	 * Lecture et inclusion de tous les fichiers CSS du dossier du thème
	 */
	foreach($lesFichiers as $unFichier){  
		if (preg_match('/.css/i', $unFichier)){
			require_once($unFichier);
		}
	}
	
	// $_SESSION['theme_actuel'] = 
?>
