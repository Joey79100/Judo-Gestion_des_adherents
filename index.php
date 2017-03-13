<?php
	// phpinfo();die;
	
	setlocale(LC_ALL, 'fr_FR');
	
	session_start();
	
	
	define('WEBROOT',	str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
	define('ROOT',		str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
	define("CONF",			   ROOT	. 'conf/');
	define("CSS",			WEBROOT	. 'css/');
	define("JS",			WEBROOT	. 'js/');
	define("IMG",			   ROOT	. 'img/');
	
	define("APP",			   ROOT	. 'kernel/');
	define("CONTROLLER",	   ROOT	. 'kernel/controller/');
	define("MODEL", 	       ROOT	. 'kernel/model/');
	define("VIEW", 			   ROOT	. 'kernel/view/');
	define("LAYOUT",		   ROOT	. 'kernel/view/layout/');
	
	define("ACCUEIL",		WEBROOT	. 'accueil/');
	define("SETTINGS",		WEBROOT	. 'settings/');
	
	define("ADHERENT",		WEBROOT	. 'adherent/');
	define("CEINTURE",		WEBROOT	. 'ceinture/');
	
	define("APPNAME",		'Judo - Gestion des adhérents');
	
	
	require_once('functions.php');
	
	
	/**
	*	Lecture du premier paramètre de l'URL pour savoir sur quelle appli rediriger
	**/
	
	if(empty($_GET)){
		// Pas de paramètres : renvoi vers l'acceuil
		$controller = 'accueil';
		$param = array();
	}else{
		// Il y a des paramètres : les lire pour déterminer quelle appli afficher
		$param = explode('/', $_GET['p']);
		$controller = $param[0];
	}
	
	
	/**
	*	Lecture du second paramètre de l'URL pour déterminer l'action
	**/
	
	if(!empty($param[1])){		// Il y a des paramètres : lire le premier paramètre pour déterminer l'action
		$action = $param[1];
	}else{						// Pas de paramètres : action par défaut
		$action = 'index';
	}
	
	
	
	
	
	/**
	*	Vérifier si l'URL est correcte
	**/
	$nom_controller = "c_".$controller;
	
	try{
		
		if(file_exists(CONTROLLER . $controller . '.php')){
			require_once(CONTROLLER . $controller . '.php');
		}else{
			throw new Exception("Aucun fichier n'a été trouvé pour la classe demandée. Vérifier l'URL.");
		}
		
		
		if(class_exists($nom_controller)){
			$controller = new $nom_controller();
		}else{
			throw new Exception("La classe demandée est introuvable. Vérifier si le fichier censé la contenir n'est pas vide ou erroné.");
		}
		
		
		if(method_exists($controller, $action)){
			unset($param[0]);
			unset($param[1]);
			
			call_user_func_array(array($controller,$action), $param);
		}else{
			throw new Exception("La méthode demandée est introuvable dans la classe spécifiée. Vérifier l'URL.");
		}
		
	} catch (Exception $e) {
		if(is_object($controller)){
			$controller = get_class($controller);
		}
		
		erreur($e, 'php', array("Méthode" => $controller . "::" . $action . "()"));
		die();
	}
	
	
?>