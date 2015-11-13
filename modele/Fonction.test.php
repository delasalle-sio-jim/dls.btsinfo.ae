<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Fonction</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Fonction.test.php
// Rôle : test de la classe Fonction
// Auteur : JM CARTRON
// Dernière mise à jour : 5/11/2015

// inclusion de la classe Fonction
include_once ('Fonction.class.php');

$unId = 1;
$unLibelle = "Chef de projet";
$uneFonction = new Fonction($unId, $unLibelle);

echo ('$id : ' . $uneFonction->getId() . '<br>');
echo ('$libelle : ' . $uneFonction->getLibelle() . '<br>');
echo ('<br>');

echo ($uneFonction->toString());
echo ('<br>');

$unId = 2;
$unLibelle = "Développeur d'applications";
$uneFonction = new Fonction($unId, $unLibelle);

echo ('$id : ' . $uneFonction->getId() . '<br>');
echo ('$libelle : ' . $uneFonction->getLibelle() . '<br>');
echo ('<br>');

echo ($uneFonction->toString());
echo ('<br>');
?>

</body>
</html>