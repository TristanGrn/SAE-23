<?php 
include('fonctions.php');
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
	<?php
	aff_header();
	?>
	<nav>
		<h1>NAVBAR DANS HEADER ?</h1>
		<!-- BARRE DE NAVIGATION AVEC ACCES AUX ONGLETS -->
	</nav>
	<div class="container justify-content-center">
		<article class="border">
            <?php
            if(empty($_SESSION)){
            ?>
        <h1 class="text-center">Connexion</h1>
            <form class="form-example"id="connexion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
            }
            else{
                echo('vous êtes déja connecté');
                
                echo 'REDIRECT VERS PAGE ACCUEIL';
            }
            ($_POST); ?>
	</div>

	<footer>
			<p>Pied de la page <!-- A COMPLETER --></p>
		</footer>
</body>
</html>

