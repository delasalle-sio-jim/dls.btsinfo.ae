<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierReglementsRemboursements.php : traiter la modification d'une inscription par un administrateur
// Ecrit le 12/1/2016 par Nicolas Esteve
// Modifié le 20/05/2016 par Jim

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');
include_once ('modele/Inscription.class.php');
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
if( (! isset ($_POST ["listeEleves"]) == true) && ( ! isset ($_POST ["btnModifier"]) == true)){
	// redirection vers la vue si aucune données n'est recu par le controleur
		$lesMails = $dao->getLesAdressesMailRemboursement();
		$idEleve = "";
		$message = "";
		$typeMessage = "";
		$etape = 0;
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierReglementsRemboursements.php');
	}
	elseif( isset ($_POST ["btnDetail"]) == true &&(! isset($_POST['btnEnvoyer']) == true ))
	{
		if ( empty ($_POST ["listeEleves"]) == true)  $idEleve = "";  else   $idEleve = $_POST ["listeEleves"];
		
		$etape=1;
		$unEleve = $dao->getEleve($idEleve);
		$Id = $unEleve->getId();
		$_SESSION['idEleve'] =$Id;
		
		$insciption = $dao->detailsInscription($Id);
		$nbPlacesReserve = $insciption->getnbrePersonne();
		$dateinscription = $insciption->getdateInscription();
		$MontantRembourse = $insciption->getmontantRembourse();
		$MontantRegle = $insciption->getmontantRegle();
		include_once ($cheminDesVues . 'VueModifierReglementsRemboursements.php');
		
	}	
	elseif (isset($_POST['btnModifier']) == true )
	{
		if ( empty ($_POST ["txtMontantRembourse"]) == true)  $MontantRembourse = 0;  else   $MontantRembourse = $_POST ["txtMontantRembourse"];
		if ( empty ($_POST ["txtMontantRegle"]) == true)  $MontantRegle = 0;  else   $MontantRegle = $_POST ["txtMontantRegle"];
			
		$unEleve = $dao->getEleve($_SESSION['idEleve']);
		$Id = $unEleve->getId();
		$insciption = $dao->detailsInscription($Id);
		$nbPlacesReserve = $insciption->getnbrePersonne();
		$dateinscription = $insciption->getdateInscription();
		
		$ok = $dao->modifierDonneesInscription($MontantRembourse, $MontantRegle, $_SESSION['idEleve']);
		$etape = 1;
		unset($_SESSION['idEleve']);
		
		if($ok)
		{
		
		$message = "valide";
		$typeMessage = "information";
		}
		else 
		{
			$message = "invalise";
			$typeMessage = "avertissement";
		}
		include_once ($cheminDesVues . 'VueModifierReglementsRemboursements.php');
		
	}