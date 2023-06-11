<?php

// Formulaire pour connaitre la table que l'utilisateur souhaite modifier
function form_choix_table(){
    $bdd = new PDO("sqlite:../bdd/Ventes.sqlite");
    // Ecriture de la requete
    $rq ="SELECT name FROM sqlite_schema WHERE type='table' AND name != 'sqlite_sequence' AND name != 'Achat'";
    // On effectue la requete
    $resultat = $bdd->query($rq);
    $tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
    ?>

	<!-- Affichage du formulaire sous forme de menu dropdown -->
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
			<input type="submit" value="Modifier">
		</fieldset>
	</form>

<?php
}

// Formulaire pour connaitre l'element a modifier
function form_choix_elem($table){
	$bdd = new PDO("sqlite:../bdd/Ventes.sqlite");
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
		<!-- Affichage du formulaire sous forme de menu dropdown -->
		<!-- Le formulaire ne pourra etre envoyé si et seulement si le captha a été validé -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="text-center"  onsubmit="return valideCaptcha();">
			<fieldset> 
				<label for="id_elem">Element à modifier :</label> 
					<select id="id_elem" name="elem" size="1">
					<?php
					// en fonction de la table affichage d'une liste différente
					foreach ($tableau_assoc as $table) {
						// Si table produits alors affichage des articles
						if (isset($table["idP"])){
							echo '<option value="'.$table["idP"].'">'.$table["NomP"].'</option>';
						}
						//Sinon affichage des clients acheteurs
						else {
							echo '<option value="'.$table["idC"].'">'.$table["NomP"].'</option>';
						}
					}
					$table
					?>
				</select>
				<input type="submit" value="Modifier">
				<!-- Utilisation d'un captcha avant d'envoyer le formulaire -->
				<div class="g-recaptcha" data-sitekey="6Le1-mUmAAAAAEazgWka4ZdGLhJh4kM_z21jUvLn"></div>
			</fieldset>
		</form>
	<?php 
}

// Formulaire pour permetre à l'utilisateur de modifier l'element choisis
function form_modification($table, $id){
	$bdd = new PDO("sqlite:../bdd/Ventes.sqlite");
	// Modification de la table des clients
	if ($table == 'Acheteurs') {
		// Si la table Acheteurs a été selectionné alors formulaire prérempli avec les infos
		// Du client choisis
		$rq ="SELECT * FROM $table WHERE idC = $id";
		// Execution de la requete
		$resultat = $bdd->query($rq);
		$tableau_assoc = $resultat->fetch(PDO::FETCH_ASSOC);
		?> 
		<!-- Affichage du formulaire prérempli -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="text-center">
		<fieldset> 
			<label for="id_idC">Id acheteur :</label>
				<input type="text" name="idC" id="id_idC" size="14" required value="<?php echo $id ?>" readonly ><br>
			<label for="id_nom">Nom : </label>
				<input type="text" name="NomP" id="id_nom" size="20" placeholder="Nom" required value="<?php echo $tableau_assoc['NomP'] ?>"><br>
			<label for="id_ville">Ville : </label>
				<input type="text" name="ville" id="id_ville" size="21" placeholder="Ville" required value="<?php echo $tableau_assoc['Ville'] ?>"><br>
			<input type="submit" value="modifier">
		</fieldset>
		</form>
	
	
	<?php
	}

	// Modification de la table des produits
	else{
		// Si la table Produits a été selectionné alors formulaire prérempli avec les infos
		// Du produit choisis
		$rq ="SELECT * FROM $table WHERE idP = $id";
		// Execution de la requete
		$resultat = $bdd->query($rq);
		$tableau_assoc = $resultat->fetch(PDO::FETCH_ASSOC);
		?>

		<!-- Affichage du formulaire prérempli -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
		<fieldset> 
			<label for="id_idP">Id Produit :</label>
				<input type="text" name="idP" id="id_idP" size="26" required value="<?php echo $id ?>" readonly ><br >
			<label for="id_nom">Nom du produit : </label>
				<input type="text" name="NomP" id="id_nom" size="20" placeholder="Nom" required value="<?php echo $tableau_assoc['NomP'] ?>"><br >
			<label for="id_prix">Prix : </label>
				<input type="number" step="0.01" name="Prix" id="id_prix"  placeholder="Prix" required value="<?php echo $tableau_assoc['Prix'] ?>"><br >
			<label for="id_image">Illustration (.jpg) : </label>
				<input type="text" name="Image" id="id_image" size="20" placeholder="Image" required value="<?php echo $tableau_assoc['Illustration'] ?>"><br >
				<small class="fw-light">NB : Renseignez uniquement le nom de l'image sans son extention</small>
				<br>
				<small class="fw-light">NB2 : veillez à ce que l'image soit déja présente dans le dossier avant de modifier ce champ</small>
				<br>
				<small class="fw-light">Si le nom d'image que vous entrez est incorrect, si vous renseignez son extention, si l'image présente dans le dossier
					 possède une mauvaise extention, elle ne pourra être affichée</small>
				<br>
			<input type="submit" value="modifier">
		</fieldset>
		</form>
	
	<?php
	}

}

?>