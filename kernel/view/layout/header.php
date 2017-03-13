<ul id='menu'>
	<li><a href='<?php echo WEBROOT;								?>'>Accueil</a></li>
	
	<li>
		<a href='<?php echo "#"; 									?>'>Adhérents</a>
		<ul>
			<li><a href='<?php echo ADHERENT . "ajouter"; 				?>'>Ajouter/modifier</a></li>
			<!-- <li><a href='<php echo ADHERENT . "modifier";				?>'>Modifier un adhérent</a></li> -->
			<li><a href='<?php echo ADHERENT . "liste_par_cours"; 		?>'>Voir les cours</a></li>
			<!-- <li><a href='<php echo ADHERENT . "cours_nodb"; 		?>'>Fiches de cours NO DB</a></li> -->
			<!-- <li><a href='<php echo ADHERENT . "fiche_presence";		?>'>Fiches de présence</a></li> -->
		</ul>
	</li>
	
	<li>
		<a href='<?php echo "#"; 									?>'>Ceintures</a>
		<ul>
			<li><a href='<?php echo CEINTURE . "ajouter";				?>'>Ajouter des ceintures</a></li>
			<!-- <li><a href='<php echo CEINTURE . "passer";				?>'>Passer des ceintures</a></li> -->
		</ul>
	</li>
	
	<li>
		<a href='<?php echo "#"; 									?>'>Autres</a>
		<ul>
			<li><a href='<?php echo ACCUEIL . "testinterface_form";		?>'>Test interface : formulaire</a></li>
			<li><a href='<?php echo ACCUEIL . "testinterface_table";	?>'>Test interface : tableau</a></li>
			<hr/>
			<li><a href='<?php echo SETTINGS . "database";				?>'>Paramètres base de données</a></li>
			<li><a href='<?php echo SETTINGS . "theme";					?>'>Apparence de l'application</a></li>
		</ul>
	</li>
</ul>