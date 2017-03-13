
$(
	function() {
		$( '.date_picker' ).datepicker({
			dateFormat: 'dd/mm/yy',
			firstDay: 1,
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
			monthNamesShort: [ "Janv.", "Fév.", "Mars", "Avr.", "Mai", "Juin", "Juill.", "Août", "Sept.", "Oct.", "Nov.", "Déc." ],
			showAnim: "slideDown"
		});
	}
);
