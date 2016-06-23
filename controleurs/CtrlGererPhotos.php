<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlGererPhotos.php : permet de gérer la galerie photo
// Ecrit le 15/06/2016 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');


$dao = new DAO();
$lesImages = $dao->getLesImages();

if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}

else{
	
	/* Si on arrive sur la page sans rien cliquer */
	if (!isset($_GET['actionGalerie'])) {
		
		$message = '';
		$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
		$lienRetour = '#page_principale';
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueGererPhotos.php');
	}
	
	else{
		/* Si on clique sur supprimer */
		if(isset ($_GET['actionGalerie']) AND ($_GET['actionGalerie'] == 'supprimer'))
		{
			$uneImage = $dao->getImage($_GET['id']);
			$unLien = $uneImage->getLien();
			
			/* On supprime l'image en fonction de l'id de cette image dans les dossiers */
			// if ($unLien != 'nophoto.jpg') unlink("photos.initiales/" . $unLien ); /* SEULEMENT SUR OVH */
			if ($unLien != 'nophoto.jpg') unlink("photos.300/" . $unLien );
			if ($unLien != 'nophoto.jpg') unlink("photos.700/" . $unLien );
			
			/* On supprime l'image en fonction de l'id de cette image dans la BDD */
			$ok = $dao->supprimerImage($_GET['id']);
			
			if($ok)
			{
				$message = "Modifications effectuées.";
				$typeMessage = 'information';
				/* Pour cette page, on renvoie sur GererPhotos pour réafficher toutes les photos */
				$lienRetour = 'index.php?action=GererPhotos';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueGererPhotos.php');
			}
			else
			{
				$message = "L\'application a rencontré un problème.";
				$typeMessage = 'avertissement';
				$lienRetour = '#page_principale';
				$themeFooter = $themeProbleme;
				include_once ($cheminDesVues . 'VueGererPhotos.php');
			}
		}
	}
}