<?php
include "fonctions.php";
include "formulaire.php";
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
	<!-- Feuille de style non bootstrap : -->
	<link href="./Bootstrap/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
	// affichage du header
 	aff_header();
	if (isset($_GET["action"]) && $_GET["action"] == "logout" && !empty($_SESSION)) {
		$_SESSION = [];
		session_destroy();
		// Si deconnexion, redirection vers page de connexion
		header("Location: connexion.php");
		}

	if (empty($_SESSION)) {
		header("Location: connexion.php");
	}
	else {
	
	?>

	<!-- ARTICLE POUR ZONE PRINCIPALE ? -->
	
	<div class="container">
		<div class="row">
			<!-- REMOVE BORDER BOOTSTRAP ET AJOUT BORDER CSS PROPRE -->
			<article class="col-lg-1 border"></article>
			<article class="col-lg-10 border ">
				TEST 
			</article>
			<article class="col-lg-1 border"></article>
		</div>
	</div>
	<!-- Affichage du footer -->
	<?php 
	}
	footer() ?>
	
</body>
</html>