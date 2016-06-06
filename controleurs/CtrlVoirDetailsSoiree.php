<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlVoirDetailSoiree.php : traiter la demande de consultation des informations sur la soirée
// Ecrit le 21/01/2016 par Nicolas Esteve
// Modifié le 06/06/2016 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

// récupère les détails de la soirée pour les afficher
$relire = false;
$uneSoiree = $dao->getSoiree($relire);
$themeFooter = $themeNormal;

if ($uneSoiree != null ){
	$leRestaurant = $uneSoiree->getNomRestaurant();
	$laDateSoiree = Outils::convertirEnDateFR($uneSoiree->getDateSoiree());
	$lAdresse = $uneSoiree->getAdresse();
	$leTarif = $uneSoiree->getTarif();
	$leLienMenu = $uneSoiree->getLienMenu();
	$laLatitude = $uneSoiree->getLatitude();
	$laLongitude = $uneSoiree->getLongitude();
}

include_once ($cheminDesVues . 'VueVoirDetailsSoiree.php');