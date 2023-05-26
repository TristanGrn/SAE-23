<?php
include "fonctions.php";
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Connexion</title>
	<link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
  <link href="./Bootstrap/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <!-- Affichage du header-->
	<?php aff_header(); ?>
	<nav>
		<h1>NAVBAR DANS HEADER ?</h1>
		<!-- BARRE DE NAVIGATION AVEC ACCES AUX ONGLETS -->
	</nav>
	<div class="border container justify-content-center">
    <?php 
    if (empty($_SESSION)){
        echo "<h1 class='text-center'>ERREUR</h1>";
        echo "<p class='text-center'>Vous n'avez pas l'authorisation d'acceder à cette ressource</p>";
        echo "<h1> FAIRE REDIRECT !!! </h1>";
    }
    elseif (!($_SESSION['statut'] == 'admin')) {
        echo "<h1 class='text-center'>ERREUR</h1>";
        echo "<p class='text-center'>Vous n'avez pas l'authorisation d'acceder à cette ressource</p>";    
        echo "<h1> FAIRE REDIRECT !!! </h1>";   
    }
    else {
        echo "<h1 class='text-center'>AFFICHER LE MENU</h1>";
    }

    
    ?>
    
	</div>
<!-- Affichage du footer -->
	<?php footer(); ?>

</body>
</html>