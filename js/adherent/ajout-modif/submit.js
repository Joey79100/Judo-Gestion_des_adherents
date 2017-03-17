

$( "#modifAdherent" ).submit(function( event ) {
	
	// Empêcher l'envoi par défaut pour pouvoir le faire nous-même quand on estimera que tout est complété correctement
	event.preventDefault();
	
	
	
	var adherent_age = document.getElementById('age').value;
	
	
	var select_cours = document.getElementById('cours');
	var cours_nom = select_cours.options[select_cours.selectedIndex].text;
	var cours_ageMini = parseInt(select_cours.options[select_cours.selectedIndex].getAttribute("data-age"), 10);
	console.log("select_cours : " + select_cours);
	console.log("cours_ageMini : " + cours_ageMini);
	
	var select_ceinture = document.getElementById('ceinture');
	var ceinture_nom = select_ceinture.options[select_ceinture.selectedIndex].text;
	var ceinture_ageMini = parseInt(select_ceinture.options[select_ceinture.selectedIndex].getAttribute("data-age"), 10);
	console.log("select_ceinture : " + select_ceinture);
	console.log("ceinture_ageMini : " + ceinture_ageMini);
	
	
	
	
	
	age_cours_ok = true;
	age_ceinture_ok = true;
	
	
	if(adherent_age < cours_ageMini){
		var text_dialog = "Pour suivre le cours " + cours_nom + ", il est nécessaire d'avoir au moins " + cours_ageMini + " ans." + "\n"
		+ "Or, l'adhérent n'a que " + adherent_age + " ans. " + "\n"
		+ "\n"
		+ "Êtes-vous vraiment sûr de vouloir l'inscrire à ce cours ?"
		
		age_cours_ok = confirm(text_dialog);
	}
	
	if(adherent_age < ceinture_ageMini){
		var text_dialog = "Pour suivre porter la ceinture " + ceinture_nom + ", il est nécessaire d'avoir au moins " + ceinture_ageMini + " ans." + "\n"
		+ "Or, l'adhérent n'a que " + adherent_age + " ans. " + "\n"
		+ "\n"
		+ "Êtes-vous vraiment sûr de vouloir lui passer cette ceinture ?"
		
		age_ceinture_ok = confirm(text_dialog);
	}
	
	
	
	
	
	
	
	
	
	
	var adherent_age = document.getElementById('age').value;
	var select_ceinture = document.getElementById('ceinture');
	var ceinture_nom = select_ceinture.options[select_ceinture.selectedIndex].text;
	var ceinture_ageMini = select_ceinture.options[select_ceinture.selectedIndex].getAttribute("data-age");
	
	
	
	
	
	
	
	
		
	/*
	 * Envoi des listes des contacts à ajouter/modifier/supprimer sous forme d'input caché
	 * Cela évite d'avoir à chercher en PHP quelles opérations ont été faites (ce qui serait bien trop compliqué sinon)
	 */
	
	if(contactsAAjouter.length > 0){
		var input_contactsAAjouter = document.createElement('input');
		input_contactsAAjouter.type = 'hidden';
		input_contactsAAjouter.name = 'contactsAAjouter';
		input_contactsAAjouter.value = contactsAAjouter.join();
		
		modifAdherent.append(input_contactsAAjouter);
		console.log("contactsAAjouter = " + contactsAAjouter);
	}
	
	
	
	if(contactsAModifier.length > 0){
		var input_contactsAModifier = document.createElement('input');
		input_contactsAModifier.type = 'hidden';
		input_contactsAModifier.name = 'contactsAModifier';
		input_contactsAModifier.value = contactsAModifier.join();
		
		modifAdherent.append(input_contactsAModifier);
		console.log("contactsAModifier = " + contactsAModifier);
	}
	
	
	
	if(contactsASupprimer.length > 0){
		var input_contactsASupprimer = document.createElement('input');
		input_contactsASupprimer.type = 'hidden';
		input_contactsASupprimer.name = 'contactsASupprimer';
		input_contactsASupprimer.value = contactsASupprimer.join();
		
		modifAdherent.append(input_contactsASupprimer);
		console.log("contactsASupprimer = " + contactsASupprimer);
	}

	console.log("\n");
	console.log("contactsASupprimer : " + contactsASupprimer);
	console.log("contactsAModifier : " + contactsAModifier);
	console.log("contactsAAjouter : " + contactsAAjouter);
	console.log("\n");

	
	// Envoi du formulaire
	
	if(age_cours_ok && age_ceinture_ok){
		// document.modifAdherent.submit();
	}
	
});