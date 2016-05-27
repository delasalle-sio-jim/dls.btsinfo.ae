<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlCreerMonInscription.php : traiter la demande d'inscription ou d'annulation d'une inscription
// Ecrit le 02/02/2016 par Nicolas Esteve
// Modifié le 27/05/2016 par Killian BOUTIN

// A modifier quand la partie "SupprimerMonInscription" sera faite !

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
$idInscription = $dao->getIdInscription($idEleve);

$lesInscriptions = $dao->getLesInscriptions();
$unTarif = $uneSoiree->getTarif();

// on vérifie si le demandeur de cette action est bien authentifié
if ( $_SESSION['typeUtilisateur'] != 'eleve') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else {
	
	if( (! isset ($_POST ["btnInscription"]) == true) && ! isset ($_POST ["btnAnnulation"]) == true ){			
		// redirection vers la vue si aucune données n'est recu par le controleur	
	
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueCreerMonInscription.php');
	}
	else {
		if (isset ($_POST ["btnInscription"]) == true )
		{
			$nbPersonnes = $_POST ["txtNbPlaces"];
			$montantRegle = 0;
			
			$urgent = false;
			$Tarif = $unTarif * $nbPersonnes;

			$unNom = $unEleve->getNom();
			$unPrenom = $unEleve->getPrenom();
			$anneeDebutBTS = $unEleve->getAnneeDebutBTS();
			
			$dateInscription = date('d/m/Y', time());
			$montantRembourse = 0;
			$idSoiree = $uneSoiree->getId();
			$inscriptionAnnulee = false;
			
			$uneInscription = new Inscription($idEleve, $unNom, $unPrenom, $anneeDebutBTS, $dateInscription, $nbPersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee, $unTarif);
			
			$ok = $dao->creerInscription($uneInscription);
			if (!$ok)
			{
				$message ="L'application à rencontré un problème";
				$typeMessage = 'avertissement';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueCreerMonInscription.php');
			}
			else
			{
				$message ='Vous êtes inscrit ! <br>Le montant total que vous devez payer pour la soirée est de '. $Tarif . ' euros.';
				$typeMessage = 'information';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueCreerMonInscription.php');
			}
		}
		elseif (isset ($_POST ["btnAnnulation"]) == true )
		{
			
			$adrMail = $_SESSION['adrMail'];
			$unEleve = $dao->getEleve($adrMail);
			$idEleve = $unEleve->getId();
			 
			$ok = $dao->annulerInscription($idEleve);
			
			
			if (!$ok)
			{
				$message ="L'application à rencontré un problème";
				$typeMessage = 'avertissement';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueCreerMonInscription.php');
			}
			else 
			{
				
				$inscription = $dao->detailsInscription($idEleve);
				$montantRegle =$inscription->getmontantRegle();
				
				if( $montantRegle < 0)
				{
					$sujet ="Remboursement";
					$message  ="Votre inscription a bien été annulée.\n Un mail a été envoyé à l'administrateur vous allez être remboursé des ".$montantRegle." euros que vous nous aviez envoyée";
					$message .="Cordialement.\n";
					$message .="Les administrateurs de l'annuaire";
					Outils::envoyerMail($adrMail,$sujet, $message,$ADR_MAIL_EMETTEUR);
				}
				$sujet ="Annulation";
				$message ="L'utilisateur ".$unEleve->getPrenom()." ".$unEleve->getNom();
				$message .=" a annulé son inscription.<br>";
				
				if( $montantRegle < 0)
				{
					$message .="IMPORTANT :  ".$unEleve->getPrenom()." ".$unEleve->getNom()." a payé ".$montantRegle." euros en avance. Il faut le rembourser au plus tôt";
				}
					
				Outils::envoyerMail($ADR_MAIL_ADMINISTRATEUR, $sujet, $message, $ADR_MAIL_EMETTEUR);
				
				
				$message .='Votre réservation a été annulée';
				$typeMessage = 'information';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueCreerMonInscription.php');
			}
		}
		else 
		{
			$message ="L'application a rencontrée un problème";
			$typeMessage = 'avertissement';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueCreerMonInscription.php');
		}
	}
}