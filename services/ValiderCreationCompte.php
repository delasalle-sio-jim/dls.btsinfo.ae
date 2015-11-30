<?php
// Service web ValiderCreationCompte.php du projet DLS - BTS Info - Anciens élèves
// Ecrit le 29/11/2015 par Jim

// ce service web permet à un administrateur d'accepter ou de rejeter une demande de création de compte
// il envoie un mail au demandeur, avec son mot de passe en cas d'acceptation, ou un message de rejet
// il envoie également un mail à l'administrateur avec un compte-rendu d'exécution

// Le service web doit être appelé avec 2 paramètres obligatoires : idCompte (l'id du compte) et decision ('acceptation' ou 'rejet')
// Les paramètres peuvent être passés par la méthode GET (pratique pour les tests, mais à éviter en exploitation) :
//     http://<hébergeur>/ValiderCreationCompte.php?idCompte=1&decision=acceptation
// Les paramètres peuvent être passés par la méthode POST (à privilégier en exploitation pour la confidentialité des données) :
//     http://<hébergeur>/ValiderCreationCompte.php

// déclaration des variables globales pour pouvoir les utiliser aussi dans les fonctions
global $dao, $idCompte, $decision;
global $ADR_MAIL_EMETTEUR, $ADR_MAIL_ADMINISTRATEUR, $ADR_SERVICE_WEB;

// inclusion de la classe Outils
include_once ('../modele/Outils.class.php');
// inclusion des paramètres de l'application
include_once ('../modele/parametres.localhost.php');
	
// Récupération des données transmises
// la fonction $_GET récupère une donnée passée en paramètre dans l'URL par la méthode GET
if ( empty ($_GET ["idCompte"]) == true)  $idCompte = "";  else   $idCompte = $_GET ["idCompte"];
if ( empty ($_GET ["decision"]) == true)  $decision = "";  else   $decision = $_GET ["decision"];
// si l'URL ne contient pas les données, on regarde si elles ont été envoyées par la méthode POST
// la fonction $_POST récupère une donnée envoyées par la méthode POST
if ( $idCompte == "" && $decision == "" )
{	if ( empty ($_POST ["idCompte"]) == true)  $idCompte = "";  else   $idCompte = $_POST ["idCompte"];
	if ( empty ($_POST ["decision"]) == true)  $decision = "";  else   $decision = $_POST ["decision"];
}
			 
// Contrôle de la présence et de la correction des paramètres
if ( $idCompte == "" || ( $decision != "acceptation" && $decision != "rejet" ) )
{	$message = "Erreur : données incomplètes ou incorrectes.";
}
else
{	// inclusion de la classe Eleve
	include_once ('../modele/Eleve.class.php');
	
	// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
	include_once ('../modele/DAO.class.php');
	$dao = new DAO();
	
	// recherche de l'élève par son identifiant
	$unEleve = $dao->getEleve($idCompte);
	if ( $unEleve == null )
	{	$message = "Erreur : numéro d'élève inexistant ou incorrect.";
	}
	else
	{	$ok = $dao->validerCreationCompte($idCompte, $decision);
		if ( $decision == 'acceptation' ) {
			$nouveauMdp = Outils::creerMdp();					// création d'un mot de passe aléatoire de 8 caractères
			$ok = $dao->modifierMdp($unEleve->getAdrMail(), $nouveauMdp);
			// envoi d'un mail d'acceptation à l'intéressé avec son mot de passe
			$sujet = "Demande de création de votre compte élève dans l'annuaire des anciens du BTS Informatique";
			$message = "Votre demande de création de compte a bien été validée.\n\n";
			$message .= "Votre login de connexion est : " . $unEleve->getAdrMail() . "\n";
			$message .= "Votre mot de passe est : " . $nouveauMdp . "\n\n";
			$message .= "Cordialement.\n";
			$message .= "Les administrateurs de l'annuaire";
			$ok = Outils::envoyerMail($unEleve->getAdrMail(), $sujet, $message, $ADR_MAIL_ADMINISTRATEUR);
			
			// envoi d'un mail à l'administrateur
			$sujet = "Création acceptée d'un compte élève dans l'annuaire des anciens du BTS Informatique";
			$message = "Le compte de l'élève " . $unEleve->getPrenom() . " " . $unEleve->getNom() . " a été accepté.\n";
			$message .= "Un mail de confirmation lui a été envoyé.";
			$ok = Outils::envoyerMail($ADR_MAIL_ADMINISTRATEUR, $sujet, $message, $ADR_MAIL_EMETTEUR);
		}
		else {
			// envoi d'un mail de rejet à l'intéressé
			$sujet = "Demande de création de votre compte élève dans l'annuaire des anciens du BTS Informatique";
			$message = "Désolé, votre demande de création de compte a été rejetée.\n\n";
			$message .= "Les données indiquées ne correspondent à aucun de nos anciens élèves.\n";
			$message .= "En cas d'erreur de notre part, n'hésitez pas à réessayer, ou à répondre directement à ce mail.\n";
			$message .= "Cordialement.\n\n";
			$message .= "Les administrateurs de l'annuaire";
			$ok = Outils::envoyerMail($unEleve->getAdrMail(), $sujet, $message, $ADR_MAIL_ADMINISTRATEUR);
				
			// envoi d'un mail à l'administrateur
			$sujet = "Création rejetée d'un compte élève dans l'annuaire des anciens du BTS Informatique";
			$message = "Le compte de l'élève " . $unEleve->getPrenom() . " " . $unEleve->getNom() . " a été rejeté.\n";
			$message .= "Un mail de confirmation lui a été envoyé.";
			$ok = Outils::envoyerMail($ADR_MAIL_ADMINISTRATEUR, $sujet, $message, $ADR_MAIL_EMETTEUR);					
		}		
	}
	// ferme la connexion à MySQL :
	unset($dao);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Validation DLS - BTS Informatique</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>
	<p><?php echo $message; ?></p>
	<p><a href="Javascript:window.close();">Fermer</a></p>
</body>
</html>