<?php
// Projet DLS - BTS Info - Anciens élèves
// Ecrit le 11/11/2015 par Jim

// Fonction de la page principale index.php : analyser toutes les demandes et activer le contrôleur chargé de traiter l'action demandée

// Ce fichier est appelé par tous les liens internes, et par la validation de tous les formulaires
// il est appelé avec un paramètre action qui peut prendre les valeurs suivantes :

//    index.php?action=Connecter              : pour afficher la page de connexion
//    index.php?action=Deconnecter            : pour réafficher la page de connexion
//    index.php?action=Menu                   : pour afficher le menu
//    index.php?action=DemanderCreationCompte : pour afficher la page "demande de création de compte élève"
//    index.php?action=DemanderMdp            : pour afficher la page "mot de passe oublié"
//    index.php?action=ChangerDeMdp           : pour afficher la page de changement de mot de passe
//    index.php?action=ModifierFicheEleve     : pour afficher la page de modification de sa fiche personnelle

// il faut être administrateur pour les 2 actions suivantes :
//    index.php?action=ModifierCompteEleve    : pour afficher la page de modification d'un compte élève 
//    index.php?action=SupprimerCompteEleve   : pour afficher la page de suppression d'un compte élève 

session_start();		// permet d'utiliser des variables de session

// si $debug est égal à true, certaines variables sont affichées (pour la mise au point)
$debug = false;

// choix des styles graphiques pour jQuery mobile
$version = "1.3.2";			// choix de la version de JQuery Mobile (voir fichier head.php) : 1.2.0,  1.2.1,  1.3.2,  1.4.5
$themeNormal = "b";			// thème de base
$themeProbleme = "a";		// thème utilisé pour afficher un message en cas de problème

// on vérifie le paramètre action de l'URL
if ( isset ($_GET['action']) == false)  $action = '';  else   $action = $_GET['action'];

// lors d'une première connexion, ou après une déconnexion, on supprime les variables de session
if ($action == '' || $action == 'Deconnecter')
{	unset ($_SESSION['adrMail']);
	unset ($_SESSION['motDePasse']);
	unset ($_SESSION['typeUtilisateur']);
	unset ($_SESSION['cheminDesVues']);
}

// tests des variables de session
if ( isset ($_SESSION['adrMail']) == false)  $adrMail = '';  else  $adrMail = $_SESSION['adrMail'];
if ( isset ($_SESSION['motDePasse']) == false)  $motDePasse = '';  else  $motDePasse = $_SESSION['motDePasse'];
if ( isset ($_SESSION['typeUtilisateur']) == false)  $typeUtilisateur = '';  else  $typeUtilisateur = $_SESSION['typeUtilisateur'];
if ( isset ($_SESSION['cheminDesVues']) == false) 
{	// détection du type de terminal pour le choix des vues
	require_once 'Mobile_Detect.php';
	$detect = new Mobile_Detect;
	if ( $detect->isMobile() ) $cheminDesVues = "vues.jquery/"; else $cheminDesVues = "vues.html5/";
	$_SESSION['cheminDesVues'] = $cheminDesVues;
}
else
	 $cheminDesVues = $_SESSION['cheminDesVues'];

$cheminDesVues = "vues.jquery/";	// pour forcer l'affichage de la version mobile (ligne à bloquer normalement)

// si l'utilisateur n'est pas encore identifié, il sera automatiquement redirigé vers le contrôleur d'authentification
// (sauf s'il ne peut pas se connecter et demande de se faire envoyer son mot de passe qu'il a oublié ou s'il veut se créer un compte)
if ($adrMail == '' && $action != 'DemanderMdp' && $action != 'DemanderCreationCompte') $action = 'Connecter';

switch($action){
	case 'Connecter': {
		include_once ('controleurs/CtrlConnecter.php'); break;
	}
	case 'Menu': {
		include_once ('controleurs/CtrlMenu.php'); break;
	}
	case 'DemanderCreationCompte': {
		include_once ('controleurs/CtrlDemanderCreationCompte.php'); break;
	}
	case 'DemanderMdp': {
		include_once ('controleurs/CtrlDemanderMdp.php'); break;
	}
	case 'ChangerDeMdp': {
		include_once ('controleurs/CtrlChangerDeMdp.php'); break;
	}
	case 'ModifierFicheEleve': {
		include_once ('controleurs/CtrlModifierFicheEleve.php'); break;
	}
	case 'ModifierCompteEleve': {
		include_once ('controleurs/CtrlModifierCompteEleve.php'); break;
	}
	case 'SupprimerCompteEleve': {
		include_once ('controleurs/CtrlSupprimerCompteEleve.php'); break;
	}
	default : {
		// toute autre tentative est automatiquement redirigée vers le contrôleur d'authentification
		include_once ('controleurs/CtrlConnecter.php'); break;
	}
}