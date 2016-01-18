<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlDemanderCreationCompte.php : traiter la demande de création de compte d'un élève
// Ecrit le 12/1/2016 par Nicolas Esteve

// inclusion de la classe Outils
include_once ('modele/Outils.class.php');

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
if ( empty ($_POST ["mail"]) == true)  $mail = "";  else   $mail = $_POST ["mail"];
$lesFonctions = $dao->getLesFonctions();
if( (! isset ($_POST ["listeEleves"]) == true) && ( ! isset ($_POST ["btnEnvoyer"]) == true)){			
		// redirection vers la vue si aucune données n'est recu par le controleur
		$lesMails = $dao->GetLesAdressesMail();
		$idEleve = "";
		$message = "";
		$typeMessage = "";
		$etape = 0;
		$listeMails = $dao->GetLesAdressesMail();
		
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
		include_once ($cheminDesVues . 'VueModifUserAdmin.php');
	}
	elseif( isset ($_POST ["btnDetail"]) == true &&(! isset($_POST['btnEnvoyer']) == true )){
	
		if ( empty ($_POST ["listeEleves"]) == true)  $idEleve = "";  else   $idEleve = $_POST ["listeEleves"];
	
		$etape=1;
		$unEleve = $dao->getEleve($idEleve);
		
		$nom = $unEleve->getNom();
		$prenom = $unEleve->getPrenom();
		$sexe = $unEleve->getSexe();
		$anneeDebutBTS = $unEleve->getAnneeDebutBTS();
		$tel = $unEleve->getTel();
		$mail = $unEleve->getAdrMail();
		$etudesPostBTS = $unEleve->getEtudesPostBTS();
		$rue = $unEleve->getRue();
		$codePostal = $unEleve->getCodePostal();
		$ville = $unEleve->getNom();
		$entreprise = $unEleve->getEntreprise();
		$idFonction = $unEleve->getIdFonction();
		
		
		$liste = $dao->GetLesAdressesMail();
		
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifUserAdmin.php');
	}

	elseif (isset($_POST['btnEnvoyer']) == true )
	{
		if ( $dao->existeAdrMail($mail) ) {
			// si l'adresse existe déjà, réaffichage de la vue
			$message = "Adresse mail déjà existante !";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifUserAdmin.php');
		}
		else 
		{
			
			if ( empty ($_POST ["txtNom"]) == true)  $nom = "";  else   $nom = $_POST ["txtNom"];
			if ( empty ($_POST ["txtPrenom"]) == true)  $prenom = "";  else   $prenom = $_POST ["txtPrenom"];
			if ( empty ($_POST ["txtAnneeDebutBTS"]) == true)  $anneeDebutBTS = "";  else   $anneeDebutBTS = $_POST ["txtAnneeDebutBTS"];
			if ( empty ($_POST ["txtTel"]) == true)  $tel = "";  else   $tel = $_POST ["txtTel"];
			if ( empty ($_POST ["txtAdrMail"]) == true)  $mail = "";  else   $mail = $_POST ["txtAdrMail"];
			if ( empty ($_POST ["txtEtudesPostBTS"]) == true)  $etudes = "";  else   $etudes = $_POST ["txtEtudesPostBTS"];
			if ( empty ($_POST ["txtRue"]) == true)  $rue = "";  else   $rue = $_POST ["txtRue"];
			if ( empty ($_POST ["txtCodePostal"]) == true)  $cp = "";  else   $cp = $_POST ["txtCodePostal"];
			if ( empty ($_POST ["txtVille"]) == true)  $ville = "";  else   $ville = $_POST ["txtVille"];
			if ( empty ($_POST ["txtEntreprise"]) == true)  $entreprise = "";  else   $entreprise = $_POST ["txtEntreprise"];
			if ( empty ($_POST ["listeFonctions"]) == true)  $fonction = "";  else   $fonction = $_POST ["listeFonctions"];
			
			$etape=0;
			$oldMail = ($_POST ["listeEleves"]);
			$ok = $dao->modifierFicheUser($nom, $prenom, $anneeDebutBTS, $mail, $tel, $rue, $ville, $cp, $etudes, $entreprise, $fonction, $oldMail);
			$liste = $dao->GetLesAdressesMail();
			if ( $ok ) {
		
				$message = 'Modification réussie';
				$typeMessage = 'information';
				$themeFooter = $themeNormal;
				//include_once ($cheminDesVues . 'VueSupprUserAdmin.php');
			}
			else
			{
				$message = "La modification a échouée.";
				$typeMessage = 'avertissement';
				$themeFooter = $themeProbleme;
				//include_once ($cheminDesVues . 'VueSupprUserAdmin.php');
			}
		
			unset($DAO);
			include_once ($cheminDesVues . 'VueModifUserAdmin.php');
	}
}
	
		
		
		
		
			