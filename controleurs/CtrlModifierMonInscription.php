<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierMonInscription.php : traiter la demande de modification d'une inscription
// Ecrit le 27/05/2016 par Killian BOUTIN

include_once ('modele/DAO.class.php');
$dao = new DAO();

// mise en place de variable permanentes
// placement de la variable $urgent à true pour avoir les données les plus récentes, elles seront directement prise de la base de donnée et non de la variable de SESSION
$urgent = true;
$uneSoiree = $dao->getSoiree($urgent);

//obtention de l'adresseMail, puis de l'id de l'élève, puis de la situation de l'inscription de cet élève
$adrMail = $_SESSION['adrMail'];
$unEleve = $dao->getEleve($adrMail);
$idEleve = $unEleve->getId();
$idInscription = $dao->getIdInscription($idEleve); // donne l'id de l'inscription
$uneInscription = $dao->getInscriptionEleve($idEleve); // donne l'inscription en fonction de l'idEleve
$unTarif = $uneSoiree->getTarif();

// on vérifie si le demandeur de cette action est bien authentifié et qu'il n'a pas d'inscription

if (( $_SESSION['typeUtilisateur'] != 'eleve') || ( ( $_SESSION['typeUtilisateur'] == 'eleve') && ($idInscription == -1) )) {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else{
	if( (! isset ($_POST ["btnModifier"]) == true) && (! isset ($_POST ["btnAnnulation"]) == true ) ){
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$nbPersonnes = $uneInscription->getNbrePersonnes();
		
		// redirection vers la vue
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierMonInscription.php');
	}
	else{
		if (isset ($_POST ["btnModifier"]) == true )
		{
			$nbPersonnes = $_POST ["txtNbPlaces"];
			$montantRegle = 0;
			
			$Tarif = $unTarif * $nbPersonnes;
		
			$unNom = $unEleve->getNom();
			$unPrenom = $unEleve->getPrenom();
			$anneeDebutBTS = $unEleve->getAnneeDebutBTS();
				
			$dateInscription = date('d/m/Y', time());
			$montantRembourse = 0;
			$idSoiree = $uneSoiree->getId();
			$inscriptionAnnulee = 0;
				
			$uneInscription = new Inscription($idInscription, $unNom, $unPrenom, $anneeDebutBTS, $dateInscription, $nbPersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee, $Tarif);
				
			$ok = $dao->modifierInscription($uneInscription);
			if (!$ok)
			{
				$message ="L'application à rencontré un problème";
				$typeMessage = 'avertissement';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueModifierMonInscription.php');
			}
			else
			{
				$message ='Votre modification a bien été prise en compte ! <br>Le montant total que vous devez payer pour la soirée est de '. $Tarif . ' euros.';
				$typeMessage = 'information';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueModifierMonInscription.php');
			}
		}
		elseif (isset ($_POST ["btnAnnulation"]) == true )
		{
			// on redéclare la variable pour ne pas avoir de message d'erreur dans le corps HTML sous le message de confirmation d'annulation (elle est inutilisée mais utile)
			$nbPersonnes = $_POST ["txtNbPlaces"];
				
			$ok = $dao->annulerInscription($idEleve);
				
			if (!$ok)
			{
				$message ="L'application à rencontré un problème";
				$typeMessage = 'avertissement';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueModifierMonInscription.php');
			}
			else
			{
				$montantRegle = $uneInscription->getMontantRegle();
		
				if( $montantRegle < 0)
				{
					$sujet ="Remboursement";
					$corpsMessage  ="Votre inscription a bien été annulée.\n Un mail a été envoyé à l'administrateur vous allez être remboursé des ".$montantRegle." euros que vous nous aviez envoyée";
					$corpsMessage .="Cordialement.\n";
					$corpsMessage .="Les administrateurs de l'annuaire";
					Outils::envoyerMail($adrMail,$sujet, $corpsMessage,$ADR_MAIL_EMETTEUR);
				}
				$sujet ="Annulation";
				$corpsMessage ="L'utilisateur ".$unEleve->getPrenom()." ".$unEleve->getNom();
				$corpsMessage .=" a annulé son inscription.<br>";
		
				if( $montantRegle < 0)
				{
					$message .="IMPORTANT :  ".$unEleve->getPrenom()." ".$unEleve->getNom()." a payé ".$montantRegle." euros en avance. Il faut le rembourser au plus tôt";
				}
					
				Outils::envoyerMail($ADR_MAIL_ADMINISTRATEUR, $sujet, $corpsMessage, $ADR_MAIL_EMETTEUR);
		
		
				$message ='Votre réservation a été annulée';
				$typeMessage = 'information';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueModifierMonInscription.php');
			}
		}
		else
		{
			$message ="L'application a rencontrée un problème";
			$typeMessage = 'avertissement';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueModifierMonInscription.php');
		}
	}
}