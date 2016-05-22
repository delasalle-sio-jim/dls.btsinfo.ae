<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierMaFichePersoEleve.php : traiter la demande de modification des informations d'un élève
// Ecrit le 11/01/2016 par Nicolas Esteve
// Modifié le 22/5/2016 par Jim

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
$lesFonctions = $dao->getLesFonctions();

// recherche de la fiche élève dans la BDD à partir de son adresse mail
$unEleve = $dao->getEleve($_SESSION['adrMail']);

if ( ! isset ($_POST ["btnModifier"]) ) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$nom = $unEleve->getNom();
	$prenom = $unEleve->getPrenom();
	$sexe = $unEleve->getSexe();
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
	include_once ($cheminDesVues . 'VueModifierMaFichePersoEleve.php');
}
else {

	// récupération des données postées
	if ( empty ($_POST ["txtNom"]) == true)  $nom = "";  else   $nom = $_POST ["txtNom"];
	if ( empty ($_POST ["txtPrenom"]) == true)  $prenom = "";  else   $prenom = $_POST ["txtPrenom"];
	if ( empty ($_POST ["radioSexe"]) == true)  $sexe = "";  else   $sexe = $_POST ["radioSexe"];
	if ( empty ($_POST ["txtAnneeDebutBTS"]) == true)  $anneeDebutBTS = "";  else   $anneeDebutBTS = $_POST ["txtAnneeDebutBTS"];
	if ( empty ($_POST ["txtTel"]) == true)  $tel = "";  else   $tel = $_POST ["txtTel"];
	if ( empty ($_POST ["txtEtudesPostBTS"]) == true)  $etudesPostBTS = "";  else   $etudesPostBTS = $_POST ["txtEtudesPostBTS"];
	if ( empty ($_POST ["txtRue"]) == true)  $rue = "";  else   $rue = $_POST ["txtRue"];
	if ( empty ($_POST ["txtCodePostal"]) == true)  $codePostal = "";  else   $codePostal = $_POST ["txtCodePostal"];
	if ( empty ($_POST ["txtVille"]) == true)  $ville = "";  else   $ville = $_POST ["txtVille"];
	if ( empty ($_POST ["txtEntreprise"]) == true)  $entreprise = "";  else   $entreprise = $_POST ["txtEntreprise"];
	if ( empty ($_POST ["listeFonctions"]) == true)  $idFonction = "";  else   $idFonction = $_POST ["listeFonctions"];	
	// on recupère l'adresse mail de l'utilisateur afin de l'utiliser comme identifiant dans la requete SQL
	$adrMail = $_SESSION['adrMail'];

	if ($nom == '' || $prenom == '' || $sexe == '' || $anneeDebutBTS == '' || Outils::estUnCodePostalValide($codePostal) == false) {
		// si les données sont incorrectes ou incomplètes, réaffichage de la vue de suppression avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$typeMessage = 'avertissement';
		$themeFooter = $themeProbleme;
		include_once ($cheminDesVues . 'VueModifierMaFichePersoEleve.php');
	}
	else {
		// modification de l'objet Eleve
		$unEleve->setNom($nom);
		$unEleve->setPrenom($prenom);
		$unEleve->setSexe($sexe);
		$unEleve->setAnneeDebutBTS($anneeDebutBTS);
		$unEleve->setTel($tel);
		$unEleve->setEtudesPostBTS($etudesPostBTS);
		$unEleve->setRue($rue);
		$unEleve->setCodePostal($codePostal);
		$unEleve->setVille($ville);
		$unEleve->setEntreprise($entreprise);
		$unEleve->setIdFonction($idFonction);		
		$unEleve->setDateDerniereMAJ(date('Y-m-d H:i:s', time()));		// l'heure courante
		
		$ok = $dao->modifierCompteEleve($unEleve);
		if ($ok) 
		{	$message = "Modifications effectuées.";
			$typeMessage = 'information';
			$themeFooter = $themeNormal;
			include_once ($cheminDesVues . 'VueModifierMaFichePersoEleve.php');
		}
		else
		{	$message = "L'application a rencontré un problème.";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifierMaFichePersoEleve.php');
		}
	}
}

