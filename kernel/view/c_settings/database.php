<?php
	// Récupération du fichier de conf du site pour déterminer le thème actuel
	$chemin_conf = CONF . "/settings.ini";
	if(file_exists($chemin_conf)){
		$conf  = parse_ini_file($chemin_conf, true);
	}
?>
<div class='window'>
	<div class='title'>Paramètres de la base de données</div>
	<form method='post' action='database_connexion'>
		<fieldset>
			<legend>Localisation de la base</legend>
		
			<div class='form-ligne'>
				<div class='form-gauche'>
					<label for='host' class='libelle' width='70%'>Adresse de connexion</label>
					<input type='text' name='host' placeholder='localhost' required <?php
					if(isset($conf['database']['host'])){
						echo "value='" . $conf['database']['host'] . "'";
					}
					?> />
				</div>
				
				<div class='form-droite'>
					<label for='port' class='libelle' width='29%'>Port</label>
					<input type='number' name='port' min=0 max=65535 placeholder='5432' required <?php
					if(isset($conf['database']['port'])){
						echo "value='" . $conf['database']['port'] . "'";
					}
					?> />
				</div>
			</div>
		</fieldset>
		
		
		<fieldset>
			<legend>Informations de connexion</legend>
			
			<div class='form-ligne'>
				<div class='form-gauche'>
					<p>Type de base</p>
					<div class='radio-button'>
						<label for='pgsql'>PgSQL</label>
						<input type='radio' name='type' id='pgsql' value='pgsql' required <?php
						if(isset($conf['database']['type']) && $conf['database']['type'] == 'pgsql'){
							echo "checked";
						}
						?> />
					</div>
					
					<div class='radio-button'>
						<label for='mysql'>MySQL</label>
						<input type='radio' name='type' id='mysql' value='mysql' <?php
						if(isset($conf['database']['type']) && $conf['database']['type'] == 'mysql'){
							echo "checked";
						}
						?> />
					</div>
					
					<div class='radio-button'>
						<label for='uri'>URI</label>
						<input type='radio' name='type' id='uri' value='uri' <?php
						if(isset($conf['database']['type']) && $conf['database']['type'] == 'uri'){
							echo "checked";
						}
						?> />
					</div>
				</div>
			
				<div class='form-droite'>
					<label for='name' class='libelle'>Nom de la base</label>
					<input  type='text' name='name' placeholder='judo' required <?php
					if(isset($conf['database']['name'])){
						echo "value='" . $conf['database']['name'] . "'";
					}
					?> />
				</div>
			</div>
			
			
			<div class='form-ligne'>
				<div class='form-gauche'>
					<label for='user' class='libelle'>Nom d'utilisateur</label>
					<input  type='text' name='user' placeholder='postgres' required <?php
					if(isset($conf['database']['user'])){
						echo "value='" . $conf['database']['user'] . "'";
					}
					?> />
				</div>
					
				<div class='form-droite'>
					<label for='password' class='libelle'>Mot de passe</label>
					<input type='password' name='password' placeholder='●●●●●●●' required <?php
					if(isset($conf['database']['password'])){
						echo "value='" . $conf['database']['password'] . "'";
					}
					?> />
				</div>
			</div>
		</fieldset>
			
			
		<div class='form-boutons'>
			<button type='reset' >Réinitialiser</button>
			<button type='submit'>Valider & tester</button>
		</div>
	</form>
</div>
<br/>