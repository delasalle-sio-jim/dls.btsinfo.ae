<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierDetailsSoiree.php : traiter la demande de modification des détails sur la soirée
// Ecrit le 20/01/2016 par Nicolas Esteve
// Modifié le 20/5/2016 par Jim

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
$dao = new DAO();
// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)


if (! isset ($_POST ["btnModifier"])) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$urgence= true;
	$Soiree = $dao->GetDonnesSoiree($urgence);
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueModifierDetailsSoiree.php');
}
else {
	
	// récupération des données postées
	if ( empty ($_POST ["txtNomRestaurant"]) == true)  $unNom = "";  else   $unNom = $_POST ["txtNomRestaurant"];
	if ( empty ($_POST ["txtDate"]) == true)  $uneDate = "00/00/0000";  else   $uneDate = $_POST ["txtDate"];
	if ( empty ($_POST ["txtAdresse"]) == true)  $uneAdresse = "";  else   $uneAdresse = $_POST ["txtAdresse"];
	if ( empty ($_POST ["txtTarif"]) == true)  $unTarif = "";  else   $unTarif = $_POST ["txtTarif"];
	if ( empty ($_POST ["txtLienMenu"]) == true)  $unLienMenu = "";  else   $unLienMenu = $_POST ["txtLienMenu"];
	if ( empty ($_POST ["txtLatitude"]) == true)  $uneLatitude = "";  else   $uneLatitude = $_POST ["txtLatitude"];
	if ( empty ($_POST ["txtLongitude"]) == true)  $uneLongitude = "";  else   $uneLongitude = $_POST ["txtLongitude"];
	
	
		
	$ok = $dao->ModifierDonnesSoiree($unNom, $uneDate, $uneAdresse, $unTarif, $unLienMenu, $uneLatitude, $uneLongitude);
	
	//recupération des details de la soirée directement depuis la base de donnée
	$urgence = true;
	$Soiree = $dao->GetDonnesSoiree($urgence);
		
	if ($ok) 
		{
			
			$message = "Modifications effectuées.";
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueModifierDetailsSoiree.php');
		}
		else
		{
			$message = "L\'application a rencontré un problème.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifierDetailsSoiree.php');
		}
	}

