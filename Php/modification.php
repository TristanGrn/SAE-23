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
	<title>Modification</title>
  <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
	<!-- Feuille de style non bootstrap : -->
	<link href="../Bootstrap/style.css" rel="stylesheet" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://www.google.com/recaptcha/api.js"></script>
	<script type="text/javascript" src="../Scripts/scripts.js"></script>

</head>

<body class="d-flex flex-column min-vh-100">
  <!-- Affichage du header-->
	<?php aff_header(); ?>
  <div class="container">
    <?php 
    // SI pas de session alors redirection vers page de connexion
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
      // Affichage des elements de modification
        echo "<h1 class='text-center'>Modification</h1>";
        if (empty($_POST)) {
          // Ici, la fonction renvoie le nom de la table (Ex: Acheteurs)
          form_choix_table();
        }

        if (isset($_POST['table']) && !isset($_POST["elem"]) ){
          $_SESSION['table'] = $_POST['table'];
          $tab = $_SESSION['table'];
          form_choix_elem($tab);
        }

        if (isset($_POST['elem'])) {
          form_modification($_SESSION['table'], $_POST['elem']);
        }

        // Affichage dans la cas de modification de la table acheteurs
        if (!empty($_POST) && isset($_POST['idC']) && isset($_POST['NomP']) && isset($_POST['ville'])) {
          $tab = modif_acheteur($_SESSION['table'], $_POST['idC'], $_POST['NomP'], $_POST['ville']);

          if ($tab == 0) {
            echo "<strong>ERREUR :  Le client '".$_POST['NomP']."' n'a pas pu être modifié</strong>";
          }
          else {
            echo "<strong>Les modifications de  '".$_POST['NomP']."' ont été enregistrées :</strong>";
          }
          affichage($_SESSION['table']);
        }

        // Affichage dans la cas de modification de la table Produits
        if (!empty($_POST) && isset($_POST['idP']) && isset($_POST['NomP']) && isset($_POST['Prix']) && isset($_POST['Image'])) {
          $tab = modif_produits($_SESSION['table'], $_POST['idP'], $_POST['NomP'], $_POST['Prix'], $_POST['Image']);
          if ($tab == 0) {
            echo "<strong>ERREUR :  Le produit '".$_POST['NomP']."' n'a pas pu être modifié : </strong>";
          }
          else {
            echo "<strong>Les modifications du produit  '".$_POST['NomP']."' ont été enregistrées</strong>";
          }
          affichage($_SESSION['table']);
        }
    }
    ?>
  </div>
    
<!-- Affichage du footer -->
	<?php footer(); ?>

</body>
</html>