
// Création d'une chaîne (vide pour l'instant) qui servira à lister les IDs des contacts qu'il faudra supprimer de la base
contactsASupprimer = "";





/*
 * supprimerContact()		Supprime la ligne correspondant à un contact.
 *							Si l'ID du contact est fourni, alors c'est que l'on est sur une page de modification des informations d'un
 *							adhérent, et donc que le contact supprimé devra également être supprimé de la base. L'ID de chaque contact
 *							supprimé sera donc enregistré dans une variable globale sous forme d'une liste d'IDs séparés par une virgule
 *							afin d'indiquer au script PHP quels contacts doivent être supprimés.
 *
 * @param elementASupprimer	ID de la div à supprimer.
 */

function retirerContact(elementASupprimer, id = null){
	var parent = elementASupprimer.parentElement;
	parent.removeChild(elementASupprimer);
	
	// Si l'ID a été fourni en paramètre, c'est que le contact supprimé doit être également supprimé de la base, donc on garde
	// l'information pour l'envoi du formulaire
	
	if(typeof id !== 'undefined'){
		
		// Ajouter l'ID et une virgule à la fin
		contactsASupprimer += id + ",";
	}
}















/*
 * ajouterContact()			Ajoute une ligne dans le formulaire (dans la div #lesContacts) pour entrer les informations d'un contact
 *							(lien de parenté, type de contact, et l'information contact elle-même)
 *
 * @param contact			Tableau d'informations pré-remplies pour la ligne
 *							Si non fourni, on est sur une page d'ajout de nouvel adhérent, les champs créés seront donc vides.
 *							Si fourni en revanche, cela signifie qu'on est sur une page de modification des informations d'un adhérent,
 *							dans ce cas le formulaire remplira automatiquement les champs créés avec les informations fournies. 
 */

function ajouterContact(contact = null){
	var	divContacts,
		premierContact,
		contenu = "",
		divLigneContact = document.createElement('div'),
		classContact = "unContact",
		idDiv,
		idDivComplet,
		dernierID;
		
		
	divContacts = document.getElementById('lesContacts');
	
	
	
	// S'il n'existe pas encore de div dans la div #lesContacts, alors ça veut dire qu'on affiche le tout premier contact
	premierContact = divContacts.lastChild.nodeName != 'DIV';
	
	
	
	
	
	
	if(!contact){
		// Récupération du numéro dans l'ID de la dernière div contact_** SI on n'est pas sur le premier contact
		// afin de déterminer l'ID suivant (pour la div contact_** qu'on est en train d'écrire)...
		if(!premierContact){
			dernierID = parseInt(divContacts.lastChild.id.match(/\d+/), 10);
			idDiv = dernierID + 1;
		}else{
			idDiv = 0;
		}
	}else{
		idDiv = contact['con_id'];
	}
	
	
	// puis écriture de l'ID complet de la div actuelle (libelle + numéro)
	idDivComplet = "contact_" + idDiv;
	
	
	
	
	
	

	/* 
	 * =========================================================
	 * ============  Ecriture du CONTENU de la div  ============
	 * =========================================================
	 */
	contenu += "\
			<div class='form-gauche'> \
				<div class='form-gauche'> \
					<label for='lien_" + idDivComplet + "' class='libelle'>Pour contacter</label> \
					<input type='textbox' id='lien_" + idDivComplet + "' name='lien_" + idDivComplet + "' class='lien_contact' placeholder='Adhérent, père, mère...' required";
	
	
	/*
	 * Remplissage des options pour LIENS_PARENTE
	 */
	 
	if(contact){
		contenu += " value='" + ucfirst(contact['con_lien_parente']['lie_libelle']) + "' ";
	}
	
	
	
	contenu += "\
					/ > \
				</div> \
				\
				<div class='form-droite'> \
					<label for='type_" + idDivComplet + "' class='libelle'>Type de contact</label> \
					<select class='type_contact largeur-100' id='type_" + idDivComplet + "' name='type_" + idDivComplet + "'>";
	
	
	
	
	/*
	 * Remplissage des options pour TYPES_CONTACT
	 */
	 // console.log(TYPES_CONTACT);
	 
	for(unType of TYPES_CONTACT){
		// console.log("unType :");
		// console.log(unType);
		contenu += "	  <option value='" + unType['id'] + "' ";
		
		// SI un contact a été passé en paramètre ET que l'option qu'on est en train d'écrire correspond au type du contact
		// Alors on sélectionne l'option
		
		if(contact && unType['id'] == contact['con_type']){
			contenu += " selected";
		}
		
		contenu += 		   ">" + ucfirst(unType['label'])
						+ "</option>";
						// (la division de la chaîne en deux morceaux, c'est juste pour avoir la première lettre en majuscule)
	}
	
	
	contenu += "\
					</select> \
					\
				</div> \
			</div> \
			\
			\
			<div class='form-droite'> \
				<div class='form-tiers-1-2'> \
					<label for='data_" + idDivComplet + "' class='libelle'>Contact</label> \
					<input type='textbox' placeholder='Numéro de téléphone, email...' id='data_" + idDivComplet + "' name='data_" + idDivComplet + "' required ";
	
	
	
	// SI un contact a été passé en paramètre
	// Alors on l'affiche
	
	if(contact){
		contenu += " value='" + contact['con_contact'] + "' ";
	}
	
	contenu +=		" /> \
				</div> \
				\
				<div class='form-tiers-3'>";
	
	
	// SI on n'est pas en train d'afficher le premier contact
	// Alors on affiche un bouton permetant de supprimer ce contact
	
	if(!premierContact){
		contenu += " <button type='button' class='delContact' id='del_" + idDivComplet + "' onclick='retirerContact(" + idDivComplet;
		
		// SI le contact avait été fourni (et donc qu'on est sur une page de modif (et donc que les contacts supprimés doivent être supprimés aussi de la base))
		// Alors on fournit l'ID en paramètre à la fonction retirerContact()
		
		if(contact){
			contenu += ", " + idDiv;
		}
		
		contenu += ")'>X</button>";
	}
	
	contenu += "</div> \
			</div>";
	
	
	
	
	
	
	
	
	
	
	/*
	 * Création de la div et insertion dans le document HTML
	 */
	 
	divLigneContact.id = idDivComplet;
	divLigneContact.className = 'unContact form-ligne';
	divLigneContact.style = "height:auto;";
	
	divLigneContact.innerHTML = contenu;
	divContacts.appendChild(divLigneContact);
	
}







