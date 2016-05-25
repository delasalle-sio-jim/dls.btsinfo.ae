<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlCreerCompteAdmin.php : traiter la création d'un compte administrateur par un administrateur
// Ecrit le 07/01/2016 par Nicolas Esteve
// Modifié le 25/05/2016

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
	include_once ($cheminDesVues . 'VueCreerCompteAdmin.php');
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
		$unAdministrateur = new Administrateur(0, $adrMailAdmin, $nouveauMdp, $prenomAdmin, $nomAdmin);
		$ok = $dao->creerCompteAdministrateur($unAdministrateur);
		
	
		if($ok){
			
			// envoi d'un mail d'acceptation à l'intéressé avec son mot de passe
			$sujet = "Création de votre compte Administrateur dans l'annuaire des anciens du BTS Informatique";
			$message = "Votre compte administrateur vient d'être créé.\n\n";
			$message .= "Votre login de connexion est : " . $adrMailAdmin . "\n";
			$message .= "Votre mot de passe est : " . $nouveauMdp . "\n\n";
			$message .= "Cordialement.\n";
			$message .= "Les administrateurs de l'annuaire";
			$ok = Outils::envoyerMail($adrMailAdmin, $sujet, $message, $ADR_MAIL_ADMINISTRATEUR);
				
			// envoi d'un mail à l'administrateur
			$message = "Enregistrement effectué, un mail va être envoyé au nouvel administrateur.";
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
		include_once ($cheminDesVues . 'VueCreerCompteAdmin.php');
	}