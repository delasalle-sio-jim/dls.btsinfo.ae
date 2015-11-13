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
// Auteur : JM CARTRON
// Dernière mise à jour : 9/11/2015

// inclusion de la classe Eleve
include_once ('Eleve.class.php');
// inclusion de la classe Outils
include_once ('Outils.class.php');

$unId = 1;
$unNom = "fonfec";
$unPrenom = "sophie";
$unSexe = "2";
$uneAnneeDebutBTS = "2005";
$unTel = "1122334455";
$uneAdrMail = "sophie.fonfec@gmail.com";
$uneRue = "1, rue de la mairie";
$unCodePostal = "35000";
$uneVille = "Rennes";
$uneEntreprise = "Orange";
$unCompteAccepte = false;
$unMotDePasse = Outils::creerMdp();
$uneDateDerniereMAJ = "07/11/2015";
$unIdFonction = 1;
$unEleve = new Eleve($unId, $unNom, $unPrenom, $unSexe, $uneAnneeDebutBTS, $unTel, $uneAdrMail, $uneRue, $unCodePostal, 
	$uneVille, $uneEntreprise, $unCompteAccepte, $unMotDePasse, $uneDateDerniereMAJ, $unIdFonction);

echo ($unEleve->toString());
echo ('<br>');

$unEleve->setId(2);
$unEleve->setNom("durine");
$unEleve->setPrenom("anna-lyse");
$unEleve->setSexe("1");
$unEleve->setAnneeDebutBTS("2010");
$unEleve->setTel("0011223344");
$unEleve->setAdrMail("anna.lyse.durine@gmail.com");
$unEleve->setRue("1, rue de l'église");
$unEleve->setCodePostal("35760");
$unEleve->setVille("Saint-Grégoire");
$unEleve->setEntreprise("Citron");
$unEleve->setCompteAccepte(true);
$unEleve->setMotDePasse(Outils::creerMdp());
$unEleve->setDateDerniereMAJ("08/11/2015");
$unEleve->setIdFonction(2);

echo ($unEleve->toString());
echo ('<br>');
?>

</body>
</html>