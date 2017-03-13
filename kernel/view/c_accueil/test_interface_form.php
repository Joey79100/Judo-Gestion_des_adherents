<div class='window'>
	<h1>Voilà le contenu du site</h1>
	<p>Bienvenue ou pas bienvenue, balais-couilles. Nous sommes dans une société civilisée certes mais y a des limites.</p>
	<p>Sinon, fait froid dehors, c'est nul.</p>
	<p>Tiens, puis v'là <a href='testinterface_table'>un lien</a> pour euh... pour... lier, vois-tu...</p>

	<hr/>
	<form method='post'>
		<fieldset>
			<legend>Une première partie</legend>
			
			
			
			
			
			<p>Liste d'options radio à choisir, dont des options désactivées.</p>
		
			<div class='form-ligne'>
				<input type='radio' name='testradio' id='radio1_1' />
				<label for='radio1_1'>
					Option 1
				</label>
				
				
				<input type='radio' name='testradio' id='radio1_2' />
				<label for='radio1_2'>
					Option 2
				</label>
				
				
				<input type='radio' name='testradio' id='radio1_3' />
				<label for='radio1_3'>
					Option 3
				</label>
				
				
				<input type='radio' name='testradio' id='radio1_4' disabled />
				<label for='radio1_4'>
					Option désactivée
				</label>
				
				
				<input id='radio1_5' type='radio' name='testradio' disabled checked />
				<label for='radio1_5'>
					Option désactivée cochée
				</label>
			</div>
			
			
			
			
			
			<p>Plusieurs champs de texte à remplir (champs à une ligne).</p>
			<div class='form-ligne'>
				<div class='form-demi-ligne'>
					<label class='libelle'>
						Texte pour champ de texte 1
					</label>
					<input type='textbox' name='champtexte1' placeholder='Champ de texte 1' />
				</div>
				
				<div class='form-demi-ligne'>
					<label class='libelle'>
						Texte pour champ de texte 2
					</label>
					<input type='textbox' name='champtexte2' placeholder='Champ de texte 2' />
				</div>
			</div>
			
			
			
			
			
			<p>Plusieurs champs sur deux colonnes</p>
			<div class='form-ligne'>
				<div class='form-gauche'>
					<label class='libelle'>
						Texte pour champ de texte 1
					</label>
					<input type='textbox' name='champtexte1' placeholder='Champ de texte 1' />
				</div>
				
				<div class='form-droite'>
					<label class='libelle'>
						Texte pour champ de texte 2
					</label>
					<input type='textbox' name='champtexte2' placeholder='Champ de texte 2' />
				</div>
			</div>
		</fieldset>
			
			
			
			
		<fieldset>
			<legend>Une seconde partie</legend>
			
			<p>Des séléctions avancées : liste et fichier</p>
			
			<div class='form-ligne'>
				<label class='libelle'>
					Sélection dans une liste sur ligne entière
				</label>
				<select>
					<option disabled selected value>--- Sélectionner ---</option>
					<option disabled>-- Produits laitiers --</option>
					<option>Fromage</option>
					<option>Yaourt</option>
					<option>Crème dessert</option>
					<option disabled>-- Fruits --</option>
					<option>Banane</option>
					<option>Fraise</option>
					<option>Cerise</option>
					<option disabled>-- Légumes --</option>
					<option>Aubergine</option>
					<option>Haricot vert</option>
					<option>Retraité</option>
				</select>
			</div>
			
			
			<div class='form-ligne'>
				<label class='libelle'>
					Sélection d'un fichier à envoyer
				</label>
				<input type='file'/>
			</div>
		</fieldset>
		
		






		
		<fieldset>
			<legend>Une troisième partie</legend>
			
			<p>Choix plusieurs champs de texte</p>
			
			<div class='form-ligne'>
				<label class='libelle'>
					Texte pour champ de texte 1
				</label>
				<input type='textbox' name='champtexte1' placeholder='Champ de texte 1' />
			</div>
				
			<div class='form-ligne'>
				<label class='libelle'>
					Texte pour champ de texte 2
				</label>
				<input type='textbox' name='champtexte2' placeholder='Champ de texte 2' />
			</div>
			
		</fieldset>
		
		
		
		
		
		
		
		
		
		
		<fieldset>
			<legend>Une quatrième partie</legend>
			
			
			<p>Choix plusieurs champs de texte</p>
			
			<div class='form-ligne'>
				<label class="libelle">
				Texte pour champ de texte 3
				</label>
				<input type='textbox' name='champtexte3' placeholder='Champ de texte 3' />
			</div>
			
			
			
			
			<div class='form-ligne'>
				<label class="form-colonne-entiere libelle">
					Texte pour champ de texte désactivé
				</label>
				<input type='textbox' name='champtexte4' placeholder='Champ de texte désactivé' disabled />
			</div>
			
			
			
			
			
			<p>Choix avec des checkbox</p>
			
			<div class='form-ligne'>
				<input id='checkbox1_1' type='checkbox' name='testcheckbox' />
				<label for='checkbox1_1'>
					Option 1
				</label>
				
				<input id='checkbox1_2' type='checkbox' name='testcheckbox' />
				<label for='checkbox1_2'>
					Option 2
				</label>
				
				<input id='checkbox1_3' type='checkbox' name='testcheckbox' disabled />
				<label for='checkbox1_3'>
					Option désactivée
				</label>
				
				<input id='checkbox1_4' type='checkbox' name='testcheckbox' disabled checked />
				<label for='checkbox1_4'>
					Option désactivée cochée
				</label>
			</div>
			
			
			<br/>
			
			
			<div class='form-ligne'>
				<label class='libelle'>
					Zone de texte
				</label>
				<textarea  class='zoneTexte'></textarea>
			</div>
		</fieldset>
		
		
		
		
		
		
		
		<div class="form-boutons">
			<button type='button'>Normal</button>
			<button type='button' disabled>Désactivé</button>
			<button type='reset'>Réinitialiser</button>
			<button type='submit'>Envoyer</button>
		</div>
	</form>
</div>