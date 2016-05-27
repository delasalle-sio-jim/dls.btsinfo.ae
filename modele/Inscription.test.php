<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Inscription.test.php
// Rôle : test de la classe Inscription
// Création : 2/2/2016 par Nicolas Esteve
// Mise à jour : 27/05/2016 par Killian BOUTIN

// inclusion de la classe Inscription
include_once ('Inscription.class.php');
// inclusion de la classe Outils
include_once ('Outils.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Inscription</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
$unId = 1;
$dateInscription = "2016-05-11";
$nbrePersonnes = 1;
$montantRegle = 20;
$montantRembourse = 0;
$idEleve = 5;
$idSoiree = 1;
$inscriptionAnnulee = FALSE;
$unNom = "boutin";
$unPrenom = "Killian";
$anneeEntreeBTS = "2015";
$unTarif = "20.00€";

$uneInscription = new Inscription($unId, $unNom, $unPrenom, $anneeEntreeBTS, $dateInscription, $nbrePersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee, $unTarif);

echo ($uneInscription->toString());
echo ('<br>');

$uneInscription->setId(2);
$uneInscription->setDateInscription("2016-05-12");
$uneInscription->setNbrePersonnes(2);
$uneInscription->setMontantRegle(40);
$uneInscription->setMontantRembourse(40);
$uneInscription->setIdEleve(6);
$uneInscription->setIdSoiree(1);
$uneInscription->setInscriptionAnnulee(TRUE);
$uneInscription->setNom("cartron");
$uneInscription->setPrenom("Jean-Michel");
$uneInscription->setAnneeDebutBTS("1990");
$uneInscription->setTarif("22.00€");

echo ($uneInscription->toString());
echo ('<br>');
?>

</body>
</html>