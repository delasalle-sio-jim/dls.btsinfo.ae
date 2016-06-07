<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierMaFichePersoAdmin.php : traiter la demande de modification des informations d'un administrateur
// Ecrit le 24/05/2016 par Killian BOUTIN

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

// recherche de la fiche élève dans la BDD à partir de son adresse mail
$unAdministrateur = $dao->getAdministrateur($_SESSION['adrMail']);

if ( ! isset ($_POST ["btnModifier"]) ) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$nom = $unAdministrateur->getNom();
	$prenom = $unAdministrateur->getPrenom();

	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$lienRetour = '#page_principale';
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueModifierMaFichePersoAdmin.php');
}
else {

	// récupération des données postées
	if ( empty ($_POST ["txtNom"]) == true)  $nom = "";  else   $nom = $_POST ["txtNom"];
	if ( empty ($_POST ["txtPrenom"]) == true)  $prenom = "";  else   $prenom = $_POST ["txtPrenom"];
	// on recupère l'adresse mail de l'administrateur afin de l'utiliser comme identifiant dans la requete SQL
	$adrMail = $_SESSION['adrMail'];

	if ($nom == '' || $prenom == '') {
		// si les données sont incorrectes ou incomplètes, réaffichage de la vue de suppression avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$typeMessage = 'avertissement';
		$themeFooter = $themeProbleme;
		include_once ($cheminDesVues . 'VueModifierMaFichePersoAdmin.php');
	}
	else {
		// modification de l'objet Admin
		$unAdministrateur->setNom($nom);
		$unAdministrateur->setPrenom($prenom);
		//$unAdministrateur->setAdrMail($adrMail);
		
		$ok = $dao->modifierCompteAdmin($unAdministrateur);
		if ($ok)
		{	$message = "Modifications effectuées.";
			$typeMessage = 'information';
			$lienRetour = 'index.php?action=Menu#menu1';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueModifierMaFichePersoAdmin.php');
		}
		else
		{	$message = "L'application a rencontré un problème.";
			$typeMessage = 'avertissement';
			$lienRetour = '#page_principale';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifierMaFichePersoAdmin.php');
		}
	}
}

