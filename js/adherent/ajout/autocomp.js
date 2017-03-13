/*
 * Note : les constantes utilisées ici comme sources sont récupérées directement depuis la vue qui a appelé ce fichier :
 * /kernel/adherent/ajout_modif.php
 */


$(


	function() {
		
		// Autocomplétion pour charger un adhérent avec le champ #nom
		if(typeof(ADHERENTS) !== 'undefined'){
			$( '#nom' ).autocomplete(
				{
					source: ADHERENTS,
					autoFocus: true,
					minLenght: 3,
					select: function (event, ui){
						window.location.href = "modifier/" + ui.item.id;
					}
				}
			);
		}
			
			
			
			
			
		// Autocomplétion pour le champ #famille
		if(typeof(FAMILLES) !== 'undefined'){
			$( '#famille' ).autocomplete(
				{
					source: FAMILLES
				}
			);
		}
		
		
		
		
		
		// Autocomplétion pour les champs .lien_contact
		$( '.lien_contact' ).autocomplete(
			{
				source: LIENS_PARENTE
			}
		);
		
		
	}
);

