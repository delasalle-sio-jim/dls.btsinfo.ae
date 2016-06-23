<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlAjouterModifierPhoto.php : traiter la demande d'ajout ou de modification des photos de la galerie
// Ecrit le 16/06/2016 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
include_once ('modele/Outils.class.php');


$dao = new DAO();
$lesImages = $dao->getLesImages();

$action = $_GET['actionGalerie'];

/* On recrée l'url en fonction de si c'est ajouter ou modifier */
if ($action=='modifier') $url = $_GET['actionGalerie'] . "&id=" . $_GET['id'];
else $url = $_GET['actionGalerie'];

if ( $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}

else{
	/* On arrive sur cette page par l'intermédiaire de la vue VueGererPhotos
	l'action "actionGalerie" aura donc une valeur : "ajouter" ou "modifier" */
	
	/* Si on a cliqué sur ajouter */
	if ($action == 'ajouter'){ /* DEBUT DE L'ACTION AJOUTER */
	
		$leTitre = "Ajout d'une nouvelle photo de classe";
		$leSousTitre = "Ajouter une";
		if (empty ($_POST['txtPromo'])) $unePromo = ""; else $unePromo = $_POST['txtPromo'];
		if (empty ($_POST['txtClasse'])) $uneClasse = ""; else $uneClasse = $_POST['txtClasse'];
	}
	/* Si on a cliqué sur modifier */
	else {
		/* Si on a cliqué sur modifier */
		if ($action == 'modifier'){
	
			/* On recupère les données de la photo grâce à son identifiant */
			$uneImage = $dao->getImage($_GET['id']);
	
			/* On met dans des variables le titre, sous titre, la promo et la classe en fonction de l'action et de l'id */
			$leTitre = "Modification de la photo de classe n°" . $_GET['id'];
			$leSousTitre = "Modifier la";
			$unePromo = $uneImage->getPromo();
			$uneClasse = $uneImage->getClasse();
		}
	}
	
	/* Si on n'a pas encore cliqué sur le bouton d'envoi */
	if ( ! isset ($_POST['btnEnvoi'])){
		
		$message = '';
		$typeMessage = '';			// 2 valeurs possibles : 'information' ou 'avertissement'
		$lienRetour = 'index.php?action=GererPhotos';
		$themeFooter = $themeNormal;
		include_once ($cheminDesVues . 'VueAjouterModifierPhoto.php');
	}
	
	/* Si on a cliqué sur le bouton d'envoi */
	else{
		
		/* Si on a choisi une nouvelle photo de classe */
		if (($_FILES['filePhoto']["name"]) != ""){
			
			/* On prend les extensions que l'on accepte soit jpeg et jpg */
			$listeExtensions = array('.JPG', '.JPEG', '.PNG');
			
			/* On prend l'extension du fichier téléchargé */
			$extension = strrchr($_FILES['filePhoto']['name'], '.');
			
			/* On regarde si l'extension du fichié téléchargé est correcte, sinon on affiche un message d'avertissement */
			if (!in_array(strtoupper($extension), $listeExtensions)){
				$message ="Veuillez choisir une image de type .png, .jpg ou .jpeg.";
				$typeMessage = 'avertissement';
				$lienRetour = '#page_principale';
				$themeFooter = $themeProbleme;
				include_once ($cheminDesVues . 'VueAjouterModifierPhoto.php');
			}
			
			/* Si l'extension est bonne, on continue le traitement */
			else{
				
				/* Initialisation des variables d'upload de la photo de classe */
				$leDossierInitial = 'photos.initiales/'; // Le dossier d'enregistrement pour photos originales
				$leDossier700 = 'photos.700/';			 // Le dossier d'enregistrement pour version HTML5
				$leDossier300 = 'photos.300/';			 // Le dossier d'enregistrement pour version jQuery Mobile
				$unLien = $_FILES['filePhoto']['name'];  // Le fichier récupéré
				
				/* Deplacement de la photo téléchargé dans le dossier => photos.initiales/ */
				move_uploaded_file($_FILES['filePhoto']['tmp_name'], $leDossierInitial . $unLien);
				
				/* On supprime le fichier qui a le même nom s'il existe dans les dossiers */
				if ((file_exists($leDossier700 . $unLien)) AND $unLien != 'nophoto.jpg'){
					unlink($leDossier700 . $unLien);
				}				
				Outils::redimensionnerImage($unLien, $leDossierInitial, $leDossier700, 700);
				
				if ((file_exists($leDossier300 . $unLien)) AND $leDossier700 . $unLien != 'nophoto.jpg'){
					unlink($leDossier300 . $unLien);
				}
				Outils::redimensionnerImage($unLien, $leDossierInitial, $leDossier300, 300);
								
				/* Si l'action était d'ajouter une photo, on effectue l'ajout grâce à la fonction */
				if ($action == 'ajouter'){
					
					$unId = 0;  /* Il ne sera pas ajouté puisque c'est un auto incremente qui donnera son id */
					$unePromo = $_POST['txtPromo'];
					$uneClasse = $_POST['txtClasse'];
					
					$uneImage = new Image ($unId, $unePromo, $uneClasse, $unLien);
					
					$ok = $dao->ajouterImage($uneImage);
					
					if ($ok){
						$message = 'L\'ajout s\'est correctement effectué.';
						$typeMessage = 'information';			// 2 valeurs possibles : 'information' ou 'avertissement'
						$lienRetour = 'index.php?action=GererPhotos';
						$themeFooter = $themeNormal;
						include_once ($cheminDesVues . 'VueAjouterModifierPhoto.php');
					}
					else{
						$message ="L\'ajout est un échec !";
						$typeMessage = 'avertissement';
						$lienRetour = '#page_principale';
						$themeFooter = $themeProbleme;
						include_once ($cheminDesVues . 'VueAjouterModifierPhoto.php');
					}
				}
				/* Si l'action était de modifier une photo, on effectue la modification grâce à la fonction */
				else{
					
					$unId = $_GET['id'];  /* Il ne sera pas ajouté puisque c'est un auto incremente qui donnera son id */
					$unePromo = $_POST['txtPromo'];
					$uneClasse = $_POST['txtClasse'];
					
					$uneImage = new Image ($unId, $unePromo, $uneClasse, $unLien);
					
					$ok = $dao->modifierImage($uneImage);
						
					if ($ok){
						$message = 'La modification s\'est correctement effectuée.';
						$typeMessage = 'information';			// 2 valeurs possibles : 'information' ou 'avertissement'
						$lienRetour = 'index.php?action=GererPhotos';
						$themeFooter = $themeNormal;
						include_once ($cheminDesVues . 'VueAjouterModifierPhoto.php');
					}
					
					else{
						$message = 'La modification est un échec !';
						$typeMessage = 'avertissement';
						$lienRetour = '#page_principale';
						$themeFooter = $themeProbleme;
						include_once ($cheminDesVues . 'VueAjouterModifierPhoto.php');
					}
				}
			}
		}
		/* Si il n'a pas choisi de photo */
		else {
			
			$unId = $_GET['id'];  /* Il ne sera pas ajouté puisque c'est un auto incremente qui donnera son id */
			$unePromo = $_POST['txtPromo'];
			$uneClasse = $_POST['txtClasse'];
			$unLien = $uneImage->getLien();
				
			$uneImage = new Image ($unId, $unePromo, $uneClasse, $unLien);
				
			$ok = $dao->modifierImage($uneImage);
			
			if ($ok){
				$message = 'La modification s\'est correctement effectuée.';
				$typeMessage = 'information';			// 2 valeurs possibles : 'information' ou 'avertissement'
				$lienRetour = 'index.php?action=GererPhotos';
				$themeFooter = $themeNormal;
				include_once ($cheminDesVues . 'VueAjouterModifierPhoto.php');
			}
				
			else{
				$message = 'La modification est un échec !';
				$typeMessage = 'avertissement';
				$lienRetour = '#page_principale';
				$themeFooter = $themeProbleme;
				include_once ($cheminDesVues . 'VueAjouterModifierPhoto.php');
			}
		}
	}	
}