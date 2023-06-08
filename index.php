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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js"></script>
	<script type="text/javascript" src="scripts.js"></script>
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
	<h1> REFAIRE FOOTER PROPRE</h1>
	<div class="container justify-content-center">
		<div class="row border">
			<!-- REMOVE BORDER BOOTSTRAP ET AJOUT BORDER CSS PROPRE -->
			<article class="col-lg-3  "></article>
			<article class="col-lg-6  ">
				<?php affichage("Produits") ?>
			</article>
			<article class="col-lg-3 "></article>
		</div>
	</div>
	<!-- Affichage du footer -->
	<?php 
	}
	footer() ?>
	
</body>
</html>