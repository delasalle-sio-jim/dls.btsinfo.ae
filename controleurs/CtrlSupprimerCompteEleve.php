<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlSupprimerCompteEleve.php : traiter la suppression d'un compte d'un élève par un administrateur
// Ecrit le 12/1/2016 par Nicolas Esteve
// Modifié le 20/5/2016 par Jim

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
// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
if ( empty ($_POST ["mail"]) == true)  $mail = "";  else   $mail = $_POST ["mail"];

if( (! isset ($_POST ["listeEleves"]) == true) && ( ! isset ($_POST ["btnSupprimer"]) == true)){			
		// redirection vers la vue si aucune données n'est recu par le controleur
		$lesMails = $dao->GetLesAdressesMail();
		$idEleve = "";
		$adrMailEleve = "";
		$message = "";
		$typeMessage = "";
		$etape = 0;
		$listeMails = $dao->GetLesAdressesMail();
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');
	}
	elseif( isset ($_POST ["btnDetail"]) == true &&(! isset($_POST['btnSupprimer']) == true )){
		
		if ( empty ($_POST ["listeEleves"]) == true)  $idEleve = "";  else   $idEleve = $_POST ["listeEleves"];
		
		$etape=1;
		$unEleve = $dao->getEleve($idEleve);
		$id=$unEleve->getId();
		$nom = $unEleve->getNom();
		$prenom = $unEleve->getPrenom();
		$mail = $unEleve->getAdrMail();
		$annee = $unEleve->getAnneeDebutBTS();
		
		$liste = $dao->GetLesAdressesMail();
		
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');	
	}
	elseif (isset($_POST['btnSupprimer']) == true ) 
	{
		$etape=0;
		$ok = $dao->supprimerCompteEleve($_POST ["listeEleves"]);
		$liste = $dao->GetLesAdressesMail();
		if ( $ok ) {
				
			$message = "Suppression effectuée.";
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			//include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');
		}
		else
		{
			$message = "La suppression a échouée.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			//include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');
		}
		
		unset($DAO);
		include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');
	}

	
	