

// $( "form" ).submit(function( event ) {
  // if ( $( "input:first" ).val() === "correct" ) {
    // $( "span" ).text( "Validated..." ).show();
    // return;
  // }
 
  // $( "span" ).text( "Not valid!" ).show().fadeOut( 1000 );
  // event.preventDefault();
// });



$( "#modifAdherent" ).submit(function( event ) {
	event.preventDefault();		// Nécessaire pour empêcher le submit par défaut et laisser le script JS gérer ça
	
	
	
	// Si la chaîne n'est pas vide, c'est qu'elle est remplie -> donc qu'il faut enlever la dernière virgule
	if(contactsASupprimer.length > 0){
		contactsASupprimer = contactsASupprimer.slice(0, -1);
	}
	
	
	// On ajoute la liste dans un input caché dans le formulaire pour pouvoir la récupérer dans le code PHP
	// var leInput = "<input type='hidden' name='elementsASupprimer' value='" + contactsASupprimer + "' />";
	// modifAdherent.append(leInput)
	
	var input = document.createElement('input');
	input.type = 'hidden';
	input.name = 'contactsASupprimer';
	input.value = contactsASupprimer;
	
	console.log(input);
	
	modifAdherent.append(input);

	document.modifAdherent.submit();
});