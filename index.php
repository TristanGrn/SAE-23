<?php
include "fonctions.php";
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
</head>

<body>
	<?php
 	aff_header();
	if (isset($_GET["action"]) && $_GET["action"] == "logout" && !empty($_SESSION)) {
		$_SESSION = [];
		session_destroy();
		header("Location: connexion.php");
		// redirect("index.php", 0);
		}
	?>
	
	<nav>
		<h1>NAVIGATION DANS LE HEADER ?</h1>
		<!-- BARRE DE NAVIGATION AVEC ACCES AUX ONGLETS -->
	</nav>
	<!-- ARTICLE POUR ZONE PRINCIPALE ? -->
	
	<div class="container">
		<div class="row">
			<article class="col-lg-1 border"></article>
			<article class="col-lg-10 border ">
				TEST 
			</article>
			<article class="col-lg-1 border"></article>
		</div>
	</div>

	<?php footer() ?>
</body>
</html>