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

	<div class=" container justify-content-center">
    <!-- Si pas de session alors affichage formulaire connexion-->
    <?php if (empty($_SESSION)) { ?>
      <article>
        <h1 class="text-center">Connexion</h1>
        <form class="form" id="login" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
          <fieldset>
          <div class="form-group">
            <label for="id_user">Utilisateur :</label>
            <input class="form-control username" type="text" name="login" id="id_user" placeholder="Nom d'utilisateur" required size="10">
          </div>
          <div class="form-group">
            <label for="id_pass">Mot de passe:</label>
            <input class="form-control password" type="password" name="pass" id="id_pass" placeholder="Mot de passe" required size="10">
          </div>
          <button type="submit" class="btn btn-primary btn-customized mt-4" name="connect" value="Connexion">
            Connexion
          </button>
          </fieldset>
        </form>
        <?php
        //  SI connexion OK alors redirections vers accueil et enregistrement dans logs
        if (!empty($_POST) && isset($_POST['login']) && isset($_POST['pass'])){
          if (Authentif($_POST['login'], $_POST['pass'])){
            $_SESSION['login'] = $_POST['login'];
            if (statut($_SESSION['login']) == "Admin") $_SESSION['statut'] = "admin";
            else $_SESSION['statut'] = "Utilisateur";
            header("Location: index.php");
		  exit();

            // Enregistrements des connexions dans fichier Logs
            $logs = fopen('../Logs/logs.log', 'a+');
            // Infos de la connexion
            fputs($logs,"Connexion : {
              Login : ".$_POST['login']."
              Adresse IP : ".$_SERVER['REMOTE_ADDR']."
              Date : ".date('l jS \of F Y h:i:s A')."
              Statut : ".$_SESSION['statut']
            ."}");
            fputs($logs, "\n\r");
            // Fermeture fichier
            
          }
          // Si connexion non OK alors info erreur et enregistrement dans logs
          else{
            echo "L'utilisateur ".$_POST['login']." n'existe pas ou le mot de passe entrée est erroné";

            // Enregistrements des connexions dans fichier Logs
            $logs = fopen('../Logs/logs.log', 'a+');
            // Infos de la connexion
            fputs($logs,"Tentative de connexion : {
              Login : ".$_POST['login']."
              Adresse IP : ".$_SERVER['REMOTE_ADDR']."
              Date : ".date('l jS \of F Y h:i:s A')
            ."}");
            fputs($logs, "\n\r");
            // Fermeture fichier
          }
        }
        echo "</article>";
      }
    
      else {
        ?>
        <!-- Si deja connecté alors info et redirection vers accueil-->
        <article>
          <h1 class='text-center'>Vous êtes déja connecté</h1>
          <p class='text-center'>Redirection en cours</p>
          <div class='d-flex justify-content-center'>
            <div class='spinner-border' role='status'>
            </div>
          </div>
        </article>
        <?php
        // Redirection vers la page index.php
        header("Refresh: 2; URL = index.php");
	      exit();
      } ?>
    
	</div>
<!-- Affichage du footer -->
	<?php footer(); ?>

</body>
</html>
