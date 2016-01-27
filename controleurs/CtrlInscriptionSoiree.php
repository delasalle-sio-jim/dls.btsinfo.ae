<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlSupprimerAdmin.php : traiter la demande de suppression d'un admin
// Ecrit le 26/01/2016 par Nicolas Esteve
include_once ('modele/DAO.class.php');
$dao = new DAO();
//mise en place de variable permanantes
$urgent = true;
$Soiree = $dao->GetDonnesSoiree($urgent);
$tarif = $Soiree->getTarif();
// on vérifie si le demandeur de cette action est bien authentifié

if ( $_SESSION['typeUtilisateur'] != 'eleve') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else {
	if( (! isset ($_POST ["btnInscription"]) == true) ){			
		// redirection vers la vue si aucune données n'est recu par le controleur
	
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueInscriptionSoiree.php');
	}
	else {
		if(isset ($_POST ["btnInscription"]) == true)
		{
			
			$urgent = false;
			$Soiree = $dao->GetDonnesSoiree($urgent);
			$Tarif = $Soiree->getTarif();
			
			$nbPersonnes = $_POST ["txtNbPlaces"];
			$montant = $Tarif * $nbPersonnes;
			
			$adrMail = $_SESSION['adrMail'];
			$Eleve = $dao->getEleve($adrMail);
			
			$idEleve = $Eleve->getId();
			
			$dateInscription = date('Y-m-d H:i:s', time());
			$montantRembourse = 0;
			$idSoiree = $Soiree->getId();
			
			
			$ok = $dao->Inscription($dateInscription, $nbPersonnes, $montant, $montantRembourse, $idEleve, $idSoiree);
			

			$message = 'Vous êtes inscrit ! <br>Le montant total que vous devez payer pour soirée est de '.$montant.' euros.';
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueInscriptionSoiree.php');
		}
		else 
		{
			
			$urgent = false;
			$Soiree = $dao->GetDonnesSoiree($urgent);
			$Tarif = $Soiree->getTarif();
			
			$nbPersonnes = $_POST ["txtNbPlaceS"];
			$montant = $Tarif * $nbPersonnes;
			
			$adrMail = $_SESSION['adrMail'];
			$Eleve = $dao->getEleve($adrMail);
			
			$idEleve = $Eleve->getId();
			
			$dateInscription = date('Y-m-d H:i:s', time());
			$montantRembourse = 0;
			$idSoiree = $Soiree->getId();
			
			
			$ok = $dao->Inscription($id, $dateInscription, $nbPersonnes, $montant, $montantRembourse, $idEleve, $idSoiree);
			

			$message = 'Vous êtes inscrit ! <br>Le montant total que vous devez payer pour soirée est de '.$montant.' euros.';
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			
			
		}
	}
}