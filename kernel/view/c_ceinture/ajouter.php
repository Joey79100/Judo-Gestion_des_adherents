<div class='window'>
	<h1> Ajouter une ceinture </h1>
	
	<table class='ceintures'>
		<tr>
			<th></th>
			<th>Ceinture</th>
			<th>Âge minimum</th>
		</tr>
			
		<tr>
			<form method='post' id='ajoutCeinture' style='display:none'; action='create'></form>
			<td>
				<button type='submit' form='ajoutCeinture' style='width:100%'>Ajouter</button>
			</td>
			
			<td>
				<input type='text' name='nouvelleCeinture' placeholder='Nouvelle ceinture' form='ajoutCeinture' required />
			</td>
			
			<td>
				<input type='text' name='ageNouvelleCeinture' placeholder='Âge minimum' form='ajoutCeinture'/>
			</td>
		</tr>
		<?php
			foreach($this->viewvar['ceintures'] as $uneCeinture){
				echo "<tr><td>" . $uneCeinture['cei_id'] . " </td><td> " . ucfirst($uneCeinture['cei_libelle']) . "</td><td>";
				if(isset($uneCeinture['cei_age_mini'])){
					echo $uneCeinture['cei_age_mini'] . " ans";
				}else{
					echo "N/A";
				}
				
				
				echo "</td></tr>";
			}
		?>
	</table>
</div>