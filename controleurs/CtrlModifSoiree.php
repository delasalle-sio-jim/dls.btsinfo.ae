<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifFichePerso.php : traiter la demande de modification des informations d'un d'un élève
// Ecrit le 11/01/2016 par Nicolas Esteve


// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)


if ( ! isset ($_POST ["btnModifier"]) ) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$Soiree = $dao->GetDonnesSoiree();
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueModifSoiree.php');
}
else {
	//$premierAppel = false;
	// récupération des données postées
	if ( empty ($_POST ["txtNomRestaurant"]) == true)  $unNom = "";  else   $unNom = $_POST ["txtNomRestaurant"];
	if ( empty ($_POST ["txtDate"]) == true)  $uneDate = "";  else   $uneDate = $_POST ["txtDate"];
	if ( empty ($_POST ["txtAdresse"]) == true)  $uneAdresse = "";  else   $uneAdresse = $_POST ["txtAdresse"];
	if ( empty ($_POST ["txtTarif"]) == true)  $unTarif = "";  else   $unTarif = $_POST ["txtTarif"];
	if ( empty ($_POST ["txtLienMenu"]) == true)  $unLienMenu = "";  else   $unLienMenu = $_POST ["txtLienMenu"];
	if ( empty ($_POST ["txtLatitude"]) == true)  $uneLatitude = "";  else   $uneLatitude = $_POST ["txtLatitude"];
	if ( empty ($_POST ["txtLongitude"]) == true)  $uneLongitude = "";  else   $uneLongitude = $_POST ["txtLongitude"];
	
	
			
	$ok = $dao->ModifierDonnesSoiree($unNom, $uneDate, $uneAdresse, $unTarif, $unLienMenu, $uneLatitude, $uneLongitude);
	
	$Soiree = $dao->GetDonnesSoiree();
	
	if ($ok) 
		{
			
			$message = "Modifications effectuées.";
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueModifSoiree.php');
		}
		else
		{
			$message = "l\'application a rencontré un problème.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifSoiree.php');
		}
	}


