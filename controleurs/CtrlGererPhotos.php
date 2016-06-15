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
		include_once ($cheminDesVues . 'VueGererPhotos.php');
	}
	else{
		/* Si on clique sur ajouter */
		if (isset ($_GET['actionGalerie']) AND ($_GET['actionGalerie'] == 'ajouter')){
			
			echo "Ajouter une photo";
			
		}
		else {
			/* Si on clique sur modifier */
			if (isset ($_GET['actionGalerie']) AND ($_GET['actionGalerie'] == 'modifier')){
				
				echo "Modifier la photo comportant l'id " . $_GET['id'];
			}
			else
			{
				/* Si on clique sur supprimer */
				if(isset ($_GET['actionGalerie']) AND ($_GET['actionGalerie'] == 'supprimer'))
				{
					/* On supprime l'image en fonction de l'id de cette image */
					$ok = $dao->supprimerImage($_GET['id']);
					
					if($ok)
					{
						$message = "Modifications effectuées.";
						$typeMessage = 'information';
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
	}
}