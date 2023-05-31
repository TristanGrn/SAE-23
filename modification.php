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
	<link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
  <!-- Feuille de style non bootstrap : -->
  <link href="./Bootstrap/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <!-- Affichage du header-->
	<?php aff_header(); ?>

	<div class="border container justify-content-center">
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

          elseif ($_SESSION['table'] == 'Acheteurs') {
            form_modification($_SESSION['table'], $_POST['elem']);
        }

          else {
            form_modification($_SESSION['table'], $_POST['elem']);
          }

        }

        if (!empty($_POST) && isset($_POST['idC']) && isset($_POST['NomP']) && isset($_POST['ville'])) {
          $tab = modif_acheteur($_SESSION['table'], $_POST['idC'], $_POST['NomP'], $_POST['ville']);
          affichage($_SESSION['table']);

        if ($tab == 0) {
          echo "ERREUR :  Le client '".$_POST['NomP']."' n'a pas pu être modifié";
        }
        else {
          echo "<p>Les modifications de  '".$_POST['NomP']."' ont été enregistrées</p>";
        }
      }
        ?>
       
<?php

    }
    ?>
    
  </div>
<!-- Affichage du footer -->
	<?php footer(); ?>

</body>
</html>