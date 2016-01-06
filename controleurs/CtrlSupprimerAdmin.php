<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlChangerDeMdp.php : traiter la demande de changement de mot de passe
// Ecrit le 06/01/2016 par Nicolas Esteve

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
				include_once ($cheminDesVues . 'VueSupprimerAdmin.php');
			}
			else {
				
				//if ( ! isset ($_POST ["btnDetailAdmin"]) ) {
					// $txtAdrMailAdmin ='';
			//	}
				
				// récupération des données postées
					//en cas de données incomplètes
					if ( empty ($_POST ["txtAdrMailAdmin"]) == true)  $adrMailAdmin = '';  else   $adrMailAdmin = $_POST ["txtAdrMailAdmin"];
					
					 include_once ('modele/DAO.class.php');
					 $dao = new DAO();
					 $utilisateur = $dao->getAdministrateur($adrMailAdmin);
					 if(! $utilisateur )
					 {
					 	$etape = 0;
					 	$message = 'L\'administrateur que vous tentez de supprimer n\'existe pas';
					 	$typeMessage = 'avertissement';
					 	$themeFooter = $themeProbleme;
					 	
					 }
						 else 
						 {
						 	$etape = 1;
						 	$prenomAdmin = $utilisateur->getPrenom();
						 	$nomAdmin = $utilisateur->getNom();
						 	$txtMailAdmin = $utilisateur->getAdrMail();
						 					 				 	
						 }
							 if(isset ($_POST ["btnSupprimerAdmin"]) == true) {
							 	
							 	$adrMailAdmin2 = $_POST["txtAdrMailAdmin2"];
							 	
							  	if($adrMailAdmin == $adrMailAdmin2) {
							  		
								 	include_once ('modele/DAO.class.php');
								 	$dao = new DAO();
								 	$ok = $dao->supprimerAdministrateur($adrMailAdmin);
							 
						 	if ( $ok ) {
							 		
						 		$message = "Suppression effectué. L\'administrateur lié a l'adresse ".$adrMailAdmin." ne poura plus effectuer de modification.";
						 		$typeMessage = 'information';
						 		$themeFooter = $themeNormal;
						 		include_once ($cheminDesVues . 'VueSupprimerAdmin.php');
						 														 	
						}
						}
						else
						{
							$message = "les deux adresses mail de correspondent pas.";
							$typeMessage = 'avertissement';
							$themeFooter = $themeProbleme;
							include_once ($cheminDesVues . 'VueSupprimerAdmin.php');
						}
					 }
				 	unset($DAO);
				 	include_once ($cheminDesVues . 'VueSupprimerAdmin.php');
				}
			}
