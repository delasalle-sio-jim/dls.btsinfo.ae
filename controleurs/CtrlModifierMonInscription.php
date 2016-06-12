<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierMonInscription.php : traiter la demande de modification d'une inscription
// Ecrit le 27/05/2016 par Killian BOUTIN
// Modifié le 06/06/2016 par Killian BOUTIN

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

// on prend les données à afficher dans les Vues
setlocale (LC_TIME, 'fr_FR.utf8','fra');

$leRestaurant = $uneSoiree->getNomRestaurant();
/* $laDateSoiree = Outils::convertirEnDateFR($uneSoiree->getDateSoiree()); */
	
/* on convertit la date en écriture française */
$laDateSoiree = $uneSoiree->getDateSoiree();
$laDateSoiree = strftime("%A %d %B",strtotime("$laDateSoiree"));
$lAdresse = $uneSoiree->getAdresse();
$leTarif = $uneSoiree->getTarif();
$leLienMenu = $uneSoiree->getLienMenu();
$laLatitude = $uneSoiree->getLatitude();
$laLongitude = $uneSoiree->getLongitude();

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
		
		$message = '';
		$typeMessage = '';					// 2 valeurs possibles : 'information' ou 'avertissement'
		$lienRetour = '#page_principale';	// pour le retour en version jQuery mobile
		// redirection vers la vue
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierMonInscription.php');
	}
	else{
		/* si on modifie */
		if (isset ($_POST ["btnModification"]) == true)
		{
			/* mais que le nombre de place est de 0, on le demande de mettre minimum 1 */
			if ($_POST ["txtNbPlaces"] == 0){
				
				$nbPersonnes = $uneInscription->getNbrePersonnes();
				$message ='Si vous souhaitez modifier votre inscription, merci de prendre au minimum une place.<br>Si vous voulez annuler, appuyez sur le bouton Annuler mon inscription';
				$typeMessage = 'avertissement';
				$lienRetour = '#page_principale';
				$themeFooter = $themeProbleme;
				include_once ($cheminDesVues . 'VueModifierMonInscription.php');
			}
			/* et que le nombre de places est différent de 0, on fait le traitement */
			else{
				
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
				$montantTotal = $leTarif * $nbPersonnes; // On modifie le tarif en fonction du nombre de personnes
				
					
				$uneInscription = new Inscription($idInscription, $unNom, $unPrenom, $anneeDebutBTS, $dateInscription, $nbPersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee, $montantTotal);
					
				$ok = $dao->modifierInscription($uneInscription);
				if (!$ok)
				{
					$message ="L'application à rencontré un problème.";
					$typeMessage = 'avertissement';
					$lienRetour = '#page_principale';
					$themeFooter = $themeProbleme;
					include_once ($cheminDesVues . 'VueModifierMonInscription.php');
				}
				else
				{
					$montantRegle = $uneInscription->getMontantRegle();
					
					/* On calcul ce qui doit être réglé. 
					 * Si $remboursement est négatif, c'est à l'ancien élève de payer l'opposé de $remboursement
					 * Sinon, le client doit se faire rembourser de "$remboursement";
					 */
					$remboursement = $montantRegle - $montantTotal - $montantRembourse;
					
					if($remboursement > 0){
						$messageRemboursement = "Vous allez être remboursé des " . $remboursement . " euros en trop que vous nous aviez envoyés.\r\n";
					}
					elseif($remboursement < 0){
						$aPayer = - $remboursement;
						$messageRemboursement = "Le montant total que vous devez régler pour la soirée est de ". $montantTotal . " euros.\r\n";
						$messageRemboursement .= "Vous avez reglé " . $montantRegle . " euros.\r\n";
						$messageRemboursement .= "Il vous reste " . $aPayer . " euros à payer.\r\n";
					}
					else{
						$messageRemboursement = "Vous avez déjà réglé la somme exacte pour cette soirée.\r\n";
					}
					
					$sujet ="Modification de votre inscription";
					$corpsMessage  ="Votre inscription a bien été modifiée.\r\nUn mail a été envoyé à l'administrateur.\r\n". $messageRemboursement;
					$corpsMessage .="Cordialement.\r\n";
					$corpsMessage .="Les administrateurs de l'annuaire.";
					Outils::envoyerMail($adrMail,$sujet, $corpsMessage,$ADR_MAIL_EMETTEUR);
					
					$sujet ="Modification de l'inscription d'un Ancien Eleve";
					$corpsMessage ="L'utilisateur ".$unEleve->getPrenom()." ".$unEleve->getNom();
					$corpsMessage .=" a modifié son inscription.\r\n";
					
					if( $remboursement > 0)
					{
						$corpsMessage .="IMPORTANT :  ".$unEleve->getPrenom()." ".$unEleve->getNom()." a reglé " . $remboursement . " euros en trop. Il faut le rembourser au plus tôt.";
					}
						
					Outils::envoyerMail($ADR_MAIL_ADMINISTRATEUR, $sujet, $corpsMessage, $ADR_MAIL_EMETTEUR);
					
					$message ='Votre modification a bien été prise en compte ! <br>Un mail vient de vous être envoyé avec les détails de paiements.';
					$typeMessage = 'information';
					$lienRetour = 'index.php?action=Menu#menu2';
					$themeFooter = $themeNormal;
					include_once ($cheminDesVues . 'VueModifierMonInscription.php');
				}
			}
		}
		elseif (isset ($_POST ["btnAnnulation"]) == true )
		{
			
			$nbPersonnes = $_POST ["txtNbPlaces"];
			
			if ($nbPersonnes != 0){
				
				$message ='Pour annuler votre inscription, veuillez mettre le nombre de places à réserver à 0.';
				$typeMessage = 'avertissement';
				$lienRetour = '#page_principale';
				$themeFooter = $themeProbleme;
				include_once ($cheminDesVues . 'VueModifierMonInscription.php');
			}
			else{
				$ok = $dao->annulerInscription($idEleve);
					
				if ( ! $ok)
				{
					$message ="L'application à rencontré un problème.";
					$typeMessage = 'avertissement';
					$lienRetour = '#page_principale';
					$themeFooter = $themeProbleme;
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
						$corpsMessage .="IMPORTANT :  ".$unEleve->getPrenom()." ".$unEleve->getNom()." a réglé ".$montantRegle." euros en avance et été remboursé de " . $montantRembourse . " euros. Il faut le rembourser de " . $remboursement . " euros au plus tôt.";
					}
						
					Outils::envoyerMail($ADR_MAIL_ADMINISTRATEUR, $sujet, $corpsMessage, $ADR_MAIL_EMETTEUR);
			
			
					$message ='Votre réservation a été annulée.';
					$typeMessage = 'information';
					$lienRetour = 'index.php?action=Menu#menu2';
					$themeFooter = $themeNormal;
					include_once ($cheminDesVues . 'VueModifierMonInscription.php');
				}
			}
		}
		else
		{
			$message ="L'application a rencontré un problème.";
			$typeMessage = 'avertissement';
			$lienRetour = '#page_principale';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifierMonInscription.php');
		}
	}
}