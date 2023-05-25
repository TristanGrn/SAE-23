<?php
// Création du header
function aff_header(){
    ?>
    <header class="p-3 bg-dark text-white">
    	<div class="row align-items-center">
    		<div class="col-lg-4">
      			<a href="index.php" class="text-decoration-none"> Accueil

                </a>
    		</div>
    		<div class="col-lg-4">
    		A COMPLETER
    		</div>
   			<div class="col-lg-4">
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
<?php
}

function footer(){
    echo "
    <footer>
			<p>Pied de la page A COMPLETER</p>
	</footer>";
}

function Authentif($user, $pass){
    $reussite = false;
    $bdd = new PDO("sqlite:bdd/comptes.sqlite");
    $user = $bdd->quote($user);
    $pass = $bdd->quote($pass);
    // Ecriture de la requete
    $rq ="SELECT NOM_USER, MDP FROM Users WHERE NOM_USER = " .$user ." AND MDP = " .$pass;
    var_dump($rq);
    // On effectue la requete
    $resultat = $bdd->query($rq);
    $tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
    if(sizeof($tableau_assoc)!=0) $reussite = true;
    return $reussite;
}

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
?>
<!-- function authentification($mail,$pass){
		$retour = false ;
		$madb = new PDO('sqlite:bdd/comptes.sqlite'); 
		$mail= $madb->quote($mail);
		$pass = $madb->quote($pass);
		$requete = "SELECT EMAIL,PASS FROM utilisateurs WHERE EMAIL = ".$mail." AND PASS = ".$pass ;
		//var_dump($requete);echo "<br/>";  	
		$resultat = $madb->query($requete);
		$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
		if (sizeof($tableau_assoc)!=0) $retour = true;	
		return $r -->