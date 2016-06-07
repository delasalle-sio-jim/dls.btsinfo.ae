<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierDetailsSoiree.php : traiter la demande de modification des détails sur la soirée
// Ecrit le 20/01/2016 par Nicolas Esteve
// Modifié le 25/05/2016 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
$dao = new DAO();

if (! isset ($_POST ["btnModifier"])) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$urgence= true;
	$uneSoiree = $dao->getSoiree($urgence);
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$lienRetour = '#page_principale';
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueModifierDetailsSoiree.php');
}
else {
	
	$urgence=false;
	$uneSoiree = $dao->getSoiree($urgence);

	// récupération des données postées
	if ( empty ($_POST ["txtNomRestaurant"]) == true)  $unNomRestaurant = $uneSoiree->getNomRestaurant();  else   $unNomRestaurant = $_POST ["txtNomRestaurant"];
	if ( empty ($_POST ["txtDate"]) == true)  $uneDate = $uneSoiree->getDateSoiree();  else   $uneDate = $_POST ["txtDate"];
	if ( empty ($_POST ["txtAdresse"]) == true)  $uneAdresse = $uneSoiree->getAdresse();  else   $uneAdresse = $_POST ["txtAdresse"];
	if ( empty ($_POST ["txtTarif"]) == true)  $unTarif = $uneSoiree->getTarif();  else   $unTarif = $_POST ["txtTarif"];
	if ( empty ($_POST ["txtLienMenu"]) == true)  $unLienMenu = $uneSoiree->getLienMenu();  else   $unLienMenu = $_POST ["txtLienMenu"];
	if ( empty ($_POST ["txtLatitude"]) == true)  $uneLatitude = $uneSoiree->getLatitude();  else   $uneLatitude = $_POST ["txtLatitude"];
	if ( empty ($_POST ["txtLongitude"]) == true)  $uneLongitude = $uneSoiree->getLongitude();  else   $uneLongitude = $_POST ["txtLongitude"];
	
	$uneSoiree->setDateSoiree($uneDate);
	$uneSoiree->setNomRestaurant($unNomRestaurant);
	$uneSoiree->setAdresse($uneAdresse);
	$uneSoiree->setTarif($unTarif);
	$uneSoiree->setLienMenu($unLienMenu);
	$uneSoiree->setLatitude($uneLatitude);
	$uneSoiree->setLongitude($uneLongitude);
	
	$ok = $dao->modifierSoiree($uneSoiree);
	
	//recupération des details de la soirée directement depuis la base de donnée
	$urgence = true;
	$uneSoiree = $dao->getSoiree($urgence);
	
	if ($ok) 
		{
			$message = "Modifications effectuées.";
			$typeMessage = 'information';
			$lienRetour = 'index.php?action=Menu#menu2';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueModifierDetailsSoiree.php');
		}
		else
		{
			$message = "L\'application a rencontré un problème.";
			$typeMessage = 'avertissement';
			$lienRetour = '#page_principale';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifierDetailsSoiree.php');
		}
}


