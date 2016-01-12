<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlDemanderCreationCompte.php : traiter la demande de création de compte d'un élève
// Ecrit le 12/1/2016 par Nicolas Esteve

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
$lesFonctions = $dao->getLesEleves();
if( (! isset ($_POST ["tbtnDetail"]) == true)||( ! isset ($_POST ["btnSupprimer"]) == true)){			
		// redirection vers la vue si aucune données n'est recu par le controleur
		
		$adrMailAdmin = '';
		$etape = 0;
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueSupprimerAdmin.php');
	}
	elseif( ! isset ($_POST ["btnSupprimer"]) == true)
	{	
		$listeEleve=$_POST ["listeEleve"];
		$etape=1;
		$unEleve = $dao->getEleve($listeEleve);
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueSupprimerAdmin.php');	
	}
	else 
	{
		
	}