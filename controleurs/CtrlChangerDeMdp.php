<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlChangerDeMdp.php : traiter la demande de changement de mot de passe
// Ecrit le 1/12/2015 par Jim

// on vérifie si le demandeur de cette action est bien authentifié
if ( $_SESSION['typeUtilisateur'] != 'eleve' && $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else {
	if ( ! isset ($_POST ["txtNouveauMdp"]) && ! isset ($_POST ["txtConfirmationMdp"]) ) {
		// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$nouveauMdp = '';
		$confirmationMdp = '';
		$afficherMdp = 'off';
		$message = 'Changer mon mot de passe';
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueChangerDeMdp.php');
	}
	else {
		// récupération des données postées
		if ( empty ($_POST ["txtNouveauMdp"]) == true)  $nouveauMdp = "";  else   $nouveauMdp = $_POST ["txtNouveauMdp"];
		if ( empty ($_POST ["txtConfirmationMdp"]) == true)  $confirmationMdp = "";  else   $confirmationMdp = $_POST ["txtConfirmationMdp"];
		if ( empty ($_POST ["caseAfficherMdp"]) == true)  $afficherMdp = 'off';  else   $afficherMdp = $_POST ["caseAfficherMdp"];
				
		if ( $nouveauMdp == "" || $confirmationMdp == "" ) {
			// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
			$message = 'Données incomplètes !';
			$themeFooter = $themeProbleme;
			include_once ($cheminDesVues . 'VueChangerDeMdp.php');
		}
		else {
			if ( $nouveauMdp != $confirmationMdp ) {
				// si les données sont incorrectes, réaffichage de la vue avec un message explicatif
				$message = 'Le nouveau mot de passe et<br>sa confirmation sont différents !';
				$themeFooter = $themeProbleme;
				include_once ($cheminDesVues . 'VueChangerDeMdp.php');
			}
			else {
				// connexion du serveur web à la base MySQL
				include_once ('modele/DAO.class.php');
				$dao = new DAO();

				// enregistre le nouveau mot de passe de l'utilisateur dans la bdd après l'avoir hashé en SHA1
				$dao->modifierMdp ($adrMail, $nouveauMdp);
							
				// envoi d'un mail à l'utilisateur avec son nouveau mot de passe 
				$ok = $dao->envoyerMdp ($adrMail, $nouveauMdp);
							
				if ( $ok ) {
					$message = "Enregistrement effectué.<br>Vous allez recevoir un mail de confirmation.";
					$themeFooter = $themeNormal;
				}
				else {
					$message = "Enregistrement effectué.<br>L'envoi du mail de confirmation a rencontré un problème.";
					$themeFooter = $themeProbleme;
				}
				unset($dao);		// fermeture de la connexion à MySQL
				include_once ($cheminDesVues . 'VueChangerDeMdp.php');
			}
		}
	}
}