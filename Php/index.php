<?php
session_start();
include "fonctions.php";
include "formulaire.php";
?>
<!-- Auteur : Granjeon Tristan -->
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
	<!-- Feuille de style non bootstrap : -->
	<link rel="stylesheet" href="../Bootstrap/style.css" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js"></script>
	<script type="text/javascript" src="../Scripts/scripts.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
<?php
	// affichage du header
 	aff_header();
	if (isset($_GET["action"]) && $_GET["action"] == "logout" && !empty($_SESSION)) {
		$_SESSION = [];
		session_destroy();
		// Si deconnexion, redirection vers page de connexion
		echo '<script>window.location.href = "connexion.php";</script>';
        exit();
		}

	if (empty($_SESSION)) {
		//  Si pas de session alors redirection vers conenxion.php
		echo '<script>window.location.href = "connexion.php";</script>';
        exit();
	}

	// Sinon affichage accueil
	else {
?>
	<h1>Découvrez notre séléction plein air :</h1>
	<br>
	<div class="container justify-content-center">
		<div class="row">
			<article class="col-3 sticky">
				<!-- Affichage d'une publiciée -->
			<img src="../Images/Pub.png" class='img-fluid ' alt=".$ligne['Photo']." > 	
			</article>
			<article class="col-6 ">
				<!-- Affichage de la table des produits existants -->
				<?php affichage("Produits") ?>
			</article>
			<article class="col-3">
			</article>
		</div>
	</div>
	<!-- Affichage du footer -->
	<?php 
	}
	footer() ?>
	
</body>
</html>