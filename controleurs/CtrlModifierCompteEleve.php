<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlModifierCompteEleve.php : traiter la modification d'un compte élève par un administrateur
// Ecrit le 12/1/2016 par Nicolas Esteve
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
if ( empty ($_POST ["mail"]) == true)  $mail = "";  else   $mail = $_POST ["mail"];// utilité à verifier+++++++++++++++++++++++++++++++++++++++++++++++++++++
//obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
//$lesFonctions = $dao->getLesFonctions(); utilité à verifier++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
		include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
	}
	elseif( isset ($_POST ["btnDetail"]) == true &&(! isset($_POST['btnEnvoyer']) == true )){
	
		if ( empty ($_POST ["listeEleves"]) == true)  $idEleve = "";  else   $idEleve = $_POST ["listeEleves"];
	
		$etape=1;
		$unEleve = $dao->getEleve($idEleve);
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
		
		
		$liste = $dao->GetLesAdressesMail();
		
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
	}

	elseif (isset($_POST['btnEnvoyer']) == true )
	{
		if ( $dao->existeAdrMail($mail) ) {
			// si l'adresse existe déjà, réaffichage de la vue
			$message = "Adresse mail déjà existante !";
			$typeMessage = 'avertissement';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
		}
		else 
		{
			// récupération des données du formulaire
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
		
				$message = 'Modification réussie.';
				$typeMessage = 'information';
				$themeFooter = $themeNormal;
				
			}
			else
			{
				$message = "La modification a échouée.";
				$typeMessage = 'avertissement';
				$themeFooter = $themeProbleme;
				
			}
		
			unset($DAO);
			include_once ($cheminDesVues . 'VueModifierCompteEleve.php');
	}
}
	
		
		
		
		
			