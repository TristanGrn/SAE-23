<?php
session_start();
include "fonctions.php";
include "formulaire.php";
?>
<!-- Auteur : Keroulas Jules -->
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Insertion</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
	<!-- Feuille de style non bootstrap : -->
	<link href="../Bootstrap/style.css" rel="stylesheet" type="text/css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Affichage du header-->
    <?php aff_header(); ?>
    <div class="container">
        <?php
        // SI pas de session alors rreditrection vers page de connexion
        if (empty($_SESSION)){
            echo '<script>window.location.href = "connexion.php";</script>';
            exit();
        }
    
        // Si pas admin alors redirection vers accueil
        elseif (!($_SESSION['statut'] == 'admin')) {
            echo "<h1 class='text-center'>ERREUR</h1>";
            echo "<p class='text-center'>Vous n'avez pas l'authorisation d'acceder à cette ressource</p>";    
            echo "<div class='d-flex justify-content-center'>";
            echo "<div class='spinner-border' role='status'>";
            echo "</div>";
            echo "</div>";
            echo '<script>window.location.href = "index.php";</script>';
            exit();
        }
        else {
            echo "<h1 class='text-center'>Insertion</h1>";
            ?>
            <?php
            $tab = "Produits";
            FormulaireAjoutProduit();
            if (!empty($_POST)){
                ajouterProduit($_POST["NomP"],$_POST["prix"],$_POST["illustration"]);
            }
        }
        ?>
    </div>
<?php footer(); ?>
</body>
</html>