



	
/*
 * Envoi des listes des contacts à ajouter/modifier/supprimer sous forme d'input caché
 * Cela évite d'avoir à chercher en PHP quelles opérations ont été faites (ce qui serait bien trop compliqué sinon)
 */


$( "#modifAdherent" ).submit(function( event ) {
	// Empêcher le submit par défaut pour pouvoir le faire nous-même quand on voudra
	
	event.preventDefault();
	
	
	
	
	// Création des input

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

	


	
	// Envoi du formulaire
	
	document.modifAdherent.submit();
});