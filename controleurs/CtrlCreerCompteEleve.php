<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlCreerCompteEleve.php : traiter la demande de création d'un compte élève par un administrateur
// Ecrit le 12/01/2016 par Nicolas Esteve
// Modifié le 20/5/2016 par Jim

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');
if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
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
	include_once ($cheminDesVues . 'VueCreerCompteEleve.php');
}
else {
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
		include_once ($cheminDesVues . 'VueCreerCompteEleve.php');
	}
	else {
		if ( $dao->existeAdrMail($adrMail) ) {
			// si l'adresse existe déjà, réaffichage de la vue
			$message = "Adresse mail déjà existante !";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueCreerCompteEleve.php');
		}
		else {
			// inclusion de la classe Eleve
			include_once ('modele/Eleve.class.php');
			// création d'un objet Eleve
			$id = 0; 							// le numéro sera affecté automatiquement par le SGBD
			$compteAccepte = true;				// en attente de la décision de l'administrateur de la base
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
				include_once ($cheminDesVues . 'VueCreerCompteEleve.php');
			}
			else {
				// lecture de la bdd pour récupérer l'id attribué au compte élève
				$nouveauMdp = Outils::creerMdp();					// création d'un mot de passe aléatoire de 8 caractères
				$ok = $dao->modifierMdp($unEleve->getAdrMail(), $nouveauMdp);
				// envoi d'un mail d'acceptation à l'intéressé avec son mot de passe
				$sujet = "Demande de création de votre compte élève dans l'annuaire des anciens du BTS Informatique";
				$message = "Votre compte a bien été crée et validée par un administrateur.\n\n";
				$message .= "Votre login de connexion est : " . $adrMail . "\n";
				$message .= "Votre mot de passe est : " . $nouveauMdp . "\n\n";
				$message .= "Cordialement.\n";
				$message .= "Les administrateurs de l'annuaire";
				$ok = Outils::envoyerMail($adrMail, $sujet, $message, $ADR_MAIL_ADMINISTRATEUR);	
				
				
				if ( ! $ok ) {
					// si l'envoi de mail a échoué, réaffichage de la vue avec un message explicatif
					$message = "Enregistrement effectué.<br>L'envoi du mail à l'utilisateur a rencontré un problème !";
					$typeMessage = 'avertissement';
					$themeFooter = $themeProbleme;
					include_once ($cheminDesVues . 'VueCreerCompteEleve.php');
				}
				else {
					// tout a fonctionné
					$message = "Enregistrement effectué.<br>Un mail va être envoyé à l'utilisateur !";
					$typeMessage = 'information';
					$themeFooter = $themeNormal;
					include_once ($cheminDesVues . 'VueCreerCompteEleve.php');
				}
			}
		}
		unset($dao);		// fermeture de la connexion à MySQL
	}
}
