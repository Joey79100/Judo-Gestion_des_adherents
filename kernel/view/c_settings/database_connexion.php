<?php
	// Récupération du fichier de conf du site pour déterminer le thème actuel
	$chemin_conf = CONF . "/settings.ini";
	if(file_exists($chemin_conf)){
		$conf  = parse_ini_file($chemin_conf, true);
	}
?>
<div class='window'>
	<h1>Connexion réussie</h1>
	
	<p style='text-align:center;'>La connexion a la base de données a réussi.</p>
	
	<div class="form-boutons">
		<form id='go_accueil' action='<?php echo WEBROOT; ?>' style='display:none;'></form>
		<button type="submit" form='go_accueil'>Retour à l'accueil</button>
	</div>
</div>
<br/>

<script> setTimeout(function(){
  window.location = " <?php echo WEBROOT; ?> ";
}, 1250);
</script>