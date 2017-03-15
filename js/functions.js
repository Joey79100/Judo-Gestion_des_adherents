

/*
 * ucfirst - Même but qu'en PHP : retourne une chaîne avec la première lettre en majuscule
 *
 * @param chaine	Chaîne source
 * @return 			Chaine identique mais avec la première lettre en majuscule
 */
function ucfirst(chaine){
	return chaine[0].toUpperCase() + chaine.substring(1);
}



/*
 * calculerAge - Calcule l'âge d'une personne en fonction de sa date de naissance
 *				Basé sur : http://stackoverflow.com/a/5524786
 * 
 * @param		La date de naissance (au format SQL : YYYY-MM-DD)
 * @return		L'âge calculé
 */
function calculerAge(dateNaissanceSQL){
	var	dateDuJour = new Date(),
		dateNaissance = new Date(dateNaissanceSQL),
		age;
	
	age = Math.floor((dateDuJour - dateNaissance) / (365.25 * 24 * 60 * 60 * 1000));
	
	return(age);
}