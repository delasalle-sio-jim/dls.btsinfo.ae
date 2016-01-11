<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlDemanderCreationCompte.php : traiter la demande de création de compte d'un élève
// Ecrit le 6/1/2016 par Jim

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
$lesFonctions = $dao->getLesFonctions();

if ( ! isset ($_POST ["btnEnvoyer"]) ) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$nom = '';
	$prenom = '';
	$sexe = '';
	$anneeDebutBTS = '';
	$tel = '';
	$adrMail = '';
	$etudesPostBTS = '';
	$rue = '';
	$codePostal = '';
	$ville = '';
	$entreprise = '';
	$idFonction = '';

	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueDemanderCreationCompte.php');
}
else {
	//$premierAppel = false;
	// récupération des données postées
	if ( empty ($_POST ["txtNom"]) == true)  $nom = "";  else   $nom = $_POST ["txtNom"];
	if ( empty ($_POST ["txtPrenom"]) == true)  $prenom = "";  else   $prenom = $_POST ["txtPrenom"];
	if ( empty ($_POST ["radioSexe"]) == true)  $sexe = "";  else   $sexe = $_POST ["radioSexe"];
	if ( empty ($_POST ["txtAnneeDebutBTS"]) == true)  $anneeDebutBTS = "";  else   $anneeDebutBTS = $_POST ["txtAnneeDebutBTS"];
	if ( empty ($_POST ["txtTel"]) == true)  $tel = "";  else   $tel = $_POST ["txtTel"];
	if ( empty ($_POST ["txtAdrMail"]) == true)  $adrMail = "";  else   $adrMail = $_POST ["txtAdrMail"];
	if ( empty ($_POST ["txtEtudesPostBTS"]) == true)  $etudesPostBTS = "";  else   $etudesPostBTS = $_POST ["txtEtudesPostBTS"];
	if ( empty ($_POST ["txtRue"]) == true)  $rue = "";  else   $rue = $_POST ["txtRue"];
	if ( empty ($_POST ["txtCodePostal"]) == true)  $codePostal = "";  else   $codePostal = $_POST ["txtCodePostal"];
	if ( empty ($_POST ["txtVille"]) == true)  $ville = "";  else   $ville = $_POST ["txtVille"];
	if ( empty ($_POST ["txtEntreprise"]) == true)  $entreprise = "";  else   $entreprise = $_POST ["txtEntreprise"];
	if ( empty ($_POST ["listeFonctions"]) == true)  $idFonction = "";  else   $idFonction = $_POST ["listeFonctions"];	
	
	if ($nom == '' || $prenom == '' || $sexe == '' || $anneeDebutBTS == '' || $adrMail == '' || Outils::estUneAdrMailValide($adrMail) == false || Outils::estUnCodePostalValide($codePostal) == false) {
		// si les données sont incorrectes ou incomplètes, réaffichage de la vue de suppression avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$typeMessage = 'avertissement';
		$themeFooter = $themeProbleme;
		include_once ($cheminDesVues . 'VueDemanderCreationCompte.php');
	}
	else {
		if ( $dao->existeAdrMail($adrMail) ) {
			// si l'adresse existe déjà, réaffichage de la vue
			$message = "Adresse mail déjà existante !";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueDemanderCreationCompte.php');
		}
		else {
			// inclusion de la classe Eleve
			include_once ('modele/Eleve.class.php');
			// création d'un objet Eleve
			$id = 0; 							// le numéro sera affecté automatiquement par le SGBD
			$compteAccepte = false;				// en attente de la décision de l'administrateur de la base
			$motDePasse = '';					// le mot de passe sera créé lors de l'acceptation du compte
			$dateDerniereMAJ = date('Y-m-d H:i:s', time());		// l'heure courante
			$unEleve = new Eleve($id, $nom, $prenom, $sexe, $anneeDebutBTS, $tel, $adrMail, $rue, $codePostal, 
				$ville, $entreprise, $compteAccepte, $motDePasse, $etudesPostBTS, $dateDerniereMAJ, $idFonction);
			// enregistrement de l'élève dans la BDD
			$ok = $dao->creerCompteEleve($unEleve);
			if ( ! $ok ) {
				// si l'enregistrement a échoué, réaffichage de la vue avec un message explicatif					
				$message = "Problème lors de l'enregistrement !";
				$typeMessage = 'avertissement';
				$themeFooter = $themeProbleme;
				include_once ($cheminDesVues . 'VueDemanderCreationCompte.php');
			}
			else {
				// lecture de la bdd pour récupérer l'id attribué au compte élève
				$unEleve = $dao->getEleve($adrMail);
				// envoi d'un mail de confirmation de l'enregistrement
				$sujet = "Demande de création d'un compte élève dans l'annuaire des anciens du BTS Informatique";
				$message = "Un élève (actuel ou ancien) vient de créer un compte.\n\n";
				$message .= "Les données enregistrées sont :\n\n";
				$message .= str_replace ("<br>", "\n", $unEleve->toString()) . "\n\n";
				$message .= "Pour accepter la création du compte, cliquez sur ce lien :\n";
				$message .= $ADR_SERVICE_WEB . "ValiderCreationCompte.php?idCompte=" . $unEleve->getId() . "&decision=acceptation";
				$message .= "\n\n";
				$message .= "Pour rejeter la création du compte, cliquez sur ce lien :\n";
				$message .= $ADR_SERVICE_WEB . "ValiderCreationCompte.php?idCompte=" . $unEleve->getId() . "&decision=rejet";				
				
				$ok = Outils::envoyerMail($ADR_MAIL_ADMINISTRATEUR, $sujet, $message, $ADR_MAIL_EMETTEUR);
				if ( ! $ok ) {
					// si l'envoi de mail a échoué, réaffichage de la vue avec un message explicatif
					$message = "Enregistrement effectué.<br>L'envoi du mail à l'administrateur a rencontré un problème !";
					$typeMessage = 'avertissement';
					$themeFooter = $themeProbleme;
					include_once ($cheminDesVues . 'VueDemanderCreationCompte.php');
				}
				else {
					// tout a fonctionné
					$message = "Enregistrement effectué.<br>Un mail va être envoyé à l'administrateur !";
					$typeMessage = 'information';
					$themeFooter = $themeNormal;
					include_once ($cheminDesVues . 'VueDemanderCreationCompte.php');
				}
			}
		}
		unset($dao);		// fermeture de la connexion à MySQL
	}
}
