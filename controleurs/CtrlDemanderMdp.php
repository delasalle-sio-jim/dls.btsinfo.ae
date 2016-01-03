<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlDemanderMdp.php : traiter la demande d'envoi d'un nouveau mot de passe
// Ecrit le 24/11/2015 par Jim

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');

$divConnecterDepliee = false;		// indique si la division doit être dépliée à l'affichage de la vue
$divDemanderMdpDepliee = true;		// indique si la division doit être dépliée à l'affichage de la vue
$motDePasse = '';
$afficherMdp = 'off';
$typeUtilisateur = '';

if ( ! isset ($_POST ["txtAdrMail2"]) == true) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueConnecter.php');
}
else {
	// récupération des données postées
	if ( empty ($_POST ["txtAdrMail2"]) == true)  $adrMail = "";  else   $adrMail = $_POST ["txtAdrMail2"];
			
	if ($adrMail == '' || Outils::estUneAdrMailValide($adrMail) == false) {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$typeMessage = 'avertissement';
		$themeFooter = $themeProbleme;
		include_once ($cheminDesVues . 'VueConnecter.php');
	}
	else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		
		// test de l'existence de l'élève
		// la méthode existeAdrMail de la classe DAO retourne true si $adrMail existe, false s'il n'existe pas
		if ( ! $dao->existeAdrMail($adrMail) )  {
			// si $adrMail n'existe pas, retour à la vue
			$message = "Adresse mail inexistante !";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueConnecter.php');
		}
		else {
			// génération d'un nouveau mot de passe
			$nouveauMdp = Outils::creerMdp();
			// enregistre le nouveau mot de passe de l'utilisateur dans la bdd après l'avoir hashé en SHA1
			$dao->modifierMdp($adrMail, $nouveauMdp);
		
			// envoi d'un mail à l'utilisateur avec son nouveau mot de passe 
			$ok = $dao->envoyerMdp($adrMail, $nouveauMdp);
			if ($ok) {
				$themeFooter = $themeNormal;
				$message = 'Vous allez recevoir un mail<br>avec votre nouveau mot de passe.';
				$typeMessage = 'information';
				include_once ($cheminDesVues . 'VueConnecter.php');
			}
			else {
				$themeFooter = $themeProbleme;
				$message = "Echec lors de l'envoi du mail !";
				$typeMessage = 'avertissement';
				include_once ($cheminDesVues . 'VueConnecter.php');
			}
		}
		unset($dao);		// fermeture de la connexion à MySQL
	}
}