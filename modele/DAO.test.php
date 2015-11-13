<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe DAO</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// Projet DLS - BTS Info - Anciens élèves
// Test de la classe DAO
// Auteur : JM CARTRON
// Dernière mise à jour : 10/11/2015

include_once ('Fonction.class.php');
include_once ('Eleve.class.php');
include_once ('Administrateur.class.php');
include_once ('Outils.class.php');

// connexion du serveur web à la base MySQL
include_once ('DAO.class.php');
$dao = new DAO();

// test de la méthode getLesFonctions -------------------------------------------------------------
// modifié par Jim le 10/11/2015
echo "<h3>Test de getLesFonctions : </h3>";
$lesFonctions = $dao->getLesFonctions();
$nbReponses = sizeof($lesFonctions);
echo "<p>Nombre de fonctions : " . $nbReponses . "</p>";
// affichage des fonctions
foreach ($lesFonctions as $uneFonction)
{	echo ($uneFonction->toString());
	echo ('<br>');
}

// test de la méthode getTypeUtilisateur ----------------------------------------------------------
// modifié par Jim le 12/11/2015
echo "<h3>Test de getTypeUtilisateur : </h3>";
$typeUtilisateur = $dao->getTypeUtilisateur('jean.michel.cartron@gmail.com', 'admin');
echo "<p>TypeUtilisateur de ('jean.michel.cartron@gmail.com', 'admin') : <b>" . $typeUtilisateur . "</b><br>";
$typeUtilisateur = $dao->getTypeUtilisateur('jean.michel.cartron@gmail.com', 'adminnnnn');
echo "TypeUtilisateur de ('jean.michel.cartron@gmail.com', 'adminnnnn') : <b>" . $typeUtilisateur . "</b><br>";
$typeUtilisateur = $dao->getTypeUtilisateur('jean.michel.cartron@gmail.com', 'passe');
echo "TypeUtilisateur de ('jean.michel.cartron@gmail.com', 'passe') : <b>" . $typeUtilisateur;

// test de la méthode existeAdrMail -----------------------------------------------------------
// modifié par Jim le 12/11/2015
echo "<h3>Test de existeAdrMail : </h3>";
if ($dao->existeAdrMail("sophie.fonfec@gmail.com")) $existe = "oui"; else $existe = "non";
echo "<p>Existence de l'adresse 'sophie.fonfec@gmail.com' : <b>" . $existe . "</b><br>";
if ($dao->existeAdrMail("anna.lyse.durine@gmail.com")) $existe = "oui"; else $existe = "non";
echo "Existence de l'adresse 'anna.lyse.durine@gmail.com' : <b>" . $existe . "</b></p>";

// test de la méthode creerCompteEleve ------------------------------------------------------------
// modifié par Jim le 12/11/2015
echo "<h3>Test de creerCompteEleve : </h3>";
$unId = 0;
$unNom = "fonfec";
$unPrenom = "sophie";
$unSexe = "F";
$uneAnneeDebutBTS = "2005";
$unTel = "1122334455";
$uneAdrMail = "sophie.fonfec@gmail.com";
$uneRue = "1, rue de la mairie";
$unCodePostal = "35000";
$uneVille = "Rennes";
$uneEntreprise = "Orange";
$unCompteAccepte = false;
$unMotDePasse = "passe";
$uneDateDerniereMAJ = date('Y-m-d H:i:s', time());		// l'heure courante
$unIdFonction = 1;

$unEleve = new Eleve($unId, $unNom, $unPrenom, $unSexe, $uneAnneeDebutBTS, $unTel, $uneAdrMail, $uneRue, 
	$unCodePostal, $uneVille, $uneEntreprise, $unCompteAccepte, $unMotDePasse, $uneDateDerniereMAJ, $unIdFonction);

$ok = $dao->creerCompteEleve($unEleve);
if ($ok)
	echo "<p>Elève bien enregistré !</p>";
else
	echo "<p>Echec lors de l'enregistrement de l'élève !</p>";





/*
// test de la méthode genererUnDigicode -----------------------------------------------------------
// modifié par Jim le 24/9/2015
echo "<h3>Test de genererUnDigicode : </h3>";
echo "<p>Un digicode aléatoire : <b>" . $dao->genererUnDigicode() . "</b><br>";
echo "Un digicode aléatoire : <b>" . $dao->genererUnDigicode() . "</b><br>";
echo "Un digicode aléatoire : <b>" . $dao->genererUnDigicode() . "</b><p>";


// test de la méthode creerLesDigicodesManquants --------------------------------------------------
// modifié par Jim le 24/9/2015
echo "<h3>Test de creerLesDigicodesManquants : </h3>";
$dao->creerLesDigicodesManquants();
echo "<p>Pour ce test, videz auparavant la table <b>mrbs_entry_digicode</b><br>";
echo " puis vérifiez que la table est reconstruite après exécution du test.</p>";


// test de la méthode listeReservations -----------------------------------------------------------
// modifié par Jim le 30/9/2015
echo "<h3>Test de listeReservations : </h3>";
$lesReservations = $dao->listeReservations("jim");
$nbReponses = sizeof($lesReservations);
echo "<p>Nombre de réservations de 'jim' : " . $nbReponses . "</p>";
// affichage des réservations
foreach ($lesReservations as $uneReservation)
{	echo ($uneReservation->toString());
	echo ('<br>');
}
$lesReservations = $dao->listeReservations("zenelsy");
$nbReponses = sizeof($lesReservations);
echo "<p>Nombre de réservations de 'zenelsy' : " . $nbReponses . "</p>";
// affichage des réservations
foreach ($lesReservations as $uneReservation)
{	echo ($uneReservation->toString());
	echo ('<br>');
}


// // test de la méthode existeReservation -----------------------------------------------------------
// // modifié par Jim le 25/9/2015
// echo "<h3>Test de existeReservation : </h3>";
// if ($dao->existeReservation("11")) $existe = "oui"; else $existe = "non";
// echo "<p>Existence de la réservation 11 : <b>" . $existe . "</b><br>";
// if ($dao->existeReservation("12")) $existe = "oui"; else $existe = "non";
// echo "Existence de la réservation 12 : <b>" . $existe . "</b></p>";


// // test de la méthode estLeCreateur ---------------------------------------------------------------
// // modifié par Jim le 25/9/2015
// echo "<h3>Test de estLeCreateur : </h3>";
// if ($dao->estLeCreateur("admin", "11")) $estLeCreateur = "oui"; else $estLeCreateur = "non";
// echo "<p>'admin' a créé la réservation 11 : <b>" . $estLeCreateur . "</b><br>";
// if ($dao->estLeCreateur("zenelsy", "11")) $estLeCreateur = "oui"; else $estLeCreateur = "non";
// echo "'zenelsy' a créé la réservation 11 : <b>" . $estLeCreateur . "</b></p>";


// // test de la méthode getReservation --------------------------------------------------------------
// // modifié par Jim le 25/9/2015
// echo "<h3>Test de getReservation : </h3>";
// $laReservation = $dao->getReservation("11");
// if ($laReservation) 
// 	echo "<p>La réservation 11 existe : <br>" . $laReservation->toString() . "</p>";
// else
// 	echo "<p>La réservation 11 n'existe pas !</p>";	
// $laReservation = $dao->getReservation("12");
// if ($laReservation) 
// 	echo "<p>La réservation 12 existe : <br>" . $laReservation->toString() . "</p>";
// else
// 	echo "<p>La réservation 12 n'existe pas !</p>";	


// // test de la méthode getUtilisateur --------------------------------------------------------------
// // modifié par Jim le 30/9/2015
// echo "<h3>Test de getUtilisateur : </h3>";
// $unUtilisateur = $dao->getUtilisateur("admin");
// if ($unUtilisateur)
// 	echo "<p>L'utilisateur admin existe : <br>" . $unUtilisateur->toString() . "</p>";
// else
// 	echo "<p>L'utilisateur admin n'existe pas !</p>";
// $unUtilisateur = $dao->getUtilisateur("admon");
// if ($unUtilisateur)
// 	echo "<p>L'utilisateur admon existe : <br>" . u$unUtilisateur->toString() . "</p>";
// else
// 	echo "<p>L'utilisateur admon n'existe pas !</p>";


// // test de la méthode confirmerReservation --------------------------------------------------------
// // pour ce test, utiliser une réservation dont le champ status est mis auparavant à 4 (état provisoire)
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de confirmerReservation : </h3>";
// $laReservation = $dao->getReservation("10");
// if ($laReservation) {
// 	echo "<p>Etat de la réservation 10 avant confirmation : <b>" . $laReservation->getStatus() . "</b><br>";
// 	$dao->confirmerReservation("10");
// 	$laReservation = $dao->getReservation("10");
// 	echo "Etat de la réservation 10 après confirmation : <b>" . $laReservation->getStatus() . "</b></p>";
// }
// else
// 	echo "<p>La réservation 10 n'existe pas !</p>";	


// // test de la méthode annulerReservation --------------------------------------------------------
// // pour ce test, utiliser une réservation existante
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de annulerReservation : </h3>";
// $laReservation = $dao->getReservation("10");
// if ($laReservation) {
// 	$dao->annulerReservation("10");
// 	$laReservation = $dao->getReservation("10");
// 	if ($laReservation)
// 		echo "La réservation 10 n'a pas été supprimée !</p>";
// 	else
// 		echo "La réservation 10 a bien été supprimée !</p>";
// }
// else
// 	echo "<p>La réservation 10 n'existe pas !</p>";





// // test de la méthode modifierMdpUser -------------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de modifierMdpUser : </h3>";
// $unUtilisateur = $dao->getUtilisateur("admin");
// if ($unUtilisateur) {
// 	$dao->modifierMdpUser("admin", "passe");
// 	$unUtilisateur = $dao->getUtilisateur("admin");
// 	echo "<p>Nouveau mot de passe de l'utilisateur admin : <b>" . $unUtilisateur->getPassword() . "</b><br>";
	
// 	$dao->modifierMdpUser("admin", "admin");
// 	$unUtilisateur = $dao->getUtilisateur("admin");
// 	echo "Nouveau mot de passe de l'utilisateur admin : <b>" . $unUtilisateur->getPassword() . "</b><br>";
	
// 	$niveauUtilisateur = $dao->getNiveauUtilisateur('admin', 'admin');
// 	echo "NiveauUtilisateur de ('admin', 'admin') : <b>" . $niveauUtilisateur . "</b></p>";
// }
// else
// 	echo "<p>L'utilisateur admin n'existe pas !</p>";


// // test de la méthode envoyerMdp ------------------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de envoyerMdp : </h3>";
// $dao->modifierMdpUser("jim", "passe");
// $ok = $dao->envoyerMdp("jim", "passe");
// if ($ok)
// 	echo "<p>Mail bien envoyé !</p>";
// else
// 	echo "<p>Echec lors de l'envoi du mail !</p>";


// test de la méthode testerDigicodeSalle ---------------------------------------------------------
// modifié par Jim le 28/9/2015
echo "<h3>Test de testerDigicodeSalle : </h3>";
$reponse = $dao->testerDigicodeSalle("10", "34214E");
echo "<p>L'appel de testerDigicodeSalle('10', '34214E') donne : <b>" . $reponse . "</b><br>";


// // test de la méthode testerDigicodeBatiment ------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de testerDigicodeBatiment : </h3>";
// $reponse = $dao->testerDigicodeBatiment("34214E");
// echo "<p>L'appel de testerDigicodeBatiment('34214E') donne : <b>" . $reponse . "</b><br>";





// // test de la méthode aPasseDesReservations -------------------------------------------------------
// // pour ce test, choisir un utilisateur avec des réservations et un autre sans réservation
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de aPasseDesReservations : </h3>";
// $ok = $dao->aPasseDesReservations("zenelsy");
// if ($ok)
// 	echo "<p>zenelsy a bien passé des réservations !<br>";
// else
// 	echo "<p>zenelsy n'a pas passé de réservations !<br>";
// $ok = $dao->aPasseDesReservations("admin");
// if ($ok)
// 	echo "admin a bien passé des réservations !</p>";
// else
// 	echo "admin n'a pas passé de réservations !</p>";


// // test de la méthode supprimerUtilisateur --------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de supprimerUtilisateur : </h3>";
// $ok = $dao->supprimerUtilisateur("jim1");
// if ($ok)
// 	echo "<p>Utilisateur bien supprimé !</p>";
// else
// 	echo "<p>Echec lors de la suppression de l'utilisateur !</p>";


// // test de la méthode listeSalles -----------------------------------------------------------------
// // modifié par Jim le 28/9/2015
// echo "<h3>Test de listeSalles : </h3>";
// $lesSalles = $dao->listeSalles();
// $nbReponses = sizeof($lesSalles);
// echo "<p>Nombre de salles : " . $nbReponses . "</p>";
// // affichage des salles
// foreach ($lesSalles as $uneSalle)
// {	echo ($uneSalle->getRoom_name());
// 	echo ('<br>');
// }
*/

// ferme la connexion à MySQL :
unset($dao);
?>

</body>
</html>