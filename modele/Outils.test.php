<?php
// Projet DLS - BTS Info - Anciens élèves
// Test de la classe Outils
// fichier : modele/Outils.test.php
// Créé par Jim le 18/6/2016

// ATTENTION : la position des tests dans ce fichier est identique à la position des méthodes testées dans la classe Outils

include_once ('Outils.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Outils</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// test de la méthode redimensionnerImage($nomFichierImage, $nomDossierSource, $nomDossierDestination, $tailleMax) -------------
// créé par Jim le 17/06/2016
echo "<h3>Test de redimensionnerImage(nomFichierImage, nomDossierSource, nomDossierDestination, tailleMax) : </h3>";

?>
<form enctype="multipart/form-data" action="Outils.test.php" method="post">
	<input type="file" name="filePhoto" id="filePhoto" required><br>
	<input type="submit" value="Envoyer les données" name="btnEnvoi" id="btnEnvoi" />		
</form>

<?php
if ( ! empty ($_FILES['filePhoto'])) {
	var_dump ($_FILES['filePhoto']);
	
	echo "<br>";
	echo $_FILES['filePhoto']['name'] . "<br>";
	echo $_FILES['filePhoto']['type'] . "<br>";
	echo $_FILES['filePhoto']['tmp_name'] . "<br>";
	echo $_FILES['filePhoto']['error'] . "<br>";
	echo $_FILES['filePhoto']['size'] . "<br>";
	echo "<br>";
		
	// Initialisation des variables d'upload de la photo
	$nomFichierTemporaire = $_FILES['filePhoto']['tmp_name'];
	$nomDossierSource = '../photos.initiales/'; 			// Le dossier d'enregistrement de la photo avant réduction de taille
	$nomDossierDestination = '../images.galerie/'; 			// Le dossier d'enregistrement de la photo après réduction de taille
	$nomFichier = $_FILES['filePhoto']['name']; 			// Le fichier à télécharger
	$nomCompletFichierSource = $nomDossierSource . $nomFichier;
	$nomCompletFichierDestination = $nomDossierDestination . $nomFichier;

	echo $nomFichierTemporaire . "<br>";
	echo $nomDossierSource . "<br>";
	echo $nomDossierDestination . "<br>";
	echo $nomFichier . "<br>";
	echo $nomCompletFichierSource . "<br>";
	echo $nomCompletFichierDestination . "<br>";
	
	// Déplacement de la photo téléchargée dans le dossier => photos.initiales/
	move_uploaded_file($nomFichierTemporaire, $nomCompletFichierSource);
	
	$extensionFichier = strtoupper(strrchr($nomFichierTemporaire, '.'));
	echo "<br>L'extension de l'image avant de la déplacer est " . $extensionFichier . ".<br>";
	
	$extensionFichier = strtoupper(strrchr($nomCompletFichierSource, '.'));
	echo "L'extension de l'image après l'avoir déplacée est " .  $extensionFichier . ".<br>";
	
	// Récupération de la taille de l'image avant le redimensionnement
	$imageSource = Outils::getImageByNomFichier($nomCompletFichierSource);
	$largeur = Outils::getLargeurImage($imageSource);
	$hauteur = Outils::getHauteurImage($imageSource);
	echo "La largeur était " . $largeur . " et la hauteur était " . $hauteur . ".<br>";
	
	// On crée une copie réduite et on la place dans images.galerie pour ne pas effacer les autres photos
	$ok = Outils::redimensionnerImage($nomFichier, $nomDossierSource, $nomDossierDestination, 500);
	
	if ($ok) {
		// Récupération de la taille de l'image après le redimensionnement
		$imageDestination = Outils::getImageByNomFichier($nomCompletFichierDestination);
		$largeur = Outils::getLargeurImage($imageDestination);
		$hauteur = Outils::getHauteurImage($imageDestination);
		echo "La largeur est maintenant " . $largeur . " et la hauteur est maintenant " . $hauteur . ".<br>";
	}
	else{
		echo "<b>Le redimensionnement a échoué.</b>";
	}
}

?>

</body>
</html>