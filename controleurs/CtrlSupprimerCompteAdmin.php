<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlSupprimerCompteAdmin.php : traiter la demande de suppression d'un administrateur
// Ecrit le 06/01/2016 par Nicolas Esteve
// Modifié le 02/06/2016 par Killian BOUTIN

// on vérifie si le demandeur de cette action est bien authentifié
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else {
	if( (! isset ($_POST ["txtAdrMailAdmin"]) == true)&&( ! isset ($_POST ["btnSupprimerAdmin"]) == true)){			
		// redirection vers la vue si aucune données n'est recu par le controleur
		
		$adrMailAdmin = '';
		$etape = 0;
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueSupprimerCompteAdmin.php');
	}
	else {	
		// récupération des données postées en cas de données incomplètes
		if ( empty ($_POST ["txtAdrMailAdmin"]) == true)  $adrMailAdmin = '';  else   $adrMailAdmin = $_POST ["txtAdrMailAdmin"];
		
		include_once ('modele/DAO.class.php');
		$dao = new DAO();
		$utilisateur = $dao->getAdministrateur($adrMailAdmin);
		
		if(!$utilisateur ){
			$etape = 0;
			$message = 'L\'administrateur que vous tentez de supprimer n\'existe pas';
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;	
		}
		
		else{
			$etape = 1;
			$prenomAdmin = $utilisateur->getPrenom();
			$nomAdmin = $utilisateur->getNom();
			$txtMailAdmin = $utilisateur->getAdrMail();
		 					 				 	
			if(isset ($_POST ["btnSupprimerAdmin"]) == true) {
				
				$adrMailAdmin2 = $_POST["txtAdrMailAdmin2"];
				
				if($adrMailAdmin == $adrMailAdmin2){
					  		
					include_once ('modele/DAO.class.php');
					$dao = new DAO();
					$ok = $dao->supprimerCompteAdministrateur($adrMailAdmin);
							 	
					if ($ok) {	
						$message = "Suppression effectuée. L\'administrateur lié à l'adresse ".$adrMailAdmin." ne poura plus effectuer de modification.";
						$typeMessage = 'information';
						$themeFooter = $themeNormal;
						include_once ($cheminDesVues . 'VueSupprimerCompteAdmin.php');			 														 	
					}
			
				}
			
				else{
					$message = "Les deux adresses mail de correspondent pas.";
					$typeMessage = 'avertissement';
					$themeFooter = $themeProbleme;
					include_once ($cheminDesVues . 'VueSupprimerCompteAdmin.php');
				}
			}
		unset($DAO);
		include_once ($cheminDesVues . 'VueSupprimerCompteAdmin.php');
		}
	}
}
