<?php
// Création du header avec barre de navigation
function aff_header(){
    ?>
    <header class="p-4 text-white sticky-top border-bottom border-2 border-warning">
    	<div class="row align-items-center ">
    		<div class="col-5 nav-bar">
                <nav class="navbar navbar-expand-md navbar-dark">
                        
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
                                <li class="nav-item">
                                    <a href="insertion.php" class="nav-link active"> Inserer un élément</a>
                                </li>
                                <li class="nav-item">
                                    <a href="modification.php" class="nav-link active"> Modifier un élément </a>
                                </li>
                                <li class="nav-item">
                                    <a href="suppression.php" class="nav-link active"> Supprimer un élément </a>
                                </li>
                            <?php    
                            }
                            echo '</ul>';
                        }
                        ?>
						
                </nav>
    		</div>
    		
            <!-- Affichage du logo -->
            <div class="col-2 text-center">
            <img src="../Images/Logo.png" class="img-fluid" width="65" alt="logo" >
            </div>
   			
            <div class="col-5">
            <!-- Affichage du boutton connexion diffère si user connecté ou non -->
            <!-- Dans le cas d'un utilisateur connecté alors ona ffiche un bouton de déconnexion et les infos de l'utilisateur connecté -->
            <!-- Dans le cas d'un utilisateur non connecté alors on affiche un bouton de connexion -->
				<?php if (empty($_SESSION)) { ?>
                    <div class="row align-items-center">
                        <div class="col-8 text-end ">
                            Vous n`êtes pas connecté.e
                        </div>
                        <div class="col-4">
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
                        <div class="col-8 text-end">
                            <?php echo "Bienvenue " . $_SESSION["login"]; ?>
                        </div>
                        <div class="col-4">
                            <a href="index.php?action=logout" class="btn btn-danger text-end" onclick="return Test()">
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
    ?>
    <footer class="footer border-top border-dark mt-auto">
    <div class="container d-flex text-center ">
        <div class="col-4">
            <p>© 2023 Garden'king, tout droits réservés </p>
        </div>
        <div class="col-4">
            <h5>Nos engagements</h5>
            <p>Découvrez nos engagements ecorésponsables :</p>
            <p>www.garden-king.fr/eco</p>
        </div>
        <div class="col-4">
            <h5>Nous contacter</h5>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
            </svg>
            garden-king@sav.fr
            <br>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
            </svg>
            02.00.00.00.00
            <br>
        </div>
    </div>
    <br>
  </footer>
  <?php
    
}

// Authentification de l'utilisateur
function Authentif($user, $pass){
    $reussite = false;
    $bdd = new PDO("sqlite:../bdd/Comptes.sqlite");
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
    $bdd = new PDO("sqlite:../bdd/Comptes.sqlite");
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

// Modification de la table acheteurs
function modif_acheteur($tab, $idC, $NomP, $ville){
    $reussite = 0;
    try{
        // Modification de la table
        $bdd = new PDO("sqlite:../bdd/Ventes.sqlite");
        $rq = "UPDATE $tab 
                Set NomP = '$NomP',
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

// Fonction de modification de la table produits
function modif_produits($tab, $idP, $NomP, $prix, $image){
    $reussite = 0;
    try{
    // Modification de la table
        $bdd = new PDO("sqlite:../bdd/Ventes.sqlite");
        $rq = "UPDATE $tab 
                Set NomP = '$NomP',
                Prix = '$prix',
                Illustration = '$image'
                WHERE idP =' $idP'";
        $resultat = $bdd->exec($rq);
        $reussite = 1;
    }
    catch (\Throwable $th) {
        return $reussite;
    }
    return $reussite;
}

// Fonction affichage des elements
function affichage($tab){
    // Récupération des données depuis bdd
    $bdd = new PDO("sqlite:../bdd/Ventes.sqlite");
    if ($tab == 'Acheteurs') {
        $rq = "SELECT * FROM $tab";
    }
    elseif ($tab == 'Produits') {
        $rq = "SELECT idP, NomP AS 'Produit', Prix, Illustration AS 'Photo' FROM $tab";
    }
    $resultat = $bdd->query($rq);
    $tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);

    // création de la table
    echo '<table class="table">';
    echo '<thead>';
	echo '<tr>';
    
    // Si il n'y a pas de photo alors affichage tableau basic
    if(!isset($tableau_assoc[0]['Photo'])){
        // Si il y a eu un POST l'élément modifier sera entouré de vert
        if (!empty($_POST)) {
            foreach($tableau_assoc[0] as $colonne=>$value){	
                echo '<th scope="col">'.$colonne.'</th>';	
            }
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach($tableau_assoc as $ligne){
                    if ($ligne["idC"] == $_POST["idC"]) {
                        echo "<tr class='table-success'>";
                    }
                    else{
                         echo '<tr>';}
                    foreach($ligne as $elem){	
                        echo "<td>$elem</td>";		
                    }
                    echo "</tr>";
                }
            echo '</tbody>';
            echo '</table>';
        }
        // Sinon affichage basic
        else {
            foreach($tableau_assoc[0] as $colonne=>$value){	
                echo '<th scope="col">'.$colonne.'</th>';	
            }
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                // le corps de la table
                foreach($tableau_assoc as $ligne){
                         echo '<tr>';
                    foreach($ligne as $elem){	
                        echo "<td>$elem</td>";		
                        
                    }
                    echo "</tr>";
                }
            echo '</tbody>';
            echo '</table>';
        }
    }
    // Si il y a des photos alors affichage tableau avec illustrations
    elseif (isset($tableau_assoc[0]['Photo'])) {
        // Si il y a eu un POST l'élément modifier sera entouré de vert
        if (!empty($_POST)) {
            foreach($tableau_assoc[0] as $colonne=>$value){	
                echo '<th scope="col">'.$colonne.'</th>';	
            }
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                // le corps de la table
                foreach($tableau_assoc as $ligne){
                    if ($ligne["Produit"] == $_POST["NomP"]) {
                        echo "<tr class='table-success'>";
                    }
                    else{
                        echo '<tr>';
                    }
                    echo "<td>".$ligne['idP']."</td>";
                    echo "<td>".$ligne['Produit']."</td>";
                    echo "<td>".$ligne['Prix']." €</td>";
                    echo "<td><img src='../Images/".$ligne['Photo'].".jpg' 
                    class='img-fluid rounded' width='100' alt=".$ligne['Photo']." ></td>";
                    echo "</tr>";
                }
            echo '</tbody>';
            echo '</table>';
        }
        // Sinon affichage tableau basic
        else{
            foreach($tableau_assoc[0] as $colonne=>$value){
                if($colonne !=('idP'))	{
                echo '<th scope="col">'.$colonne.'</th>';	
                }
            }
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                // le corps de la table
                foreach($tableau_assoc as $ligne){
                        echo '<tr>'; 
                    echo "<td>".$ligne['Produit']."</td>";
                    echo "<td>".$ligne['Prix']." €</td>";
                    echo "<td><img src='../Images/".$ligne['Photo'].".jpg' 
                    class='img-fluid rounded' width='100' alt=".$ligne['Photo']." ></td>";
                    echo "</tr>";
                }
            echo '</tbody>';
            echo '</table>';
        }   
    }
}

?>

<!-- _____________________________________ FONCTIONS JULES ______________________________________ -->