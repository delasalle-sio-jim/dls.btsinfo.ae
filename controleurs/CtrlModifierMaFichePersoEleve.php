<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierMaFichePersoEleve.php : traiter la demande de modification des informations d'un élève
// Ecrit le 11/01/2016 par Nicolas Esteve
// Modifié le 07/06/2016 par Killian BOUTIN

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
$lesFonctions = $dao->getLesFonctions();

// recherche de la fiche élève dans la BDD à partir de son adresse mail
$unEleve = $dao->getEleve($_SESSION['adrMail']);
$adrMailSession = $_SESSION['adrMail'];

if ( ! isset ($_POST ["btnModifier"]) ) {
	// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
	$nom = $unEleve->getNom();
	$prenom = $unEleve->getPrenom();
	$sexe = $unEleve->getSexe();
	$anneeDebutBTS = $unEleve->getAnneeDebutBTS();
	$adrMail = $unEleve->getAdrMail();
	$tel =$unEleve->getTel();
	$etudesPostBTS = $unEleve->getEtudesPostBTS();
	$rue = $unEleve->getRue();
	$codePostal = $unEleve->getCodePostal();
	$ville = $unEleve->getVille();
	$entreprise = $unEleve->getEntreprise();
	$idFonction = $unEleve->getIdFonction();

	$message = '';
	$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
	$lienRetour = '#page_principale';
	$themeFooter = $themeNormal;
	include_once ($cheminDesVues . 'VueModifierMaFichePersoEleve.php');
}
else {
	
	// récupération des données postées
	if ( empty ($_POST ["txtNom"]) == true)  $nom = $unEleve->getNom();  else   $nom = $_POST ["txtNom"];
	if ( empty ($_POST ["txtPrenom"]) == true)  $prenom = $unEleve->getPrenom();  else   $prenom = $_POST ["txtPrenom"];
	if ( empty ($_POST ["radioSexe"]) == true)  $sexe = $unEleve->getSexe();  else   $sexe = $_POST ["radioSexe"];
	if ( empty ($_POST ["txtAnneeDebutBTS"]) == true)  $anneeDebutBTS = $unEleve->getAnneeDebutBTS();  else   $anneeDebutBTS = $_POST ["txtAnneeDebutBTS"];
	if ( empty ($_POST ["txtTel"]) == true)  $tel = "";  else   $tel = $_POST ["txtTel"];
	if ( empty ($_POST ["txtAdrMail"]) == true)  $adrMail = $unEleve->getAdrMail();  else   $adrMail = $_POST ["txtAdrMail"];
	if ( empty ($_POST ["txtEtudesPostBTS"]) == true)  $etudesPostBTS = "";  else   $etudesPostBTS = $_POST ["txtEtudesPostBTS"];
	if ( empty ($_POST ["txtRue"]) == true)  $rue = "";  else   $rue = $_POST ["txtRue"];
	if ( empty ($_POST ["txtCodePostal"]) == true)  $codePostal = "";  else   $codePostal = $_POST ["txtCodePostal"];
	if ( empty ($_POST ["txtVille"]) == true)  $ville = "";  else   $ville = $_POST ["txtVille"];
	if ( empty ($_POST ["txtEntreprise"]) == true)  $entreprise = "";  else   $entreprise = $_POST ["txtEntreprise"];
	if ( $_POST ["listeFonctions"] == 0)  $idFonction = 0;  else   $idFonction = $_POST ["listeFonctions"];

	if ($nom == '' || $prenom == '' || $sexe == '' || $anneeDebutBTS == '' || Outils::estUneAdrMailValide($adrMail) == false || Outils::estUnCodePostalValide($codePostal) == false || $idFonction == '0') {
		// si les données sont incorrectes ou incomplètes, réaffichage de la vue de suppression avec un message explicatif
		$message = 'Données incomplètes ou incorrectes !';
		$typeMessage = 'avertissement';
		$lienRetour = '#page_principale';
		$themeFooter = $themeProbleme;
		include_once ($cheminDesVues . 'VueModifierMaFichePersoEleve.php');
	}
	else {
		/* si il change d'adresse mail et que cette nouvelle existe dans la base de données */
		if ($adrMail != $adrMailSession AND $dao->existeAdrMail($adrMail)){
			$message = 'Adresse mail existante !';
			$typeMessage = 'avertissement';
			$lienRetour = '#page_principale';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifierMaFichePersoEleve.php');
		}
		else{
			$unEleve->getId();
			// modification de l'objet Eleve
			$unEleve->setNom($nom);
			$unEleve->setPrenom($prenom);
			$unEleve->setSexe($sexe);
			$unEleve->setAnneeDebutBTS($anneeDebutBTS);
			$unEleve->setTel($tel);
			$unEleve->setAdrMail($adrMail);
			$unEleve->setEtudesPostBTS($etudesPostBTS);
			$unEleve->setRue($rue);
			$unEleve->setCodePostal($codePostal);
			$unEleve->setVille($ville);
			$unEleve->setEntreprise($entreprise);
			$unEleve->setIdFonction($idFonction);		
			$unEleve->setDateDerniereMAJ(date('Y-m-d H:i:s', time()));		// l'heure courante
			
			$ok = $dao->modifierCompteEleve($unEleve);
			if ($ok) 
			{	
				/* la variable de session change */
				$_SESSION['adrMail'] = $adrMail;
				$message = "Modifications effectuées.";
				$typeMessage = 'information';
				$lienRetour = 'index.php?action=Menu#menu1';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueModifierMaFichePersoEleve.php');
			}
			else
			{	$message = "L'application a rencontré un problème.";
				$typeMessage = 'avertissement';
				$lienRetour = '#page_principale';
				$themeFooter = $themeProbleme;
				include_once ($cheminDesVues . 'VueModifierMaFichePersoEleve.php');
			}
		}
	}
}

