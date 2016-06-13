<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction du contrôleur CtrlModifierReglementsRemboursements.php : traiter la modification d'une inscription par un administrateur
	// Ecrit le 12/1/2016 par Nicolas Esteve
	// Modifié le 31/05/2016 par Killian BOUTIN
	
	// inclusion de la classe Outils
	include_once ('modele/Outils.class.php');
	include_once ('modele/Inscription.class.php');
	if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
		// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
		// dans ce cas, on provoque une redirection vers la page de connexion
		header ("Location: index.php?action=Deconnecter");
	}
	// connexion du serveur web à la base MySQL
	include_once ('modele/DAO.class.php');
	$dao = new DAO();
	$themeFooter = $themeNormal;
	$etape = 0;
	$message = "";

	if( (! isset ($_POST ["listeEleves"]) == true) && ( ! isset ($_POST ["btnModifier"]) == true)){
		// redirection vers la vue si aucune données n'est recu par le controleur
		$lesMails = $dao->getLesAdressesMailsDesInscrits();
		$idEleve = "";
		$message = "";
		$typeMessage = "";
		$etape = 0;
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierReglementsRemboursements.php');
	}
	
	elseif( isset ($_POST ["btnDetail"]) == true && ( isset($_POST['btnModifier']) == false ))
	{	/* si on appuie sur "obtenir des details" */
		if ( $dao->existeAdrMail($_POST ["listeEleves"]) == false)
		{	/* si l'adresse entrée est invalide (non présent dans la base) on obtient un message d'avertissement */
			$message = "L'étudiant possédant l'email " . $_POST ["listeEleves"] . " n'est pas incrit à la soirée.";
			$typeMessage = "avertissement";
			$lienRetour = '#page_principale';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifierReglementsRemboursements.php');
		}
		else
		{  	/* si on rentre une adresse correcte, on récupère les données dans des variables pour pouvoir les afficher dans la vue */
		
			$adrMailEleve = $_POST ["listeEleves"];
			
			/* on met $etape à 1 pour afficher le reste du formulaire */
			$etape = 1;
			$unEleve = $dao->getEleve($adrMailEleve);
			$idEleve = $unEleve->getId();
			$_SESSION['idEleve'] = $idEleve;
			
			$uneInscription = $dao->getInscriptionEleve($idEleve);
			
			$unNom = $uneInscription->getNom();
			$unPrenom = $uneInscription->getPrenom();
			
			$unNbrePersonnes = $uneInscription->getNbrePersonnes();
			$dateInscription = $uneInscription->getDateInscription();
			$montantRembourse = number_format($uneInscription->getMontantRembourse(), 2, '.', ' ');
			$montantRegle = number_format($uneInscription->getMontantRegle(), 2, '.', ' ');
			$montantTotal = number_format($uneInscription->getTarif() * $unNbrePersonnes - $uneInscription->getMontantRegle() + $uneInscription->getMontantRembourse(), 2, ',', ' ');
			include_once ($cheminDesVues . 'VueModifierReglementsRemboursements.php');
		
		}
	}	
	/* si on appuie sur modifier */
	elseif (isset ($_POST['btnModifier']))
	{
		/* on execute le traitement (même si l'inscription sera peut-être annulée) au cas où il y a eu paiement en avance, remboursement etc.. */
		if ( empty ($_POST ["txtMontantRembourse"]) == true)  $montantRembourse = "0,00";  else   $montantRembourse = $_POST ["txtMontantRembourse"];
		if ( empty ($_POST ["txtMontantRegle"]) == true)  $montantRegle = "0,00";  else   $montantRegle = $_POST ["txtMontantRegle"];
		/*
		$adrMailEleve = $_POST ["listeEleves"];
		$unEleve = $dao->getEleve($adrMailEleve);
		$idEleve = $unEleve->getId();
		*/
		$unEleve = $dao->getEleve($_SESSION['idEleve']);
		$uneInscription = $dao->getInscriptionEleve($_SESSION['idEleve']);
		
		/* on reprend l'adresse pour éviter les messages d'erreurs */
		$adrMailEleve = $unEleve->getAdrMail();
		
		$unId = $uneInscription->getId();
		$unNom = $uneInscription->getNom();
		$unPrenom = $uneInscription->getPrenom();
		$anneeDebutBTS = $uneInscription->getAnneeDebutBTS();
		$dateInscription = $uneInscription->getDateInscription();
		$unNbrePersonnes = $uneInscription->getNbrePersonnes();
		/* $montantRegle et $montantRembourse sont déjà déclarés au dessus */
		$idEleve = $_SESSION['idEleve'];
		$idSoiree = $uneInscription->getIdSoiree();
		$inscriptionAnnulee = $uneInscription->getInscriptionAnnulee();
		$leTarif = $uneInscription->getTarif();
		/* le montant restant à payer est le montant total à payer - le montant qu'il a déjà payé + le montant qui lui a été remboursé */
		$montantTotal = number_format($leTarif * $unNbrePersonnes - $uneInscription->getMontantRegle() + $uneInscription->getMontantRembourse(), 2, ',', ' ');
		$uneInscription = new Inscription($unId, $unNom, $unPrenom, $anneeDebutBTS, $dateInscription, $unNbrePersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee, $leTarif);
		
		$ok = $dao->modifierInscription($uneInscription);
		$etape = 1;
		
		if(isset($_POST['caseConfirmation'])){
			$ok = $dao->annulerInscription($idEleve);
			$message .= "L'inscription a bien été annulée.";
		}
		
		unset($_SESSION['idEleve']);
		
		if($ok)
		{
			$message = "Modifications effectuées avec succès<br>" . $message;
			$typeMessage = "information";
			$lienRetour = 'index.php?action=Menu#menu2';
		}
		else 
		{
			$message = "L'application à rencontré un problème";
			$typeMessage = "avertissement";
			$lienRetour = '#page_principale';
		}
		include_once ($cheminDesVues . 'VueModifierReglementsRemboursements.php');
		
	}