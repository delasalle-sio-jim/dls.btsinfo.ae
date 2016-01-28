<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifFichePerso.php : traiter la demande de modification des informations d'un d'un élève
// Ecrit le 11/01/2016 par Nicolas Esteve


// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
$lesFonctions = $dao->getLesFonctions();

if ( ! isset ($_POST ["btnModifier"]) ) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	
	$unEleve = $dao->getEleve($_SESSION['adrMail']);
	
	$nom = $unEleve->getNom();
	$prenom = $unEleve->getPrenom();
	$anneeDebutBTS = $unEleve->getAnneeDebutBTS();
	$tel =$unEleve->getTel();
	$etudesPostBTS = $unEleve->getEtudesPostBTS();
	$rue = $unEleve->getRue();
	$codePostal = $unEleve->getCodePostal();
	$ville = $unEleve->getVille();
	$entreprise = $unEleve->getEntreprise();
	$idFonction = $unEleve->getIdFonction();

	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueModifFichePerso.php');
}
else {

	// récupération des données postées
	if ( empty ($_POST ["txtNom"]) == true)  $nom = "";  else   $nom = $_POST ["txtNom"];
	if ( empty ($_POST ["txtPrenom"]) == true)  $prenom = "";  else   $prenom = $_POST ["txtPrenom"];
	if ( empty ($_POST ["txtAnneeDebutBTS"]) == true)  $anneeDebutBTS = "";  else   $anneeDebutBTS = $_POST ["txtAnneeDebutBTS"];
	if ( empty ($_POST ["txtTel"]) == true)  $tel = "";  else   $tel = $_POST ["txtTel"];
	if ( empty ($_POST ["txtEtudesPostBTS"]) == true)  $etudesPostBTS = "";  else   $etudesPostBTS = $_POST ["txtEtudesPostBTS"];
	if ( empty ($_POST ["txtRue"]) == true)  $rue = "";  else   $rue = $_POST ["txtRue"];
	if ( empty ($_POST ["txtCodePostal"]) == true)  $codePostal = "";  else   $codePostal = $_POST ["txtCodePostal"];
	if ( empty ($_POST ["txtVille"]) == true)  $ville = "";  else   $ville = $_POST ["txtVille"];
	if ( empty ($_POST ["txtEntreprise"]) == true)  $entreprise = "";  else   $entreprise = $_POST ["txtEntreprise"];
	if ( empty ($_POST ["listeFonctions"]) == true)  $idFonction = "";  else   $idFonction = $_POST ["listeFonctions"];	
	// on recupère l'adresse mail de l'utilisateur afin de l'utiliser comme identifiant dans la requete SQL
	$mail = $_SESSION['adrMail'];

	
	$ok = $dao->modifierFichePerso($nom, $prenom, $anneeDebutBTS, $mail, $tel, $rue, $ville, $codePostal, $etudesPostBTS, $entreprise, $idFonction);
	
	if ($ok) 
		{
			
				$message = "Modifications effectuées.";
				$typeMessage = 'information';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueModifFichePerso.php');
		}
		else
		{
			$message = "l\'application a rencontré un problème.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifFichePerso.php');
		}
	}


