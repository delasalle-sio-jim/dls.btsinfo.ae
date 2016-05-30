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

$idInscription = 108;
$unNom = "Boutin";
$unPrenom = "Killian";
$anneeDebutBTS = "2015";
$dateInscription = "13/05/2015";
$nbPersonnes = 7;
$montantRegle = 10;
$montantRembourse = 5;
$idEleve = 9;
$idSoiree = 1;
$inscriptionAnnulee = 0;
$Tarif = 24;


// on vérifie si le demandeur de cette action est bien authentifié et qu'il n'a pas d'inscription

if (( $_SESSION['typeUtilisateur'] != 'eleve') || ( ( $_SESSION['typeUtilisateur'] == 'eleve') && ($idInscription == -1) )) {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else{
	if( (! isset ($_POST ["btnModification"]) == true) && (! isset ($_POST ["btnAnnulation"]) == true ) ){
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$nbPersonnes = $uneInscription->getNbrePersonnes();
		
		// redirection vers la vue
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierMonInscription.php');
	}
	else{
		if (isset ($_POST ["btnModification"]) == true )
		{
			
			$idInscription = $uneInscription->getId();
			$unNom = $uneInscription->getNom();
			$unPrenom = $uneInscription->getPrenom();
			$anneeDebutBTS = $uneInscription->getAnneeDebutBTS();
			$dateInscription = date('d/m/Y', time()); // On modifie la date d'inscription
			$nbPersonnes = $_POST ["txtNbPlaces"]; // On modifie le nombre de personnes
			$montantRegle = $uneInscription->getMontantRegle();
			$montantRembourse = $uneInscription->getMontantRembourse();
			$idEleve = $uneInscription->getIdEleve();
			$idSoiree = $uneInscription->getIdSoiree();
			$inscriptionAnnulee = 0; // L'inscription à modifier ne sera pas annulée
			$Tarif = $unTarif * $nbPersonnes; // On modifie le tarif en fonction du nombre de personnes
			
				
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
				$montantRegle = $uneInscription->getMontantRegle();
				
				/* On calcul ce qui doit être payé. 
				 * Si $remboursement est négatif, c'est à l'ancien élève de payer l'opposé de $remboursement
				 * Sinon, le client doit se faire rembourser de "$remboursement";
				 */
				$remboursement = $montantRegle - $Tarif - $montantRembourse;
				
				if($remboursement > 0){
					$messageRemboursement = "Vous allez être remboursé des " . $remboursement . " euros en trop que vous nous aviez envoyés.\r\n";
				}
				elseif($remboursement < 0){
					$aPayer = - $remboursement;
					$messageRemboursement = "Le montant total que vous devez payer pour la soirée est de ". $Tarif . " euros.\r\n";
					$messageRemboursement .= "Vous avez payé " . $montantRegle . " euros et été remboursé de " . $montantRembourse . " euros.\r\n";
					$messageRemboursement .= "Il vous reste donc " . $aPayer . " euros à payer.\r\n";
				}
				else{
					$messageRemboursement = "Vous avez déjà payé la somme exacte pour cette soirée.\r\n";
				}
				
				$sujet ="Remboursement";
				$corpsMessage  ="Votre inscription a bien été modifiée.\r\nUn mail a été envoyé à l'administrateur.\r\n". $messageRemboursement;
				$corpsMessage .="Cordialement.\r\n";
				$corpsMessage .="Les administrateurs de l'annuaire.";
				Outils::envoyerMail($adrMail,$sujet, $corpsMessage,$ADR_MAIL_EMETTEUR);
				
				$sujet ="Modification";
				$corpsMessage ="L'utilisateur ".$unEleve->getPrenom()." ".$unEleve->getNom();
				$corpsMessage .=" a modifié son inscription.\r\n";
				
				if( $remboursement > 0)
				{
					$corpsMessage .="IMPORTANT :  ".$unEleve->getPrenom()." ".$unEleve->getNom()." a payé " . $remboursement . " euros en trop. Il faut le rembourser au plus tôt.";
				}
					
				Outils::envoyerMail($ADR_MAIL_ADMINISTRATEUR, $sujet, $corpsMessage, $ADR_MAIL_EMETTEUR);
				
				$message ='Votre modification a bien été prise en compte ! <br>Un mail vient de vous être envoyé avec les détails de paiements';
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
				$montantRembourse = $uneInscription->getMontantRembourse();
		
				if( $montantRegle > 0)
				{
					$sujet ="Remboursement";
					$corpsMessage  ="Votre inscription a bien été annulée.\r\n Un mail a été envoyé à l'administrateur.\r\n Vous allez être remboursé des " . $montantRegle . " euros que vous nous aviez envoyés.\r\n";
					$corpsMessage .="Cordialement.\r\n";
					$corpsMessage .="Les administrateurs de l'annuaire";
					Outils::envoyerMail($adrMail,$sujet, $corpsMessage,$ADR_MAIL_EMETTEUR);
				}
				
				$sujet ="Annulation";
				$corpsMessage ="L'utilisateur ".$unEleve->getPrenom()." ".$unEleve->getNom();
				$corpsMessage .=" a annulé son inscription.\r\n";
		
				if( $montantRegle > $montantRembourse)
				{
					$remboursement = $montantRegle - $montantRembourse;
					$corpsMessage .="IMPORTANT :  ".$unEleve->getPrenom()." ".$unEleve->getNom()." a payé ".$montantRegle." euros en avance et été remboursé de " . $montantRembourse . " euros. Il faut le rembourser de " . $remboursement . " euros au plus tôt.";
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