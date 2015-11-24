<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlMenu.php : traiter la demande d'accès au menu
// Ecrit le 24/11/2015 par Jim

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

if ($typeUtilisateur == "eleve") {
	$utilisateur = $dao->getEleve($adrMail);
	$titre = "Ancien élève : ";
}

if ($typeUtilisateur == "administrateur") {
	$utilisateur = $dao->getAdministrateur($adrMail);
	$titre = "Administrateur : ";
}

$nom = $utilisateur->getNom();
$prenom = $utilisateur->getPrenom();

include_once ($cheminDesVues . 'VueMenu.php');