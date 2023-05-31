<?php
// Création du header avec barre de navigation
function aff_header(){
    ?>
    <header class="p-3 bg-dark text-white">
    	<div class="row align-items-center">
    		<div class="col-lg-8 nav-bar">
                <nav class="navbar sticky-top navbar-expand-md navbar-dark" >
                        
                        <?php 
                        // Si Utilisateur connecté alors affichage boutton accès accueil
                        if (!empty($_SESSION)) {
                            ?>
                            <ul class="navbar-nav me-auto mb-2 mb-md-0 navigation">
                                <li class="nav-item">
                                    <a href="index.php" class="nav-link active"> Accueil </a>
                                </li>
						
						<?php
                        // Si admin alors affichage des options d'administration sinon non-affichage 
                            if ($_SESSION['statut'] == 'admin') {
                                ?>
                                <li>
                                    <a class='nav-link'> Option d'administration :</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link active"> Inserer un élément</a>
                                </li>
                                <li class="nav-item">
                                    <a href="modification.php" class="nav-link active"> Modifier un élément </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link active"> Supprimer un élément </a>
                                </li>
                            <?php    
                            }
                        }
                        ?>
						
                </nav>
    		</div>
    		
   			<div class="col-lg-4">
                <!-- Affichage du boutton connexion diffère si user connecté ou non -->
				<?php if (empty($_SESSION)) { ?>
                    <div class="row align-items-center">
                        <div class="col-lg-8 text-end ">
                            Vous n`êtes pas connecté.e
                        </div>
                        <div class="col-lg-4">
			                <a href="connexion.php" class="btn btn-primary text-end">
					            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
					                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
					            </svg>
                	             Connexion
             		        </a>
                        </div>
                    </div>
                <?php }
                else { ?>
                    <div class="row align-items-center">
                        <div class="col-lg-8 text-end">
                            <?php echo "Bienvenue " . $_SESSION["login"]; ?>
                        </div>
                        <div class="col-lg-4">
                            <a href="index.php?action=logout" class="btn btn-danger text-end">
					           	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
						            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
						        </svg>
                		         Déconnexion
             			    </a>
                        </div>
                    </div>
                    <?php } ?>
		    </div> 
        </div>
  </header>
  <br>
<?php
}

// Création du footer
function footer(){
    echo "
    <footer>
			<p>Pied de la page A COMPLETER</p>
	</footer>";
    
}

function affichage($tab){
    $bdd = new PDO("sqlite:bdd/Ventes.sqlite");
    $rq = "SELECT *  FROM $tab";
    $resultat = $bdd->query($rq);
    $tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
    echo '<table class="table">';	
	echo '<tr>';
		foreach($tableau_assoc[0] as $colonne=>$value){	
            echo '<th>'.$colonne.'</th>';		
        }
            echo '</tr>';
            // le corps de la table
            foreach($tableau_assoc as $ligne){
                echo '<tr>';
                foreach($ligne as $elem){		
                    echo "<td>$elem</td>";		
                }
                echo "</tr>";
            }
		echo '</table>';

}

// Authentification de l'utilisateur
function Authentif($user, $pass){
    $reussite = false;
    $bdd = new PDO("sqlite:bdd/Comptes.sqlite");
    $user = $bdd->quote($user);
    $pass = $bdd->quote($pass);
    // Ecriture de la requete
    $rq ="SELECT NOM_USER, MDP FROM Users WHERE NOM_USER = " .$user ." AND MDP = " .$pass;
    // On effectue la requete
    $resultat = $bdd->query($rq);
    $tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
    if(sizeof($tableau_assoc)!=0) $reussite = true;
    return $reussite;
}

// Récuperation du statut de l'utilisateur
function statut($login){
    $bdd = new PDO("sqlite:bdd/Comptes.sqlite");
    $login = $bdd->quote($login);
    // Ecriture de la requete
    $rq ="SELECT Statut FROM Users WHERE NOM_USER =".$login;
    // On effectue la requete
    $resultat = $bdd->query($rq);
    $tableau_assoc = $resultat->fetch(PDO::FETCH_ASSOC);
    $statut = $tableau_assoc['Statut'];
    return $statut;
}

// Fonction pour récuper l'idC et l'idP si l'utilisateur choisis la table Achat
function get_IDs($IDs){
    $IDs = explode(";", $IDs);
    // NB idC d'abbord puis idP
    $IDs = [$IDs[0], $IDs[1]];
    return $IDs;
}

function modif_acheteur($tab, $idC, $NomP, $ville){
    $reussite = 0;
    try{
    $bdd = new PDO("sqlite:bdd/Ventes.sqlite");
    $rq = "UPDATE $tab Set NomP = '$NomP',
            Ville = '$ville'
            WHERE idC =' $idC'";
    $resultat = $bdd->exec($rq);
    $reussite = 1;
    }
    catch (\Throwable $th) {
        return $reussite;
    }
    return $reussite;
}

?>
