<?php

// Fonction pour connaitre la table que l'utilisateur souhaite modifier
function form_choix_table(){
    $bdd = new PDO("sqlite:bdd/Ventes.sqlite");
    // Ecriture de la requete
    $rq ="SELECT name FROM sqlite_schema WHERE type='table' AND name != 'sqlite_sequence'";
    // On effectue la requete
    $resultat = $bdd->query($rq);
    $tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="text-center">
		<fieldset> 
			<label for="id_tab">Table à modifier :</label> 
			<select id="id_tab" name="table" size="1">
				<?php
				// générer la liste des options à partir de $tableau_assoc
				foreach ($tableau_assoc as $table) {
					echo '<option value="'.$table["name"].'">'.$table["name"].'</option>';
				}
				?>
			</select>
			<input type="submit" value="Modifier"/>
		</fieldset>
	</form>

<?php
}



// Fonction pour connaitre l'element a modifier
function form_choix_elem($table){
	$bdd = new PDO("sqlite:bdd/Ventes.sqlite");
	// Ecriture de la requete
	if ($table == "Achat") {
	$rq = "SELECT $table.idC, $table.idP, Acheteurs.NomP AS NomA, Produits.NomP , $table.Qte 
		FROM $table 
		INNER JOIN Acheteurs ON Acheteurs.idC = $table.idC
		INNER JOIN Produits ON Produits.idP = $table.idP
		ORDER BY NomA";
	}
	else {
		$rq ="SELECT * FROM $table";
	}
	// On effectue la requete
	$resultat = $bdd->query($rq);
	$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="text-center">
		<fieldset> 
			<label for="id_tab">Table à modifier :</label> 
				<select id="id_elem" name="elem" size="1">
				<?php
				// en foncitno de la table affichage d'une liste différente
				foreach ($tableau_assoc as $table) {
					if (isset($table["idC"]) && isset($table["idP"])) {
						// NB : pour récuperer séparement l'idC de l'idP 
						// >>> $_POST['elem"][0] -> idC
						// >>> $_POST['elem'][1] -> idP

						echo '<option value="'.$table["idC"].';'.$table["idP"].'">Acheteur : '.$table["NomA"].' | Achat : '.$table["NomP"].'</option>';
					}
					elseif (isset($table["idP"])){
						echo '<option value="'.$table["idP"].'">'.$table["NomP"].'</option>';
					}
					else {
						echo '<option value="'.$table["idC"].'">'.$table["NomP"].'</option>';
					}
				}
				$table
				?>
			</select>
			<input type="submit" value="Modifier"/>
		</fieldset>
	</form>
	<?php 
}

// Fonction pour permetre à l'utilisateur 
function form_modification($table, $id){
	$bdd = new PDO("sqlite:bdd/Ventes.sqlite");
	if ($table == 'Achat') {
		/*
		Voir plus tard

		// NB: $id[0] = idC & $id[1] = idP
		$idC = $id[0];
		$idP = $id[1];

		$rq ="SELECT * FROM $table WHERE idC = $idC AND idP = $idP 
		INNER JOIN Acheteurs ON Acheteurs.idC = $table.idC
		INNER JOIN Produits ON Produits.idP = $table.idP";
		// Execution de la requete
		$resultat = $bdd->query($rq);
		$tableau_assoc = $resultat->fetch(PDO::FETCH_ASSOC);
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<fieldset> 
			<label for="id_mail">Adresse Mail : </label><input type="email" name="mail" id="id_mail" placeholder="@mail" required size="20" value="<?php echo $mail ?>" readonly /><br />
			<label for="id_rue">Rue : </label><input type="text" name="rue" id="id_rue" placeholder="adresse" required size="20" value="<?php echo $tableau_assoc['ADRESSE'] ?>"/><br />
			<label for="id_groupe">Groupe : </label>
			<input type="submit" value="modifier" name = "choix"/>
		</fieldset>
	</form>
	
	<?php
	*/
	}
	elseif ($table == 'Acheteurs') {
		$rq ="SELECT * FROM $table WHERE idC = $id";
		// Execution de la requete
		$resultat = $bdd->query($rq);
		$tableau_assoc = $resultat->fetch(PDO::FETCH_ASSOC);
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		
		<fieldset> 
			<label for="id_">Id acheteur :</label>
				<input type="text" name="idC" id="id_idC" required value="<?php echo $id ?>" readonly /><br />
			<label for="id_rue">Nom : </label>
				<input type="text" name="NomP" id="id_nom" placeholder="Nom" required value="<?php echo $tableau_assoc['NomP'] ?>"/><br />
			<label for="id_ville">Ville : </label>
				<input type="text" name="ville" id="id_ville" placeholder="Ville" required value="<?php echo $tableau_assoc['Ville'] ?>"/><br />
				<input type="submit" value="modifier"/>
		</fieldset>
	
	<?php
	}

	else{
		$rq ="SELECT * FROM $table WHERE idP = $id";
		// Execution de la requete
		$resultat = $bdd->query($rq);
		$tableau_assoc = $resultat->fetch(PDO::FETCH_ASSOC);
		var_dump($tableau_assoc);
		
	}

}

?>