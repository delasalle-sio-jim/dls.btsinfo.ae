<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlCreerAdmin.php : traiter la création d'un admin par un admin
// Ecrit le 07/01/2016 par Nicolas Esteve

// on vérifie si le demandeur de cette action est bien authentifié
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
include_once ('modele/Outils.class.php');

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();


if ( ! isset ($_POST ["btnCreation"]) ) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$nomAdmin = '';
	$prenomAdmin = '';
	$adrMailAdmin = '';
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueCreerAdmin.php');
}
else
{
	if ( empty ($_POST ["txtNom"]) == true)  $nomAdmin = "";  else   $nomAdmin = $_POST ["txtNom"];
	if ( empty ($_POST ["txtPrenom"]) == true)  $prenomAdmin = "";  else   $prenomAdmin = $_POST ["txtPrenom"];
	if ( empty ($_POST ["txtAdrMail"]) == true)  $adrMailAdmin = "";  else   $adrMailAdmin = $_POST ["txtAdrMail"];
	
	if ($adrMailAdmin == '' ||  Outils::estUneAdrMailValide($adrMailAdmin) == false || $nomAdmin == ''|| $prenomAdmin == '') {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$typeMessage = 'avertissement';
		$themeFooter = $themeProbleme;
		$typeUtilisateur = '';
		
	}
	else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		$nouveauMdp = Outils::creerMdp();
		$ok = $dao->creerAdministrateur($adrMailAdmin, $nouveauMdp, $nomAdmin, $prenomAdmin);
		
	
		if($ok){
			$nouveauMdp = Outils::creerMdp();					// création d'un mot de passe aléatoire de 8 caractères
			$ok = $dao->modifierMdp($adrMailAdmin, $nouveauMdp);
			// envoi d'un mail d'acceptation à l'intéressé avec son mot de passe
			$sujet = "Demande de création de votre compte Administrateur dans l'annuaire des anciens du BTS Informatique";
			$message = "Votre demande de création de compte a bien été validée.\n\n";
			$message .= "Votre login de connexion est : " . $adrMailAdmin . "\n";
			$message .= "Votre mot de passe est : " . $nouveauMdp . "\n\n";
			$message .= "Cordialement.\n";
			$message .= "Les administrateurs de l'annuaire";
			$ok = Outils::envoyerMail($adrMailAdmin, $sujet, $message, $ADR_MAIL_ADMINISTRATEUR);
				
			// envoi d'un mail à l'administrateur
			$message = "Enregistrement effectué, un mail va ête envoyé au nouvel administrateur.";
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
		
			
		}
		else {
			$message = 'Enregistrement à échoué';
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
		}
			
		}
		unset($DAO);
		include_once ($cheminDesVues . 'VueCreerAdmin.php');
	}