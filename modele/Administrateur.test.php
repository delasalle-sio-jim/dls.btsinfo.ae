<?php
// Projet : DLS - BTS Info - Anciens élèves
// fichier : modele/Administrateur.test.php
// Rôle : test de la classe Administrateur
// Création : 7/11/2015 par JM CARTRON
// Mise à jour : 9/5/2016 par JM CARTRON

// inclusion de la classe Administrateur
include_once ('Administrateur.class.php');
// inclusion de la classe Outils
include_once ('Outils.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Administrateur</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
$unId = 1;
$uneAdrMail = "sophie.fonfec@gmail.com";
$unMotDePasse = Outils::creerMdp();
$unPrenom = "sophie";
$unNom = "fonfec";
$unAdministrateur = new Administrateur($unId, $uneAdrMail, $unMotDePasse, $unPrenom, $unNom);

echo ($unAdministrateur->toString());
echo ('<br>');

$unAdministrateur->setId(2);
$unAdministrateur->setAdrMail("anna.lyse.durine@gmail.com");
$unAdministrateur->setMotDePasse(Outils::creerMdp());
$unAdministrateur->setPrenom("anna-lyse");
$unAdministrateur->setNom("durine");

echo ($unAdministrateur->toString());
echo ('<br>');
?>

</body>
</html>