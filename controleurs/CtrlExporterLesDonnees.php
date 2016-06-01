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

$texte = "";

if (! isset ($_POST ["btnExporter"])) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueExporterLesDonnees.php');
}
else {
	
	/* on parcourt le tableau de checkbox */
	foreach($_POST['export'] as $value)
	{
		if ($value == "EleveParPromo"){
			$nomColonnes = array("anneeDebutBTS","nom","prenom");
			$donneesTable = "SELECT * FROM ae_eleves ORDER BY anneeDebutBTS, nom, prenom";
			$nomFichierCSV = "ElevesParPromo";
			
		}
		if ($value == "EleveParNom"){
			$nomColonnes = array("Nom","Prenom","Sexe","Promo","Telephone","Adresse Mail","Rue","Code Postal","Ville","Entreprise");
			$donneesTable = "SELECT nom AS Nom, prenom AS Prenom, sexe AS Sexe, anneeDebutBTS AS Promo,";
			$donneesTable .= " tel AS Telephone, adrMail AS \"Adresse Mail\", rue AS Rue, codePostal AS \"Code Postal\",";
			$donneesTable .= " ville AS Ville, entreprise AS Entreprise FROM ae_eleves";
			$nomFichierCSV = "Eleves";
			
			$ok = $dao->ExportToCSV($nomColonnes, $donneesTable, $nomFichierCSV);
		}
		/*
		if ($value == "Inscrits"){
			$nomColonnes = array("Annee de debut de BTS","Telephone","Prenom");
			$donneesTable = "SELECT * FROM ae_eleves";
			$nomFichierCSV = "Inscrits";
			
			$dao->ExportToCSV($nomColonnes, $donneesTable, $nomFichierCSV);
		}
		if ($value == "NonInscrits"){
			$nomColonnes = array("anneeDebutBTS","tel","prenom");
			$donneesTable = "SELECT * FROM ae_eleves";
			$nomFichierCSV = "NonInscrits";
			
			$dao->ExportToCSV($nomColonnes, $donneesTable, $nomFichierCSV);
		}
		*/
	}
	
	include_once ($cheminDesVues . 'VueExporterLesDonnees.php');
	
	
	
	if ($ok) 
		{
			$message = "Modifications effectuées.";
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueExporterLesDonnees.php');
		}
		else
		{
			$message = "L\'application a rencontré un problème.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueExporterLesDonnees.php');
		}
		
	}


