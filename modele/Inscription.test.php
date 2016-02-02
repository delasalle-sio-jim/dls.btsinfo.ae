<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Test de la classe Eleve</title>
<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Eleve.test.php
// Rôle : test de la classe Eleve
// Auteur : Nicolas Esteve
// Dernière mise à jour : 02/02/2016

// inclusion de la classe Eleve
include_once ('Inscription.class.php');
// inclusion de la classe Outils
include_once ('Outils.class.php');

$unId = "4";
$dateInscription="1996-01-27";
$nbrePersonne="2";
$montantRegle="10";
$montantRembourse="30";
$idEleve="5";
$idSoiree="2";
$annule="1";

$uneInscription = new Inscription($unId, $dateInscription, $nbrePersonne, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $annule);

echo ($uneInscription->toString());
echo ('<br>');

$uneInscription->setId(2);
$uneInscription->setdateInscription("2016-01-27");
$uneInscription->setnbrePersonne("2");
$uneInscription->setmontantRegle("20");
$uneInscription->setmontantRembourse("40");
$uneInscription->setidEleve("5");
$uneInscription->setidSoiree("2");
$uneInscription->setannule("1");

echo ($uneInscription->toString());
echo ('<br>');
?>

</body>
</html>