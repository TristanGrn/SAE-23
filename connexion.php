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
</head>

<body>
	<?php aff_header(); ?>
	<nav>
		<h1>NAVBAR DANS HEADER ?</h1>
		<!-- BARRE DE NAVIGATION AVEC ACCES AUX ONGLETS -->
	</nav>
	<div class="border container justify-content-center">
    <?php if (empty($_SESSION)) { ?>
      <article>
        <h1 class="text-center">Connexion</h1>
        <form class="form" id="login" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
          <fieldset>
          <div class="form-group">
            <label for="login">Utilisateur :</label>
            <input class="form-control username" type="text" name="login" id="id_user" placeholder="Nom d'utilisateur" required size="10" />
          </div>
          <div class="form-group">
            <label for="id_pass">Mot de passe:</label>
            <input class="form-control password" type="password" name="pass" id="id_pass" placeholder="Mot de passe" required size="10" />
          </div>
          <button type="submit" class="btn btn-primary btn-customized mt-4" name="connect" value="Connexion">
            Connexion
          </button>
          <!-- SI boutton ne marche pas : 
          <input type="submit" name="connect" value="Connexion" /> -->
          </fieldset>
        </form>
        <?php
        if (!empty($_POST) && isset($_POST['login']) && isset($_POST['pass'])){
          if (Authentif($_POST['login'], $_POST['pass'])){
            $_SESSION['login'] = $_POST['login'];
            if (statut($_SESSION['login']) == "Admin") $_SESSION['statut'] = "admin";
            else $_SESSION['statut'] = "Utilisateur";
            header("Location: index.php");

            // Enregistrements des connexions dans fichier Logs
            $logs = fopen('Logs/logs.log', 'a+');
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
          else{
            echo "L'utilisateur ".$_POST['login']." n'existe pas ou le mot de passe entrée est erroné";

            // Enregistrements des connexions dans fichier Logs
            $logs = fopen('Logs/logs.log', 'a+');
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
    
      // FAIRE ELSE COMPTE INEXISTANT !!!!!!
      else {
        echo "<article>";
        echo "<h1 class='text-center'>Vous êtes déja connecté</h1>";
        // Redirection vers la page indexe.php si user deja connecté.e
        header("Refresh: 2; URL = index.php");
        echo "</article>";
      } ?>
    
	</div>

	<?php footer(); ?>

</body>
</html>