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
	<title>Suppression</title>
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
            echo "<h1 class='text-center'>Suppression</h1>";
            $captcha_valide=false;
            $A = 1;
            if ($captcha_valide==false) {
                // Afficher le formulaire du captcha
                $afficherFormulaire=True;
                if ($afficherFormulaire==True){
                    ?>
                    <form action="suppression.php" method="post" class="text-center">
                        <input type="text" name="captcha" placeholder="Renseigner le captcha"/>
                        <input type="submit"/>
                        <img src="captcha.php" onclick="this.src='.captcha.php?.' + Math.random();" alt="captcha" />
                    </form>
                    <?php
                    $afficherFormulaire=False;
                }
                
                if(isset($_POST['captcha'])){
                    if($_POST['captcha']==$_SESSION['code']){
                        $captcha_valide=true;
                    }
                    else{
                        $captcha_valide=false;
                    }
                } 
            }
            if ($captcha_valide==True){
                echo "Le captcha est correct";
                $_POST = array(); // Réinitialise $_POST en tant que tableau vide
                $tab = "Produits";
                affichageSuppression($tab);
                if (empty($_POST)){
                    FormulaireSuppressionProduit();
                    //var_dump($_POST);
                    if (!empty($_POST)){
                        supprimerProduit($_POST['idP']);
                        $tab = "Produits";
                        affichage($tab);  
                    }
                }
            } 
        }
        ?>
    </div>
<?php footer(); ?>
</body>
</html>