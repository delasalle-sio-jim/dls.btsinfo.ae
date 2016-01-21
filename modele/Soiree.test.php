<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Soiree</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Eleve.test.php
// Rôle : test de la classe Eleve
// Auteur : JM CARTRON
// Dernière mise à jour : 9/11/2015

// inclusion de la classe Eleve
include_once ('Soiree.class.php');
// inclusion de la classe Outils
include_once ('Outils.class.php');

$unId = 1;	
$unNomRestaurant = "Le nom du resto";				
$uneDate = "21/01/2016";				
$uneAdresse = "132 rue du resto";				
$unTarif = "20";		
$unLienMenu = "http://www.soburrito.com/menu.php";					
$uneLatitude = "48.158803" ;			
$uneLongitude = "-1.686373";			
$uneSoiree= new Soiree($unId, $unNomRestaurant, $uneDate, $uneAdresse, $unTarif, $unLienMenu, $uneLatitude, $uneLongitude);

echo ($uneSoiree->toString());
echo ('<br>');

$uneSoiree->setId(2);
$uneSoiree->setNomRestaurant("Le nom du 2nd resto");
$uneSoiree->setDate("01/01/2016");
$uneSoiree->setAdresse("132 rue du 2nd resto");
$uneSoiree->setTarif("27");
$uneSoiree->setLienMenu("http://www.soburrito.com/menu2.php");
$uneSoiree->setLatitude("-1.686373");
$uneSoiree->setLongitude("48.158803");


echo ($uneSoiree->toString());
echo ('<br>');
?>

</body>
</html>