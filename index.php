<?php
// Projet DLS - BTS Info - Anciens élèves
// Ecrit le 1/12/2015 par Jim
// Modifié le 20/05/2016 par Jim

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
//    index.php?action=SupprimerCompteAdmin	  : pour afficher la page de suppression d'un compte administateur

session_start();		// permet d'utiliser des variables de session

// si $debug est égal à true, certaines variables sont affichées (pour la mise au point)
$debug = false;

// choix des styles graphiques pour jQuery mobile :
$version = "1.4.5";			// choix de la version de JQuery Mobile (voir fichier head.php) parmi les valeurs 1.2.0,  1.2.1,  1.3.2,  1.4.5
$themeNormal = "a";			// thème de base
$themeProbleme = "b";		// thème utilisé pour afficher un message en cas de problème
$transition ="flip";		// transition lors des changements de page (pop, flip, fade, turn, flow, slidefade, slide, slideup, slidedown)

// on vérifie le paramètre action de l'URL
if ( isset ($_GET['action']) == false)  $action = '';  else   $action = $_GET['action'];

// lors d'une première connexion, ou après une déconnexion, on supprime les variables de session
if ($action == '' || $action == 'Deconnecter')
{	unset ($_SESSION['adrMail']);
	unset ($_SESSION['motDePasse']);
	unset ($_SESSION['typeUtilisateur']);
	unset ($_SESSION['afficherMdp']);
	unset ($_SESSION['cheminDesVues']);
}

// tests des variables de session

// pour mémoriser l'adresse mail, le mot de passe et le type d'utilisateur ("eleve" ou "administrateur") :
if ( isset ($_SESSION['adrMail']) == false)  $adrMail = '';  else  $adrMail = $_SESSION['adrMail'];
if ( isset ($_SESSION['motDePasse']) == false)  $motDePasse = '';  else  $motDePasse = $_SESSION['motDePasse'];
if ( isset ($_SESSION['typeUtilisateur']) == false)  $typeUtilisateur = '';  else  $typeUtilisateur = $_SESSION['typeUtilisateur'];

// pour mémoriser le choix d'afficher en clar (ou pas) le mot de passe :
if ( isset ($_SESSION['afficherMdp']) == false)  $afficherMdp = 'off';  else  $afficherMdp = $_SESSION['afficherMdp'];

// pour mémoriser le chemin d'accès des vues  ("vues.html5/" pour un ordi, "vues.jquery/" pour un mobile) :
if ( isset ($_SESSION['cheminDesVues']) == false) 
{	// détection du type de terminal de l'utilisateur
	require_once 'Mobile_Detect.php';
	$detect = new Mobile_Detect;
	if ( $detect->isMobile() ) $cheminDesVues = "vues.jquery/"; else $cheminDesVues = "vues.html5/";
	$_SESSION['cheminDesVues'] = $cheminDesVues;
}
else
	 $cheminDesVues = $_SESSION['cheminDesVues'];
// ATTENTION ON TRICHE (EN DEVELOPPEMENT) POUR FORCER L'AFFICHAGE DE LA VERSION MOBILE SUR LE POSTE DE DEVELOPPEMENT :
$cheminDesVues = "vues.jquery/";	// pour forcer l'affichage de la version mobile (ligne à désactiver dans l'application finale)

// si l'utilisateur n'est pas encore identifié, il sera automatiquement redirigé vers le contrôleur d'authentification
// (sauf s'il ne peut pas se connecter et demande de se faire envoyer son mot de passe qu'il a oublié ou s'il veut se créer un compte)
if ($adrMail == '' && $action != 'DemanderMdp' && $action != 'DemanderCreationCompte') $action = 'Connecter';

switch($action){
	// options accessibles aux élèves (et parfois proposées aux administrateurs)
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
	case 'ModifierMaFichePersoEleve': {
		include_once ('controleurs/CtrlModifierMaFichePersoEleve.php'); break;
	}
	case 'VoirDetailsSoiree':{
		include_once ('controleurs/CtrlVoirDetailsSoiree.php'); break;
	}
	case 'CreerMonInscription':{
		include_once ('controleurs/CtrlCreerMonInscription.php'); break;
	}
	case 'ProposerStage':{
		include_once ('controleurs/CtrlProposerStage.php'); break;
	}
	
	// options accessibles uniquement aux administrateurs
	case 'ModifierMaFichePersoAdmin': {
		include_once ('controleurs/CtrlModifierMaFichePersoAdmin.php'); break;
	}
	case 'CreerCompteEleve':{
		include_once ('controleurs/CtrlCreerCompteEleve.php'); break;
	}
	case 'ModifierCompteEleve': {
		include_once ('controleurs/CtrlModifierCompteEleve.php'); break;
	}
	case 'SupprimerCompteEleve': {
		include_once ('controleurs/CtrlSupprimerCompteEleve.php'); break;
	}
	case 'CreerCompteAdmin':{
		include_once ('controleurs/CtrlCreerCompteAdmin.php'); break;
	}
	case 'ModifierCompteAdmin': {
		include_once ('controleurs/CtrlModifierCompteAdmin.php'); break;
	}
	case 'SupprimerCompteAdmin':{
		include_once ('controleurs/CtrlSupprimerCompteAdmin.php'); break;
	}
	case 'ModifierDetailsSoiree':{
		include_once ('controleurs/CtrlModifierDetailsSoiree.php'); break;
	}
	case 'ModifierReglementsRemboursements':{
		include_once ('controleurs/CtrlModifierReglementsRemboursements.php'); break;
	}
	
	// toute autre tentative est automatiquement redirigée vers le contrôleur d'authentification	
	default : {
		include_once ('controleurs/CtrlConnecter.php'); break;
	}
}
