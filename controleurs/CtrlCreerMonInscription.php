<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlCreerMonInscription.php : traiter la demande d'inscription ou d'annulation d'une inscription
// Ecrit le 02/02/2016 par Nicolas Esteve
// Modifié le 20/5/2016 par Jim

include_once ('modele/DAO.class.php');
$dao = new DAO();

// mise en place de variable permanentes
$urgent = true;
$Soiree = $dao->GetSoiree($urgent);
$tarif = $Soiree->getTarif();

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
			$Soiree = $dao->GetSoiree($urgent);
			$Tarif = $Soiree->getTarif();
			$Tarif = $Tarif * $nbPersonnes;
			
			$adrMail = $_SESSION['adrMail'];
			$Eleve = $dao->getEleve($adrMail);
			
			$idEleve = $Eleve->getId();
			
			$dateInscription = date('Y-m-d H:i:s', time());
			$montantRembourse = 0;
			$idSoiree = $Soiree->getId();
			$inscriptionAnnulee = false;
			
			$uneInscription = new Inscription($idEleve, $dateInscription, $nbPersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee);
			
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
			$Eleve = $dao->getEleve($adrMail);
			$idEleve = $Eleve->getId();
			 
			$ok = $dao->annulation($idEleve);
			
			
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
					$message  ="Votre inscription à bien été annulée.\n Un mail a été envoyé a l'administrateur vous allez être remboursé des ".$montantRegle." euros que vous nous aviez envoyé";
					$message .="Cordialement.\n";
					$message .="Les administrateurs de l'annuaire";
					Outils::envoyerMail($adrMail,$sujet, $message,$ADR_MAIL_EMETTEUR);
				}
				$sujet ="Annulation";
				$message ="L'utilisateur ".$Eleve->getPrenom()." ".$Eleve->getNom();
				$message .=" à annulé son inscription.";
				
				if( $montantRegle < 0)
				{
					$message .="IMPORTANT :  ".$Eleve->getPrenom()." ".$Eleve->getNom()." à payé ".$montantRegle." euros en avance. Il faut le rebourser au plus tôt";
				}
					
				Outils::envoyerMail($ADR_MAIL_ADMINISTRATEUR, $sujet, $message, $ADR_MAIL_EMETTEUR);
				
				
				$message .='Votre réservation à été annulée';
				$typeMessage = 'information';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueCreerMonInscription.php');
			}
		}
		else 
		{
			$message ="L'application à rencontrée un problème";
			$typeMessage = 'avertissement';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueCreerMonInscription.php');
		}
	}
}