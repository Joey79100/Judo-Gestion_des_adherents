<?php
	echo "<a href='" . WEBROOT . "'>". APPNAME ."</a> : ";
	
	if(empty($_SESSION['saison']['debut'])){
		$_SESSION['saison']['debut'] = getSaisonActuelle()[0];
		$_SESSION['saison']['fin'] = getSaisonActuelle()[1];
	}
	echo "Saison " . $_SESSION['saison']['debut'] . " - " . $_SESSION['saison']['fin'];
	
?>