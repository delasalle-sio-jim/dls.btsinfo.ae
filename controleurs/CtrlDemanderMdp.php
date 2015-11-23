<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlDemanderMdp.php : traiter la demande d'envoi d'un nouveau mot de passe
// Ecrit le 23/11/2015 par Jim

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');

if ( ! isset ($_POST ["txtAdrMail2"]) == true) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$nom = '';
	$msgFooter = 'Mot de passe oublié';
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueConnecter.php');
}
else {
	// récupération des données postées
	if ( empty ($_POST ["txtAdrMail2"]) == true)  $adrMail = "";  else   $adrMail = $_POST ["txtAdrMail2"];
			
	if ($adrMail == '' || Outils::estUneAdrMailValide($adrMail) == false) {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes ou incorrectes !';
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
			$msgFooter = "Adresse mail inexistante !";
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueConnecter.php');
		}
		else {
			// génération d'un nouveau mot de passe
			$nouveauMdp = Outils::creerMdp();
			// enregistre le nouveau mot de passe de l'utilisateur dans la bdd après l'avoir codé en SHA1
			$dao->modifierMdpUser($adrMail, $nouveauMdp);
		
			// envoi d'un mail à l'utilisateur avec son nouveau mot de passe 
			$ok = $dao->envoyerMdp($adrMail, $nouveauMdp);
			if ($ok) {
				$themeFooter = $themeNormal;
				$msgFooter = 'Vous allez recevoir un mail<br>avec votre nouveau mot de passe.';
				include_once ($cheminDesVues . 'VueConnecter.php');
			}
			else {
				$themeFooter = $themeProbleme;
				$msgFooter = "Echec lors de l'envoi du mail !";
				include_once ($cheminDesVues . 'VueConnecter.php');
			}
		}
		unset($dao);		// fermeture de la connexion à MySQL
	}
}