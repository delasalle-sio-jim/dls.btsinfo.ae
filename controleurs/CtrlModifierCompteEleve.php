<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierCompteEleve.php : traiter la modification d'un compte élève par un administrateur
// Ecrit le 12/1/2016 par Nicolas Esteve
// Modifié le 26/05/2016 par Killian BOUTIN

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

/* Premier passage sur la page */
if( (! isset ($_POST ["listeEleves"]) == true) && ( ! isset ($_POST ["btnEnvoyer"]) == true)){			
		// redirection vers la vue si aucune données n'est recu par le controleur
		$lesMails = $dao->getLesAdressesMails();
		$idEleve = "";
		$message = "";
		$typeMessage = "";
		$lienRetour = '#page_principale';
		$etape = 0;
		
		//mise a zéro des variables de modifications de l'eleve
		$nom = '';
		$prenom = '';
		$sexe = '';
		$anneeDebutBTS = '';
		$tel = '';
		$mail = '';
		$etudesPostBTS = '';
		$rue = '';
		$codePostal = '';
		$ville = '';
		$entreprise = '';
		$idFonction = '';
		

		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
}

/* Si on appuie sur le bouton "Obtenir des détails" */
elseif( isset ($_POST ["btnDetail"]) == true &&(! isset($_POST['btnEnvoyer']) == true )){

	/* On vérifie que l'adresse est bonne */
	if ($dao->existeAdrMail($_POST ["listeEleves"]) == false){
		
		$etape = 0;
		$message = "Veuillez rentrer une adresse mail existante.";
		$typeMessage = 'avertissement';
		$lienRetour = '#page_principale';
		
		$themeFooter = $themeProbleme;
		include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
	}
	/* Si elle est bonne, on affiche les nouvelles données correspondante à l'élève en question */
	else{

		$etape=1;
		$unEleve = $dao->getEleve($_POST ["listeEleves"]);
		$lesFonctions = $dao->getLesFonctions();
		
		$nom = $unEleve->getNom();
		$prenom = $unEleve->getPrenom();
		$sexe = $unEleve->getSexe();
		$anneeDebutBTS = $unEleve->getAnneeDebutBTS();
		$tel = $unEleve->getTel();
		$mail = $unEleve->getAdrMail();
		$etudesPostBTS = $unEleve->getEtudesPostBTS();
		$rue = $unEleve->getRue();
		$codePostal = $unEleve->getCodePostal();
		$ville = $unEleve->getVille();
		$entreprise = $unEleve->getEntreprise();
		$idFonction = $unEleve->getIdFonction();
		
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
	}
}

elseif (isset($_POST['btnEnvoyer']) == true )
{
	$unEleve = $dao->getEleve($_POST ["listeEleves"]);
	$etape=0;
	// récupération des données du formulaire + assemblage avec les données qui ne changerons pas
	$unId = $unEleve->getId();
	if ( empty ($_POST ["txtNom"]) == true)  $unNom = $unEleve->getNom();  else   $unNom = $_POST ["txtNom"];
	if ( empty ($_POST ["txtPrenom"]) == true)  $unPrenom = $unEleve->getPrenom();  else   $unPrenom = $_POST ["txtPrenom"];
	$unSexe = $unEleve->getSexe();
	if ( empty ($_POST ["txtAnneeDebutBTS"]) == true)  $uneAnneeDebutBTS = $unEleve->getAnneeDebutBTS();  else   $uneAnneeDebutBTS = $_POST ["txtAnneeDebutBTS"];
	if ( empty ($_POST ["txtTel"]) == true)  $unTel = "";  else   $unTel = $_POST ["txtTel"];
	$uneAdrMail = $_POST ["listeEleves"];
	if ( empty ($_POST ["txtRue"]) == true)  $uneRue = "";  else   $uneRue = $_POST ["txtRue"];
	if ( empty ($_POST ["txtCodePostal"]) == true)  $unCodePostal = "";  else   $unCodePostal = $_POST ["txtCodePostal"];
	if ( empty ($_POST ["txtVille"]) == true)  $uneVille = "";  else   $uneVille = $_POST ["txtVille"];
	if ( empty ($_POST ["txtEntreprise"]) == true)  $uneEntreprise = "";  else   $uneEntreprise = $_POST ["txtEntreprise"];
	$unCompteAccepte = $unEleve->getCompteAccepte();
	$unMotDePasse = $unEleve->getMotDePasse();
	if ( empty ($_POST ["txtEtudesPostBTS"]) == true)  $desEtudesPostBTS = "";  else   $desEtudesPostBTS = $_POST ["txtEtudesPostBTS"];
	$uneDateDerniereMAJ = time();
	if ( $_POST ["listeFonctions"] == 0)  $unIdFonction = $unEleve->getIdFonction();  else   $unIdFonction = $_POST ["listeFonctions"];	
	
	$unEleve = new Eleve($unId, $unNom, $unPrenom, $unSexe, $uneAnneeDebutBTS, $unTel, $uneAdrMail, $uneRue, $unCodePostal, $uneVille, $uneEntreprise, $unCompteAccepte, $unMotDePasse, $desEtudesPostBTS, $uneDateDerniereMAJ, $unIdFonction);
	
	$ok = $dao->modifierCompteEleve($unEleve);
	if ($ok) {

		$message = 'Modification réussie.';
		$typeMessage = 'information';
		$lienRetour = 'index.php?action=Menu#menu4';
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
		
	}
	else
	{
		$message = "La modification a échouée.";
		$typeMessage = 'avertissement';
		$lienRetour = '#page_principale';
		$themeFooter = $themeProbleme;
		include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
	}

	unset($DAO);
}