<?php
include "fonctions.php";
include "formulaire.php";
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Connexion</title>
  <!-- Feuille de style non bootstrap : -->
  <link href="./Bootstrap/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Import script pour fonctionnement reCaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?hl=fr"></script>
    <script type="text/javascript" src="scripts.js"></script>

</head>

<body>
  <!-- Affichage du header-->
	<?php aff_header(); ?>
  <div class="container">
    <!-- REMOVE BORDER BOOTSTRAP ET AJOUT BORDER CSS PROPRE -->
    <?php 
    if (empty($_SESSION)){
        echo "<h1 class='text-center'>ERREUR</h1>";
        echo "<p class='text-center'>Vous n'êtes pas connecté.e</p>";
        header("Refresh: 2; URL = index.php");
    }
        
    elseif (!($_SESSION['statut'] == 'admin')) {
        echo "<h1 class='text-center'>ERREUR</h1>";
        echo "<p class='text-center'>Vous n'avez pas l'authorisation d'acceder à cette ressource</p>";    
        echo "<div class='d-flex justify-content-center'>";
            echo "<div class='spinner-border' role='status'>";
            echo "</div>";
          echo "</div>";
        header("Refresh: 2; URL = index.php");  
    }
    else {
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

          if ($_SESSION['table'] == 'Achat') {
            $IDs = get_IDs($_POST['elem']);
            form_modification($_SESSION['table'], $IDs);
          }

          else {
            form_modification($_SESSION['table'], $_POST['elem']);
          }

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