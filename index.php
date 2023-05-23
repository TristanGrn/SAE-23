<?php 
include('fonctions.php');
session_start();
session_destroy();
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
	if (isset($_GET['action']) && $_GET['action'] == 'logout' && !empty($_SESSION)) {
		$_SESSION = array();
		session_destroy();
		// redirect("index.php", 0);
	}
	?>
	
	<nav>
		<h1>NAVIGATION DANS LE HEADER ?</h1>
		<!-- BARRE DE NAVIGATION AVEC ACCES AUX ONGLETS -->
	</nav>
	<!-- ARTICLE POUR ZONE PRINCIPALE ? -->
	
	<div class="row">
		<article class="col-lg-1 border"></article>
		<article class="col-lg-10 border ">
			TEST 
		</article>
		<article classs="col-lg-1 border"></article>

	</div>

	<footer>
			<p>Pied de la page <!-- A COMPLETER --></p>
		</footer>
</body>
</html>

