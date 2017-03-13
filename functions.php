<?php
	
	function erreur($exception, $type = null, $infosAdditionnelles = array()){
		require_once(CONTROLLER."erreur.php");
		$erreur = new erreur();
		$erreur->balancer($exception, $type, $infosAdditionnelles);
	}
	
		
		
	/*	
	 *	Source : http://stackoverflow.com/questions/3472836/how-to-update-an-ini-file-with-php
	 *	@author mtoloo
	 */
	function ini_write($config_file, $section, $key, $value) {
		if(file_exists($config_file)){
			$config_data = parse_ini_file($config_file, true);
		}
		
		$config_data[$section][$key] = $value;
		
		$new_content = '';
		foreach ($config_data as $section => $section_content) {
			$section_content = array_map(function($value, $key) {
				return "$key = $value";
			}, array_values($section_content), array_keys($section_content));
			$section_content = implode("\n", $section_content);
			$new_content .= "[$section]\n$section_content\n\n";
		}
		file_put_contents($config_file, $new_content);
	}
	
	
	/*
	 *	
	 */
	function getSaisonActuelle($moisDebutSaison = 8, $jourDebutSaison = 31){
		// Si on est dans la seconde moité de l'année
		if(strftime('%m') >= $moisDebutSaison && strftime('%d') >= $jourDebutSaison){
			// Première moitié de l'année
			$debut = strftime('%Y');
			$fin = strftime('%Y') + 1;
		}else{
			// Deuxième moitié de l'année
			$debut = strftime('%Y') - 1;
			$fin = strftime('%Y');
		}
		
		return array($debut, $fin);
	}
	
	
	/*
	 *	
	 */
	function dateConvert($dateSource, $formatSource = 'j/m/Y',  $formatDestination = 'Y-m-d'){
		
		$dateTime = DateTime::createFromFormat($formatSource, $dateSource);
		
		return $dateTime->format($formatDestination);
	}
	
	
	
	/*
	 *	
	 */
	function date_toSQL($dateSource){
		return dateConvert($dateSource, $formatSource = 'd/m/Y',  $formatDestination = 'Y-m-d');
	}
	
	
	
	/*
	 *	
	 */
	function date_toFR($dateSource){
		return dateConvert($dateSource, $formatSource = 'Y-m-d',  $formatDestination = 'd/m/Y');
	}
	
	
?>