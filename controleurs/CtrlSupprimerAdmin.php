<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlChangerDeMdp.php : traiter la demande de changement de mot de passe
// Ecrit le 05/01/2016 par Nicolas Esteve

// on vérifie si le demandeur de cette action est bien authentifié
if ( $_SESSION['typeUtilisateur'] != 'eleve' && $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else {
	if( ! isset ($_POST ["txtAdrMailAdmin"]))
			{// redirection vers la vue si aucune données n'est recu par le controleur
				
				$adrMailAdmin = '';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueSupprimerAdmin.php');
			}
			else {// récupération des données postées
				//en cas de données incomplètes
				if ( empty ($_POST ["txtAdrMailAdmin"]) == true)  $adrMailAdmin = "";  else   $adrMailAdmin = $_POST ["txtAdrMailAdmin"];
				include_once ('modele/DAO.class.php');
				$dao = new DAO();
				 $utilisateur = $dao->getAdministrateur($adrMailAdmin);
				 if($utilisateur == '')
				 {
				 	$message = 'L\'administrateur que vous tentez de supprimer n\'existe pas';
				 	$typeMessage = 'avertissement';
				 	$themeFooter = $themeProbleme;
				 }
				 else {// si les données sont correct
				  	// connexion du serveur web à la base MySQL
				 	include_once ('modele/DAO.class.php');
				 	$dao = new DAO();
				 	
				 	$ok = $dao->supprimerAdministrateur($adrMailAdmin);
	
				 	if($ok){
				 	$message = "Suppression effectué. L\'administrateur lié a l'adresse".$adrMailAdmin." ne poura plus effectuer de modification.";
				 	$typeMessage = 'information';
				 	$themeFooter = $themeNormal;
				 	
				 	}
				 	else 
				 	{
				 		$message = "Suppression n'a pas été effectué.";
				 		$typeMessage = 'avertissement';
				 		$themeFooter = $themeProbleme;
				 	}
				 	unset($DAO);
				 	include_once ($cheminDesVues . 'VueSupprimerAdmin.php');
				}
			}
}