<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlSupprimerCompteAdmin.php : traiter la demande de suppression d'un administrateur
// Ecrit le 06/01/2016 par Nicolas Esteve
// Modifié le 02/06/2016 par Killian BOUTIN

// on vérifie si le demandeur de cette action est bien authentifié
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

if( (! isset ($_POST ["listeAdmins"]) == true)&&( ! isset ($_POST ["btnSupprimerAdmin"]) == true)){			
	// redirection vers la vue si aucune données n'est recu par le controleur
	
	$lesMailsAdmin = $dao->getLesAdressesMailsAdmin();
	$adrMailAdmin = '';
	$etape = 0;
	
	$message = '';
	$typeMessage = '';					// 2 valeurs possibles : 'information' ou 'avertissement'
	$lienRetour = '#page_principale';	// pour le retour en version jQuery mobile
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueSupprimerCompteAdmin.php');
}
else {
	/* si on appuie sur le bouton Obtenir des détails */
	if (isset ($_POST ["btnDetailAdmin"]) == true) {
		
		$_SESSION['adrMailAdmin'] = $_POST ["listeAdmins"];
	
		$unAdministrateur = $dao->getAdministrateur($_SESSION['adrMailAdmin']);
	
		if(!$unAdministrateur ){
			$etape = 0;
			$message = 'L\'administrateur que vous tentez de supprimer n\'existe pas';
			$typeMessage = 'avertissement';
			$lienRetour = '#page_principale';
			$themeFooter = $themeProbleme;	
		}
		
		else{ /* si l'administrateur existe */
			$etape = 1;
			$prenomAdmin = $unAdministrateur->getPrenom();
			$nomAdmin = $unAdministrateur->getNom();
			$txtMailAdmin = $unAdministrateur->getAdrMail();
	
		}
	}
	/* si on appuie sur le bouton supprimer */
	else{

		$etape = 0;
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		$unAdministrateur = $dao->getAdministrateur($_SESSION['adrMailAdmin']);
		$idAdmin = $unAdministrateur->getId();
		$ok = $dao->supprimerCompteAdministrateur($idAdmin);				
				 	
		if ($ok) {	
			$message = "Suppression effectuée. L\'administrateur lié à l'adresse ".$_SESSION['adrMailAdmin']." ne pourra plus effectuer de modification.";
			$typeMessage = 'information';
			$lienRetour = 'index.php?action=Menu#menu5';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueSupprimerCompteAdmin.php');			 														 	
		}
		
		else {
			$message = "La suppression n'a pas pu s'effectuer.";
			$typeMessage = 'avertissement';
			$lienRetour = '#page_principale';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueSupprimerCompteAdmin.php');
		}
			
	}
	unset($DAO);
	include_once ($cheminDesVues . 'VueSupprimerCompteAdmin.php');
	
}