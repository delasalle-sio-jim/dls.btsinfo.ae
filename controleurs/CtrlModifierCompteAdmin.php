<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierCompteAdmin.php : traiter la modification d'un compte administrateur par un administrateur
// Ecrit le 02/06/2016 par Killian BOUTIN

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

/* Premier passage sur la page */
if( (! isset ($_POST ["listeAdmins"]) == true) && ( ! isset ($_POST ["btnEnvoyer"]) == true)){			
		// redirection vers la vue si aucune données n'est recu par le controleur
		
		$lesMailsAdmin = $dao->getLesAdressesMailsAdmin();
		
		$etape = 0;
		$message = "";
		$typeMessage = "";
		
		//mise a zéro des variables de modifications de l'admin
		$nom = '';
		$prenom = '';

		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierCompteAdmin.php');
}

/* Sinon (si ce n'est pas le premier passage) */
else{
	/* Si on clique sur le bouton "Obtenir des détails" */
	if( isset ($_POST ["btnDetail"]) == true &&( isset($_POST['btnEnvoyer']) == false )){


		$etape=1;
		$uneAdrMail = $_POST ["listeAdmins"];
		$unAdministrateur = $dao->getAdministrateur($uneAdrMail);
		
		$nom = $unAdministrateur->getNom();
		$prenom = $unAdministrateur->getPrenom();
		
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierCompteAdmin.php');
	}
	
	/* Si on clique sur le bouton envoyer */
	else{
		
		$uneAdrMail = $_POST ["listeAdmins"];
		$unAdministrateur = $dao->getAdministrateur($uneAdrMail);
		// récupération des données du formulaire + assemblage avec les données qui ne changerons pas
		$unId = $unAdministrateur->getId();
		$unMotDePasse = $unAdministrateur->getMotDePasse();	
		if ( empty ($_POST ["txtPrenom"]) == true)  $unPrenom = "";  else   $unPrenom = $_POST ["txtPrenom"];
		if ( empty ($_POST ["txtNom"]) == true)  $unNom = "";  else   $unNom = $_POST ["txtNom"];
		
		$etape=0;
		
		$unAdministrateur = new Administrateur($unId, $uneAdrMail, $unMotDePasse, $unPrenom, $unNom);
		
		$ok = $dao->modifierCompteAdmin($unAdministrateur);
		$liste = $dao->getLesAdressesMailsAdmin();
		if ($ok){
			
			$message = 'Modification réussie.';
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			
		}
		else{
			
			$message = "La modification a échouée.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			
		}
	
		unset($DAO);
		include_once ($cheminDesVues . 'VueModifierCompteAdmin.php');
	}
}