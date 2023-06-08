<?php
// Création du header avec barre de navigation
function aff_header(){
    ?>
    <header class="p-3 bg-dark text-white sticky-top">
    	<div class="row align-items-center ">
    		<div class="col-lg-8 nav-bar">
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
                            echo '</ul>';
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
    echo '
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top fixed-bottom">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
      </a>
      <span class="mb-3 mb-md-0 text-muted">© 2022 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
  </svg>
    </ul>
    
  </footer>
  ';
    
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

function modif_produits($tab, $idP, $NomP, $prix, $image){
    $reussite = 0;
    try{
    $bdd = new PDO("sqlite:bdd/Ventes.sqlite");
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

// Fonction 'affichage des elements
function affichage($tab){
    $bdd = new PDO("sqlite:bdd/Ventes.sqlite");
    if ($tab == 'Acheteurs') {
        $rq = "SELECT * FROM $tab";
    }
    elseif ($tab == 'Produits') {
        $rq = "SELECT idP, NomP AS 'Produit', Prix, Illustration AS 'Photo' FROM $tab";
    }
    
    $resultat = $bdd->query($rq);
    $tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);

    // AFFICHAGE TEMPORAIRE DE LA TABLE
    // CHANGER AFFICHAGE POUR PLUS PROPRE
    echo '<table class="table">';
    echo '<thead>';
	echo '<tr>';
    
    if(!isset($tableau_assoc[0]['Photo'])){
        if (!empty($_POST)) {
            foreach($tableau_assoc[0] as $colonne=>$value){	
                echo '<th scope="col">'.$colonne.'</th>';	
            }
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                // le corps de la table
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

    elseif (isset($tableau_assoc[0]['Photo'])) {
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
                    echo "<td><img src='./Images/".$ligne['Photo'].".jpg' 
                    class='img-fluid rounded' width='100' alt=".$ligne['Photo']." ></td>";
                    echo "</tr>";
                }
            echo '</tbody>';
            echo '</table>';
        }
        
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
                    echo "<td><img src='./Images/".$ligne['Photo'].".jpg' 
                    class='img-fluid rounded' width='100' alt=".$ligne['Photo']." ></td>";
                    echo "</tr>";
                }
            echo '</tbody>';
            echo '</table>';
        }
        
    }


}

?>