
// Création de tableaux (vides pour l'instant) qui serviront à lister les IDs des contacts qu'il faudra ajouter/mettre à jour/supprimer
contactsAAjouter = [];
contactsAModifier = [];
contactsASupprimer = [];




/*
 * supprimerContact - Supprime la ligne correspondant à un contact, et ajoute un ligne de contact vierge s'il n'y a
 *		plus aucune ligne de contact affichée (puisqu'un adhérent doit obligatoirement avoir au moins un contact).
 *		
 *		Si la Div du contact avait l'attribut "data-contact_dans_la_base" à "true", alors c'est que le contact en
 *		était présent dans la base de données, il devra donc en être supprimé devra également être supprimé.
 *		L'ID de chaque contact supprimé sera donc enregistré dans une variable globale sous forme d'une liste d'IDs
 *		séparés par une virgule afin d'indiquer au script PHP quels contacts doivent être supprimés.
 *
 * @param elementASupprimer	ID de la div à supprimer.
 */

function retirerContact(elementASupprimer){
	var parent = elementASupprimer.parentElement,
		idContact = elementASupprimer.getAttribute("data-id_contact"),
		contactDansLaBase = elementASupprimer.getAttribute("data-contact_dans_la_base");
	
	console.log(elementASupprimer);
	
	
	
	/*
	 * Si la div à supprimer correspondait à un contact présent dans la base (attribut data-contact_dans_la_base)
	 * alors il faudra l'en supprimer, donc on va l'inscrire dans contactsASupprimer.
	 *
	 * Sinon, c'est que c'était un nouveau contact qui n'est pas dans la base, mais qui avait été inscrit dans contactsAAjouter.
	 * Il faut l'en retirer pour pas que le PHP tente d'insérer des infos qui n'existent pas.
	 */
	
	if(contactDansLaBase == 'true'){
		contactsASupprimer.push(idContact);					// Ajout de l'ID dans le tableau contactsASupprimer
	}else{
		var index = contactsAAjouter.indexOf(idContact);	// Recherche de la position de l'ID dans la liste contactsAAjouter
		
		if(index != -1){
			contactsAAjouter.splice(index, 1);				// Si l'ID existe dans le tableau, alors l'en enlever
		}
		var index = contactsAAjouter.indexOf(idContact);	// Recherche de la position de l'ID dans la liste contactsAAjouter
		contactsAAjouter.splice(index, 1);					// Suppression de l'ID.
	}
	
		
	
	/*
	 * Suppression du contact
	 */
	parent.removeChild(elementASupprimer);
	
	
	
	
	// Ajout d'un nouveau contact si tous les contacts affichés ont été supprimés
	ajouterContactSiZeroContact();
}









/*
 * ajouterContact - Ajoute une ligne dans le formulaire (dans la div #lesContacts) pour entrer les informations d'un contact
 *		(lien de parenté, type de contact, et l'information contact elle-même)
 *
 * @param contact			Tableau d'informations pré-remplies pour la ligne
 *							Si non fourni, on est sur une page d'ajout de nouvel adhérent, les champs créés seront donc vides.
 *							Si fourni en revanche, cela signifie qu'on est sur une page de modification des informations d'un adhérent,
 *							dans ce cas le formulaire remplira automatiquement les champs créés avec les informations fournies. 
 */

function ajouterContact(contact = null){
	var	divContacts = document.getElementById('lesContacts'),
		contenu = "",
		divLigneContact = document.createElement('div'),
		classContact = "unContact",
		idContact,
		idDiv,
		dernierID;
		
	
	
	
	
	idContact = contact ? contact['con_id'] : getIdDernierContact() + 1;	// Si un contact est fourni, on récupère son id, sinon on prend le dernier ID + 1
	// idContact = getIdDernierContact() + 1;									// Si un contact est fourni, on récupère son id, sinon on prend le dernier ID + 1
	idDiv = "contact_" + idContact;									// Puis on écrit de l'ID complet de la div actuelle (libelle + numéro)
	
	
	
	
	

	/* 
	 * =========================================================
	 * ============  Ecriture du CONTENU de la div  ============
	 * =========================================================
	 */
	contenu += "\
			<div class='form-gauche'> \
				<div class='form-gauche'> \
					<label for='lien_" + idDiv + "' class='libelle'>Pour contacter</label> \
					<input type='text' id='lien_" + idDiv + "' name='lien_" + idDiv + "' class='lien_contact' placeholder='Adhérent, père, mère...' autocomplete='off' onchange='contactModifie(" + idContact + ")' required";
	
	
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
					<label for='type_" + idDiv + "' class='libelle'>Type de contact</label> \
					<select class='type_contact largeur-100' id='type_" + idDiv + "' name='type_" + idDiv + "' onchange='contactModifie(" + idContact + ")' >";
	
	
	
	
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
					<label for='le_" + idDiv + "' class='libelle'>Contact</label> \
					<input type='text' placeholder='Numéro de téléphone, email...' id='le_" + idDiv + "' name='le_" + idDiv + "' onchange='contactModifie(" + idContact + ")' required ";
	
	
	
	// SI un contact a été passé en paramètre
	// Alors on l'affiche
	
	if(contact){
		contenu += " value='" + contact['con_contact'] + "' ";
	}
	
	contenu +=		" /> \
				</div> \
				\
				<div class='form-tiers-3'>";
	
	

	// Affichage d'un bouton permettant de supprimer ce contact
	
	contenu += " <button type='button' class='delContact' id='del_" + idDiv + "' onclick='retirerContact(" + idDiv + ")'>X</button>";
	
	contenu += "</div> \
			</div>";
	
	
	
	
	
	
	
	
	
	
	/*
	 * Création de la div et insertion dans le document HTML
	 */
	 
	divLigneContact.id = idDiv;
	
	
	divLigneContact.setAttribute('data-contact_dans_la_base', contact ? true : false);	// Si le contact existait dans la base alors on ajoute son ID dans un attribut de la div HTML
	
	divLigneContact.setAttribute('data-id_contact', idContact);
	divLigneContact.className = 'unContact form-ligne';
	divLigneContact.style = "height:auto;";
	
	divLigneContact.innerHTML = contenu;
	divContacts.appendChild(divLigneContact);
	
	
	
	// Et si ce contact n'existait pas dans la base (donc s'il n'a pas été fourni en paramètre)
	// Il faut penser que ça sera un nouveau contact à ajouter dans la base
	if(!contact){
		contactsAAjouter.push(idContact);
	}
}









/*
 * Vérifie s'il existe des contacts sur la page, et si ce n'est pas le cas, alors en ajoute un
 */
function ajouterContactSiZeroContact(){
	var divContacts = document.getElementById('lesContacts');
	
	
	
	// Si le dernier élément dans la divContacts n'est pas une DIV (donc s'il n'y a que des espaces, tabulation... donc si c'est du texte)
	// Alors on ajoute un contact
	
	if(!(divContacts.lastChild.nodeName == 'DIV')){
		ajouterContact();
	}
	
	
	
	
	
	
	// SI il n'y a plus de contact... alors il faut en rajouter puisque chaque adhérent DOIT avoir au moins un contact
}








/*
 * getDernierContact - Récupère l'id du dernier contact dans le formulaire (matérialisé par une DIV) si elle existe
 * 
 * @return				L'ID de la dernière div si elle existe, ou sinon 0
 */
 
function getIdDernierContact(){
	var divContacts = document.getElementById('lesContacts'),
		derniereDiv = divContacts.lastChild;
	
	// Si le dernier élément dans divContacts est une div, alors on récupère son id 
	if(derniereDiv.nodeName == 'DIV'){
		console.log("derniereDiv: " + derniereDiv);
		
		dernierID = parseInt(derniereDiv.getAttribute('data-id_contact'));
		
		console.log("dernierID : " + dernierID);
	}else{
		dernierID = 0;
	}
	
	return dernierID;
}









/*
 * contactModifie - Ajoute l'ID passé en paramètre au tableau contactsAModifier pour que le script PHP
 * 
 * @param idContact		L'ID du contact
 */
 
function contactModifie(idContact){
	var index = contactsAModifier.indexOf(idContact);
	console.log(index);
	
	// Si l'ID n'existe pas déjà dans la liste, alors on peut l'y ajouter
	if(index == -1){
		contactsAModifier.push(idContact);
	}
}

