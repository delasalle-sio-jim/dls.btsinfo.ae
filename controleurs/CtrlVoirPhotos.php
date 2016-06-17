<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlVoirPhotos.php : afficher la vue de la galerie
// Ecrit le 15/06/2016 par Killian BOUTIN

if ( $_SESSION['typeUtilisateur'] != 'eleve') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
$lesImages = $dao->getLesImages();
$themeFooter = $themeNormal;
$uneImage = $dao->getImage(1);
$annee = $uneImage->getPromo();
include_once ($cheminDesVues . 'VueVoirPhotos.php');