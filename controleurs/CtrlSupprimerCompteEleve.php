<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlSupprimerCompteEleve.php : traiter la suppression d'un compte d'un élève par un administrateur
// Ecrit le 12/1/2016 par Nicolas Esteve
// Modifié le 26/05/2016

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
		$lesMails = $dao->GetLesAdressesMails();
		$idEleve = "";
		$adrMailEleve = "";
		$message = "";
		$typeMessage = "";
		$lienRetour = '#page_principale';	// pour le retour en version jQuery mobile
		$etape = 0;
		$listeMails = $dao->GetLesAdressesMails();
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');
	}
	elseif( isset ($_POST ["btnDetail"]) == true &&(! isset($_POST['btnSupprimer']) == true )){
		
		/* On vérifie que l'adresse est bonne */
		if ($dao->existeAdrMail($_POST ["listeEleves"]) == false){
			
			$etape = 0;
			$message = "Veuillez rentrer une adresse mail existante.";
			$typeMessage = 'avertissement';
			$lienRetour = '#page_principale';
			
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
		}
		/* Si elle est bonne, on affiche les nouvelles données correspondante à l'élève en question */
		else{
		
			$etape=1;
			$unEleve = $dao->getEleve($_POST ["listeEleves"]);
			$id=$unEleve->getId();
			$nom = $unEleve->getNom();
			$prenom = $unEleve->getPrenom();
			$mail = $unEleve->getAdrMail();
			$annee = $unEleve->getAnneeDebutBTS();
			
			$liste = $dao->GetLesAdressesMails();
			
			/* on prend l'id dans une variable de session pour pouvoir modifier le compte */
			$unEleve = $dao->getEleve($_POST ["listeEleves"]);
			$idEleve = $unEleve->getId();
			$_SESSION['idEleve'] = $idEleve;
			
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');
		}
	}
	elseif (isset($_POST['btnSupprimer']) == true ) 
	{
		$etape=0;
		$ok = $dao->supprimerCompteEleve($_SESSION['idEleve']);
		$liste = $dao->GetLesAdressesMails();
		if ( $ok ) {
				
			$message = "Suppression effectuée.";
			$typeMessage = 'information';
			$lienRetour = 'index.php?action=Menu#menu4';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');
		}
		else
		{
			$message = "La suppression a échouée.";
			$typeMessage = 'avertissement';
			$lienRetour = '#page_principale';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');
		}
		
		unset($DAO);
		include_once ($cheminDesVues . 'VueSupprimerCompteEleve.php');
	}

	
	