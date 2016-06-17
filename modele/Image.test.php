<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Image.test.php
// Rôle : test de la classe Image
// Création : 15/06/2016 par Killian BOUTIN

// inclusion de la classe Galerie
include_once ('Image.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Image</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
$unId = 1;
$unePromo = 2005;
$uneClasse = 1;
$unLien = "2005-1";

$uneImage = new Image($unId, $unePromo, $uneClasse, $unLien);

echo ($uneGalerie->toString());
echo ('<br>');

$uneImage->setId(2);
$uneImage->setPromo(2007);
$uneImage->setClasse(2);
$uneImage->setLien("2007-2");
echo ($uneImage->toString());
echo ('<br>');
?>

</body>
</html>