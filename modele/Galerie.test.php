<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Galerie.test.php
// Rôle : test de la classe Galerie
// Création : 15/06/2016 par Killian BOUTIN

// inclusion de la classe Galerie
include_once ('Galerie.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Galerie</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
$unId = 1;
$unePromo = 2005;
$uneClasse = 1;
$unLien = "2005-1";

$uneGalerie = new Galerie($unId, $unePromo, $uneClasse, $unLien);

echo ($uneGalerie->toString());
echo ('<br>');

$uneGalerie->setId(2);
$uneGalerie->setPromo(2007);
$uneGalerie->setClasse(2);
$uneGalerie->setLien("2007-2");
echo ($uneGalerie->toString());
echo ('<br>');
?>

</body>
</html>