<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlConnecter.php : traiter la demande de connexion d'un utilisateur
// Ecrit le 16/11/2015 par Jim

// Ce contrôleur vérifie l'authentification de l'utilisateur
// si l'authentification est bonne, il affiche le menu élève ou administrateur (vue VueMenu.php)
// si l'authentification est incorrecte, il réaffiche la page de connexion (vue VueConnecter.php)

if ( isset ($_POST ["txtAdrMail"]) == false) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$adrMail = '';
	$motDePasse = '';
	$afficherMdp = 'off';
	$typeUtilisateur = '';
	$message = '&nbsp;';
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueConnecter.php');
}
else {
	// récupération des données postées
	if ( empty ($_POST ["txtAdrMail"]) == true) $adrMail = "";  else $adrMail = $_POST ["txtAdrMail"];
	if ( empty ($_POST ["txtMotDePasse"]) == true)  $motDePasse = "";  else   $motDePasse = $_POST ["txtMotDePasse"];
	if ( empty ($_POST ["caseAfficherMdp"]) == true)  $afficherMdp = "off";  else   $afficherMdp = $_POST ["caseAfficherMdp"];
			
	if ($adrMail == '' || $motDePasse == '') {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$themeFooter = $themeProbleme;
		$typeUtilisateur = '';
		include_once ($cheminDesVues . 'VueConnecter.php');
	}
	else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		
		// test de l'authentification de l'utilisateur
		// la méthode getTypeUtilisateur de la classe DAO retourne les valeurs 'inconnu' ou 'eleve' ou 'administrateur'
		$typeUtilisateur = $dao->getTypeUtilisateur($adrMail, $motDePasse);
		
		if ( $typeUtilisateur == "inconnu" ) {
			// si l'authentification est incorrecte, retour à la vue de connexion
			$message = 'Authentification incorrecte !';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueConnecter.php');
		}
		else {
			// si l'authentification est correcte, mémorisation des données de connexion dans des variables de session
			$_SESSION['adrMail'] = $adrMail;
			$_SESSION['motDePasse'] = $motDePasse;
			$_SESSION['typeUtilisateur'] = $typeUtilisateur;
			// redirection vers la page de menu
			header ("Location: index.php?action=Menu");
		}
		
		unset($dao);		// fermeture de la connexion à MySQL
	}
}