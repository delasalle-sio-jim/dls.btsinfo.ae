<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlCreerMonInscription.php : traiter la demande d'inscription ou d'annulation d'une inscription
// Ecrit le 02/02/2016 par Nicolas Esteve
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
$eleveInscrit = $dao->getInscriptionEleve($idEleve);

$lesInscriptions = $dao->getLesInscriptions();

// on prend les données à afficher dans les Vues
$leRestaurant = $uneSoiree->getNomRestaurant();
$laDateSoiree = Outils::convertirEnDateFR($uneSoiree->getDateSoiree());
$lAdresse = $uneSoiree->getAdresse();
$leTarif = $uneSoiree->getTarif();
$leLienMenu = $uneSoiree->getLienMenu();
$laLatitude = $uneSoiree->getLatitude();
$laLongitude = $uneSoiree->getLongitude();

// on vérifie si le demandeur de cette action est bien authentifié et qu'il n'a pas d'inscription
if (( $_SESSION['typeUtilisateur'] != 'eleve') || ( ( $_SESSION['typeUtilisateur'] == 'eleve') && ($eleveInscrit != null) )) {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else {
	
	if (! isset ($_POST ["btnInscription"]) == true){			
		// redirection vers la vue si aucune données n'est recu par le controleur	
	
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueCreerMonInscription.php');
	}
	
	else{

		$nbPersonnes = $_POST ["txtNbPlaces"];
		$montantRegle = 0;
		
		$urgent = false;
		$montantTotal = $leTarif * $nbPersonnes;

		$unNom = $unEleve->getNom();
		$unPrenom = $unEleve->getPrenom();
		$anneeDebutBTS = $unEleve->getAnneeDebutBTS();
		
		$dateInscription = date('d/m/Y', time());
		$montantRembourse = 0;
		$idSoiree = $uneSoiree->getId();
		$inscriptionAnnulee = false;
		
		$uneInscription = new Inscription($idEleve, $unNom, $unPrenom, $anneeDebutBTS, $dateInscription, $nbPersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee, $leTarif);
		
		$ok = $dao->creerInscription($uneInscription);
			if (!$ok){
				$message ="L'application à rencontré un problème";
				$typeMessage = 'avertissement';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueCreerMonInscription.php');
			}
			else{
				$message ='Vous êtes inscrit ! <br>Le montant total que vous devez régler pour la soirée est de '. $montantTotal . ' euros.';
				$typeMessage = 'information';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueCreerMonInscription.php');
			}
	}
}