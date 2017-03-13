<?php

abstract class Model{
	protected $table;
	protected $pk;
	protected $estAutoIncrement;
	protected $attribtech;
	protected $fk;
	// attribtech sert à lister quels sont les attributs non-métiers :
	// donc les attributs qui ne correspondent à rien dans la table associée
	
	
	
	
	
	
	
	
	
	
	/*
	* __construct -	Construit l'objet.
	*
	* @param	$nomTable			Nom de la table
	* @param	$clePrimaire		Nom de la clé primaire
	* @param	$autoIncrementOuNon	Précise si la clé primaire de la table est auto-incrémentée ou non (booléen)
	* @param	$fk					Tableau à deux dimensions indiquant quelles propriétés correspondent à des clés étrangères
	*								et à quelle table elles appartiennent
	*								Format : [<nom_de_la_table_etrangere>][<nom_de_la_cle_etrangere_dans_l_objet_courant>]
	*
	* @return	Tableau des enregistrements correspondant à la requête
	*/
	public function __construct($nomTable, $clePrimaire, $autoIncrementOuNon, $fk){
		$this->table = $nomTable;
		$this->pk = $clePrimaire;
		$this->estAutoIncrement = $autoIncrementOuNon;
		$this->fk = $fk;
		$this->attribtech = array('table', 'pk', 'estAutoIncrement', 'fk', 'attribtech');
	}
	
	
	
	
	
	
	
	
	
	/*
	* doBelongsToAssoc - Pour chaque clé étrangère de l'objet courant, créée un objet y correspondant et le peuple avec les données associées.
	*/
	private function doBelongsToAssoc($lectures, $clesOmises = array()){
		// $i = 0;		// Utilisé uniquement pour compter le nombre de read fait dans le foreach quand on affiche le détail à l'écran
		$lectures--;
		
		if(isset($lectures) && $lectures > -1){
			// echo "<div style='background-color:#a98;margin:20px;padding:20px;border:solid black 3px;'>";
			foreach($this->fk as $cle=>$valeur){	// Pour chaque clé étrangère que la table possède
				// $i++;
				// echo "doBelongsToAssoc : <b><i><font color='#0ff' size='6'>" . $lectures . "</font></i></b>, table n°" . $i;
				if(!in_array($cle, $clesOmises)){
					$id = $this->$valeur;				// Alors on récupère la valeur de la clé étrangère en question
					$this->$valeur = new $cle();		// On crée un objet de type Adhérent, ou Sujet, ou... enfin ce qui est noté dans $cle (un nom de table)...
					// echo "<br/>model::doBelongsToAssoc() -> \$valeur : " . $valeur . " / \$id : " . $id;
					$this->$valeur->read($id, $lectures);			// ... et on y insère les données qui correspondent à cette clé étrangère en faisant une requête sur son ID
				}
			}
			// echo "</div>";
			return $lectures;
		}
	}
	
	
	
	
	
	
	
	
	
	/*
	* connexion - Ouvre une connexion à la base de données et retourne un objet avec lequel il est possible d'exécuter des requêtes sur cette base.
	*			Les informations relatives à la connexion sont récupérées dans le fichier de configuration du site.
	*
	* @return	Objet PDO
	*/
	protected function connexion(){
		
		
		$chemin_conf = CONF . "settings.ini";
		
		
		/*
		 * Lecture du fichier de conf pour récupérer les informations de connexion à la base,
		 * et si des paramètres sont absents alors on créée le fichier et on y entre des paramètres par défaut.
		 *
		 * TROUVER UNE SOLUTION PLUS ECONOME EN IF...
		 */
		if(file_exists($chemin_conf)){
			$infos_connexion = parse_ini_file($chemin_conf, true);		// Récupération des infos du fichier de configuration
			
			if(isset($infos_connexion['database']['type'])){
				$type = $infos_connexion['database']['type'];
			}else{
				$type = 'pgsql';
				ini_write($chemin_conf, 'database', 'type', $type);
			}
			
			if(isset($infos_connexion['database']['host'])){
				$host = $infos_connexion['database']['host'];
			}else{
				$host = 'localhost';
				ini_write($chemin_conf, 'database', 'host', $host);
			}
			
			if(isset($infos_connexion['database']['port'])){
				$port = $infos_connexion['database']['port'];
			}else{
				$port = '5432';
				ini_write($chemin_conf, 'database', 'port', $port);
			}
			
			if(isset($infos_connexion['database']['name'])){
				$nomdb = $infos_connexion['database']['name'];
			}else{
				$nomdb = 'judo';
				ini_write($chemin_conf, 'database', 'name', $nomdb);
			}
			
			if(isset($infos_connexion['database']['user'])){
				$user = $infos_connexion['database']['user'];
			}else{
				$user = 'postgres';
				ini_write($chemin_conf, 'database', 'user', $user);
			}
			
			if(isset($infos_connexion['database']['password'])){
				$mdp = $infos_connexion['database']['password'];
			}else{
				$mdp = 'pgadmin';
				ini_write($chemin_conf, 'database', 'password', $mdp);
			}
		}else{
			$type = 'pgsql';
			ini_write($chemin_conf, 'database', 'type', $type);
			$host = 'localhost';
			ini_write($chemin_conf, 'database', 'host', $host);
			$port = '5432';
			ini_write($chemin_conf, 'database', 'port', $port);
			$nomdb = 'judo';
			ini_write($chemin_conf, 'database', 'name', $nomdb);
			$user = 'postgres';
			ini_write($chemin_conf, 'database', 'user', $user);
			$mdp = 'pgadmin';
			ini_write($chemin_conf, 'database', 'password', $mdp);
		}
		
		
		
		
		try{
			$db = new PDO($type . ":host=" . $host . "; port=" . $port . "; dbname=" . $nomdb, $user, $mdp);		// Tentative de connexion à la base
		}
		catch (PDOException $e){
			erreur($e, 'sql');
			die();
		}
		return $db;
	}
	
	
	
	
	
	
	
	
	
	/*
	* create -	Créée un nouvel enregistrement dans la base en y insérant tous les attributs de l'objet courant,
	*			puis retourne l'enregistrement créé (afin de pouvoir récupérer son id)
	*
	* @return	Tableau à deux dimensions : [<unNomColonne>][<uneValeurColonne>]
	*/
	public function create(){
		$listeProprietes = "";
		$listeValeurs = "";
		

		if($this->estAutoIncrement){
			/*
			*  SI la clé primaire est en auto-incrément
			*  ALORS on l'ajoute dans le tableau des attributs techniques, comme ça,
			*  elle ne sera pas ajoutée dans la requête
			*/
			$this->attribtech[] = $this->pk;
		}
		
		/*
		* Insertion dans la requête des noms de colonne
		* 	- SI on n'est pas en train de regarder un attribut technique 
		*		(donc si le nom de l'attribut sur la ligne en cours ne fait pas partie des noms d'attribut
		*		 qu'on a notés dans le tableau où on a noté les attributs techniques (le tableau $attribtech) )
		*/
		foreach ($this as $unNomColonne=>$uneValeurColonne){
			if(!in_array($unNomColonne, $this->attribtech) && !is_null($uneValeurColonne)){
				// Pour la requete d'insertion :
				$listeProprietes .= " $unNomColonne ,";
				
				if(is_bool($uneValeurColonne)){
					$listeValeurs .= $uneValeurColonne ? " TRUE ," : " FALSE ,";
				}else{
					echo "<hr/>";
					
					$listeValeurs .= " '" . htmlspecialchars($uneValeurColonne, ENT_QUOTES) . "' ,";
				}
			}
		}
		
		$listeProprietes = substr($listeProprietes, 0, -1);		// Suppression de la dernière virgule
		$listeValeurs = substr($listeValeurs, 0, -1);			// Suppression de la dernière virgule
		
		
		$reqIns = "INSERT INTO {$this->table} ($listeProprietes) VALUES ($listeValeurs)";
		
		echo "<br/>model::create() -> \$reqIns : <br/>" . $reqIns . "<br/>";
		
		
		
		
		$base = $this->connexion();
		$base->exec($reqIns);
		
		
		/*
		 * Si la PK est en un ID en auto-incrément, alors on récupère l'ID de l'enregistrement tout juste créé
		 * et on l'affecte à la propriété [clé primaire] de l'objet
		 */
		if($this->estAutoIncrement){
			$this->{$this->pk} = $base->lastInsertId($this->table . "_" . $this->pk . "_seq");
		}
		
		$base = null;
	}
	
	
	
	
	
	
	
	
	
	private function ecrireRequeteRead($id){
		// echo "<hr/><b><font color='blue'>ENTREE DANS model::ecrireRequeteRead()</font></b><br/>";
		
		// echo "<br/> <u>model::ecrireRequeteRead() -> \$id :</u> <br/>";
		// echo "<pre>";
		// print_r($id);
		// echo "</pre>";
		// var_dump($id);
		
		// echo "<br/> <u>model::ecrireRequeteRead() -> \$this->pk :</u> <br/>";
		// echo "<pre>";
		// print_r($this->pk);
		// echo "</pre>";
		// var_dump($this->pk);
		
		
		$req = "SELECT * FROM {$this->table} WHERE ";
		
		
		if(is_array($this->pk)){								// Cas d'une clé primaire composée
		
			if(is_array($id)){
				
				foreach($this->pk as $uneClePrimaire){
					$req = $req . $uneClePrimaire . " = " . $id[$uneClePrimaire] . " AND ";
				}
				$req = substr($req, 0, -4); // Pour enlever le denier 'AND' inutile de la requête
				
			}else{
				die("<br/><font color='darkred'>model::ecrireRequeteRead -> ERREUR : la clé primaire fournie devrait être un tableau, mais il a été fourni une simple chaîne.</font><br/>");
			}
		}else{													// Cas d'une clé primaire classique
			if(is_array($id)){
				$req = $req . $this->pk . " = " . $id[0];
			}else{
				$req = $req . $this->pk . " = " . $id;
			}
		}
		
		// echo "<br/><b>model::ecrireRequeteRead() -> \$req :</b> " . $req . "<br/>";
		
		
		// echo "<br/><b><font color='blue'>SORTIE DE model::ecrireRequeteRead()</font></b><hr/>";
		return $req;
	}
	
	
	
	
	
	
	
	
	/*
	* lineExist - Vérifie si l'enregistrement d'ID spécifié en paramètre est présent dans la base en lisant la ligne y correspondant.
	*			Retourne faux si la ligne n'existe pas, sinon retourne un tableau avec les données de l'enregistrement.
	*
	* @return	Tableau
	*/
	public function lineExist($id){
		// echo "<br/>ENTREE DANS model::lineExist()";
		
		// echo "<br/><b>model::lineExist() -> \$id -> :</b><pre>";
		// print_r($id);
		// echo "</pre></br>";
		
		$requete = $this->ecrireRequeteRead($id);
		
		// echo "<br/><b>model::lineExist() -> \$requete :</b> " . $requete . "<br/>";
		
		
		
		$db = $this->connexion();
		$tableau = $db->query($requete);
		$ligne = $tableau->fetch(PDO::FETCH_ASSOC);
		$tableau->closeCursor();
		$db = null;
		
		
		/*
		 * Optimisation :
		 * Si la ligne existe, alors on retourne directement la ligne récupérée pour pas refaire un autre read identique dans read().
		 * Sinon on retourne simplement false.
		 */
		
		
		return($ligne);
	}
	
	
	
	
	
	
	
	
	
	/*
	* read -	Permet de lire un enregistrement dans la base
	*			Les noms de colonnes sont automatiquement récupérés en fonction des attributs de l'objet
	*			(cela nécessite que l'objet possède des attributs de même nom que les colonnes dans la base
	*			Le résultat est stocké dans l'objet.
	*
	*			Aucune requête n'est faite directement dans le read : comme on utilise lineExist et que la
	*			requête est complètement identique, on récupère ce que lineExist retourne directement, ça fait
	*			une requête de moins à faire.
	*
	* @return	Tableau à deux dimensions : [<nomcolonne>][<valeurcolonne>]
	*/
	public function read($id = null, $profondeurRecherche = -1, $clesOmises = array()){
		// echo "<br/><div style='margin:1em;background:linear-gradient(to bottom, lightgrey, grey);'>ENTREE DANS model::read()";
		
		if(is_null($id)){
			$id = $this->{$this->pk};
			// echo "L'ID : " . $this->{$this->pk};
			// var_dump($this);
		}
		// echo "<br/><b>model::read() -> $this->table \$id -> :</b><pre>";
		// print_r($id);
		// echo "</pre></br>";
		
		$resultat = $this->lineExist($id);
		
		// if($resultat){
			// $requete = $this->ecrireRequeteRead($id);
			
			// echo "<font color='red'>Requete (read())</font><br/>";
			// $db = $this->connexion();
			// $rep = $db->query($requete);
			// $db = null;
			// $result = $rep->fetch(PDO::FETCH_ASSOC);
			// $rep->closeCursor();
			
			/*
			 * OPTIMISATION :
			 * La partie ci-dessus est volontairement commentée : comme on a déjà fait une requête dans le lineExist,
			 * on récupère directement ce qu'il nous a retourné puisque la requête aurait été identique. Ca fait une
			 * requête de moins à faire comme ça.
			 */
			
			
		if($resultat){
		
			// echo "<br/><b>model::read() -> \$resultat -> :</b><pre>";
			// print_r($resultat);
			// echo "</pre><br/>";
			
			// foreach($result as $cle=>$valeur){
			foreach($resultat as $cle=>$valeur){
				$this->$cle = $valeur;
			}
			
			// echo "Clé : " . $this->fk;
			
			if($this->fk != null){
				// if($profondeurRecherche > -1){
					// echo "<br/><b><i><font color='#28f' size='6'>Profondeur recherche (avant) : " . $profondeurRecherche . "</font></i></b>";
					 $profondeurRecherche = $this->doBelongsToAssoc($profondeurRecherche, $clesOmises);
					// echo "<br/><b><i><font color='#8bf' size='6'>Profondeur recherche (après): " . $profondeurRecherche . "</font></i></b>";
				// }
				
				
			}
				// echo "<br/><b>objet :</b><pre>";
				// print_r($this);
				// echo "</pre><br/>";
		}else{
			die("Enregistrement introuvable !");
		}
		
		// echo "<br/>SORTIE DE model::read()</div>";
		return $resultat;
	}
	
	
	
	
	
	
	
	
	
	/*
	* find -	Lance une recherche de plusieurs enregistrements et leurs clés étrangères associées en fonction des critères spécifiés.
	*			
	*
	* @param	$condition				Spécifie la condition de la recherche (WHERE...)
	* @param	$ordre					Spécifie le tri des résultats (ORDER BY...)
	* @param	$nbresultats			Limite le nombre de résultats retournés (limit)
	* @param	$clesAOmettre			Indiquer quelles clés étrangères ne nous intéressent pas pour raccourcir la recherche
	* @param	$profondeurRecherche	Spécifie à quelle 'pronfondeur' rechercher les clés étrangères dans la base. En gros ça indique
	*									jusqu'à combien de clés étrangères récupérées on arrête de chercher les clés étrangères des tables
	*									étrangères déjà récupérées.
	*
	* @return	Tableau des enregistrements correspondant à la requête
	*/
	public function find($condition = null, $ordre = null, $nbresultats = null, $clesAOmettre = array(), $profondeurRecherche = -1){
		// echo "<hr/>ENTREE DANS $this->table::find()";
		
		if($clesAOmettre != null){
			$clesOmises = array_merge($clesAOmettre, $this->attribtech);	// Pour raccourcir la recherche dans la base on peut préciser quelles clés étrangères ne pas chercher
		}else{
			$clesOmises = $this->attribtech;
		}
		
		
		// echo "<pre>\model::find->\$clesOmises : ";
		// print_r($clesOmises);
		// echo "</pre>";
		
		
		
		
		$requete = "SELECT * FROM {$this->table}";
		
		
		if($condition != null){				// Voir s'il y a une condition
			$requete = $requete . " WHERE " . $condition;
		}
		
		
		if($ordre != null){					// Voir s'il y a un ordre
			$requete = $requete . " ORDER BY " . $ordre;
		}
		
		
		if($nbresultats != null){			// Voir si on veut un nombre précis d'enregistrements
			$requete = $requete . " limit " . $nbresultats;
		}
		
		
		// echo "<hr/>model::find() -> \$requete : <b>" . $requete . "</b><br/>";
		
		
		
		$base = $this->connexion();
		$tableau = $base->query($requete);
		$base = null;
		
		
		
		$tab = null;
		
		
		// echo "<pre><br/>";
		// print_r($tableau);
		// echo "</pre>";
		
		// $i = 0;
		if($tableau){						// On vérifie si la requête nous a bien retourné quelque chose
			while ($result = $tableau->fetch()){
				// $i++;
				// echo "<div style='background-color:#bbb;margin:20px;padding:20px;'> <h2>Fetch n°" . $i . "</h2>";
				// echo "<b>model::find() : \$result :</b> <pre>";
				// print_r($result);
				// echo "</pre>";
				
				
				$objet = new $this->table;
				$objet->read($result, $profondeurRecherche, $clesOmises);
				$tab[] = $objet->toTableau($clesOmises);
				
				// echo "</div>";
			}
			$tableau->closeCursor();
		}
		// else{
			// die("<b>" . $requete . "</b> <br/> <br/>ERREUR FATALE : La requête n'a rien retourné.");
		// }
		
		// echo "<div style='background-color:#aaa;margin:20px;padding:20px;'>";
		// echo "<b>Fin de model::find() : \$tab :</b> <pre>";
		// print_r($tab);
		// echo "</pre></div>";
		
		
		// echo "<br/>SORTIE DE model::find()";
		return $tab;
	}
	
	
	
	
	
	
	
	
	
	/*
	* toTableau - Retourne un objet sous forme de tableau (sans ses attributs techniques ni les attributs spécifiés en paramètres)
	*
	* @param	$clesOmises	Indique quelles clés étrangères ne nous intéressent afin de raccourcir la recherche
	*
	* @return	Tableau des enregistrements correspondant à la requête
	*/
	public function toTableau($clesOmises = array()){
		// echo "<pre>\model::toTableau->\$clesOmises : ";
		// print_r($clesOmises);
		// echo "</pre>";
		
		// echo "<br/>ENTREE DANS model::toTableau()";
		$tableau = array();
		
		foreach($this as $nomColonne => $valeurColonne){
			if(!in_array($nomColonne, $clesOmises)){			// Si la clé n'est pas un attribut technique
				if(is_object($valeurColonne)){
					 $valeurColonne = $valeurColonne->toTableau();
				}
				$tableau[$nomColonne] = $valeurColonne;			// Alors ajouter sa valeur au tableau à l'index cle
			}
		}
		// echo "<br/>SORTIE DE model::toTableau()";
		return $tableau;
	}
	
	
	
	
	
	
	
	
	
	/*
	* update -	Met à jour un enregistrement dans la base (en fonction des attributs de l'objet)
	*/
	public function update(){
		$propriete = "";
		$valeur = "";
		
		$attribtechTEMP = $this->attribtech;		
		$attribtechTEMP[] = $this->pk;
		/*
		*  Même fonctionnement que dans le create :	on ajoute la clé primaire dans les attributs qu'on ne veut pas ajouter à la table
		*  Sauf que là, on sait d'avance qu'on ne va pas modifier l'ID (vu que c'est un UPDATE).
		*  Donc pour ne pas modifier attribtech, vu qu'on veut ajouter l'ID temporairement, on l'ajoute dans une copie du tableau, et c'est cette copie qu'on utilisera.
		*/
		
		
		foreach ($this as $nomColonne=>$saValeur){
			// Même fonctionnement que dans le create : on fait la liste des clés, et on n'ajoute que les attributs métiers (donc tout sauf ce qui est listé dans attribtech)
			if(!in_array($nomColonne, $attribtechTEMP)){
				$propriete = $propriete."$nomColonne = '$saValeur' ,";
			}
		}
		
		$reqUpdate = "UPDATE {$this->table} SET ";			// Début requête
		
		$reqUpdate = $reqUpdate . $propriete;				// Ajout, dans la requête, de la liste des propriétés et des clés qui y correspondent (ce qu'on a fait avec le foreach)
		$reqUpdate = substr($reqUpdate, 0, -1);
		
		/*
		*  On a accès au NOM de la clé primaire, mais pas sa VALEUR... enfin pas directement. Mais on en a besoin dans la requête pour le WHERE.
		*  Par exemple on aurait pu vouloir écrire :
		*		$this->idutilisateur
		*  Mais on n'a pas "idutilisateur", puisqu'on ne sait pas si on est sur un utilisateur, un sujet... vu qu'ici, on reste générique.
		*  (en gros, ça peut être  idutilisateur,  idsujet,  idpost,  idnimportequoienfait,  on ne peut pas le deviner d'ici)
		*
		*  Alors astuce :	$this->pk   nous donne le nom de la PK. Donc, on va utiliser ça pour faire en sorte
		*					que le PHP écrive $this->idutilisateur.
		*
		*  Voilà donc ce qu'il va se passer :	     "$this->{$this->pk}"
		*										  =  "$this->idutilisateur"
		*										  =  "1"
		*/
		$valeurPk = "{$this->{$this->pk}}";
		
		$reqUpdate = $reqUpdate . " WHERE $this->pk = $valeurPk";
		echo "Requête Update : <br/>" . $reqUpdate;
		
		
		$base = $this->connexion();
		$base->query($reqUpdate);
		$base = null;
	}
	
	
	
	
	
	
	
	
	
	/*
	* delete -	Supprime l'enregistrement de la base correspondant à l'objet courrant
	*/
	public function delete(){
		$valeurPk = "{$this->{$this->pk}}";
		$req= "DELETE FROM {$this->table} WHERE {$this->pk} =  $valeurPk";
		echo $req;
		
		$base = $this->connexion();
		$base->query($req);
		$base = null;
	}
}

?>