<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Soiree.test.php
// Rôle : test de la classe Soiree
// Création : 20/1/2016 par Nicolas Esteve
// Mise à jour : 9/5/2016 par JM CARTRON

// inclusion de la classe Soiree
include_once ('Soiree.class.php');
// inclusion de la classe Outils
include_once ('Outils.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Soiree</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
$unId = 1;	
$unNomRestaurant = "Le nom du premier resto";				
$uneDateSoiree = "4/11/2016";				
$uneAdresse = "132 rue du premier resto";				
$unTarif = "20";		
$unLienMenu = "http://www.soburrito.com/menu.php";					
$uneLatitude = "48.158803" ;			
$uneLongitude = "-1.686373";			
$uneSoiree= new Soiree($unId, $unNomRestaurant, $uneDateSoiree, $uneAdresse, $unTarif, $unLienMenu, $uneLatitude, $uneLongitude);

echo ($uneSoiree->toString());
echo ('<br>');

$uneSoiree->setId(2);
$uneSoiree->setNomRestaurant("Le nom du second resto");
$uneSoiree->setDateSoiree("4/11/2016");
$uneSoiree->setAdresse("132 rue du second resto");
$uneSoiree->setTarif("27");
$uneSoiree->setLienMenu("http://www.soburrito.com/menu2.php");
$uneSoiree->setLatitude("-1.686373");
$uneSoiree->setLongitude("48.158803");


echo ($uneSoiree->toString());
echo ('<br>');
?>

</body>
</html>