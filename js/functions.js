
/*
 * ucfirst - Même but qu'en PHP : retourne une chaîne avec la première lettre en majuscule
 */
function ucfirst(chaine){
	return chaine[0].toUpperCase() + chaine.substring(1);
}