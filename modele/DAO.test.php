<?php
// Projet DLS - BTS Info - Anciens élèves
// Test de la classe DAO
// Auteur : JM CARTRON
// Dernière mise à jour : 16/11/2015
// Création : 16/11/2015 par JM CARTRON
// Mise à jour : 11/5/2016 par JM CARTRON

include_once ('Fonction.class.php');
include_once ('Eleve.class.php');
include_once ('Administrateur.class.php');
include_once ('Soiree.class.php');
include_once ('Inscription.class.php');
include_once ('Outils.class.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe DAO</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// connexion du serveur web à la base MySQL
include_once ('DAO.class.php');
$dao = new DAO();

/*
// test de la méthode getLesFonctions -------------------------------------------------------------
// modifié par Jim le 11/5/2016
echo "<h3>Test de getLesFonctions : </h3>";
$lesFonctions = $dao->getLesFonctions();
$nbReponses = sizeof($lesFonctions);
echo "<p>Nombre de fonctions : " . $nbReponses . "</p>";
// affichage des fonctions
foreach ($lesFonctions as $uneFonction)
{	echo ($uneFonction->toString());
	echo ('<br>');
}
*/

/*
// test de la méthode getTypeUtilisateur ----------------------------------------------------------
// modifié par Jim le 12/11/2015
echo "<h3>Test de getTypeUtilisateur : </h3>";
$typeUtilisateur = $dao->getTypeUtilisateur('jean.michel.cartron@gmail.com', 'admin');
echo "<p>TypeUtilisateur de ('jean.michel.cartron@gmail.com', 'admin') : <b>" . $typeUtilisateur . "</b><br>";
$typeUtilisateur = $dao->getTypeUtilisateur('jean.michel.cartron@gmail.com', 'adminnnnn');
echo "TypeUtilisateur de ('jean.michel.cartron@gmail.com', 'adminnnnn') : <b>" . $typeUtilisateur . "</b><br>";
$typeUtilisateur = $dao->getTypeUtilisateur('jean.michel.cartron@gmail.com', 'passe');
echo "TypeUtilisateur de ('jean.michel.cartron@gmail.com', 'passe') : <b>" . $typeUtilisateur . "</b><br>";
*/

/*
// test de la méthode existeAdrMail ---------------------------------------------------------------
// modifié par Jim le 12/11/2015
echo "<h3>Test de existeAdrMail : </h3>";
if ($dao->existeAdrMail("sophie.fonfec@gmail.com")) $existe = "oui"; else $existe = "non";
echo "<p>Existence de l'adresse 'sophie.fonfec@gmail.com' : <b>" . $existe . "</b><br>";
if ($dao->existeAdrMail("anna.lyse.durine@gmail.com")) $existe = "oui"; else $existe = "non";
echo "Existence de l'adresse 'anna.lyse.durine@gmail.com' : <b>" . $existe . "</b></p>";
*/

/*
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
$desEtudesPostBTS = 'Bachelor Informatique "Systèmes, Réseaux et Cloud Computing" au Lycée De La Salle';
$uneDateDerniereMAJ = date('Y-m-d H:i:s', time());		// l'heure courante
$unIdFonction = 1;

$unEleve = new Eleve($unId, $unNom, $unPrenom, $unSexe, $uneAnneeDebutBTS, $unTel, $uneAdrMail, $uneRue, 
	$unCodePostal, $uneVille, $uneEntreprise, $unCompteAccepte, $unMotDePasse, $desEtudesPostBTS, $uneDateDerniereMAJ, $unIdFonction);

$ok = $dao->creerCompteEleve($unEleve);
if ($ok)
	echo "<p>Elève bien enregistré !</p>";
else
	echo "<p>Echec lors de l'enregistrement de l'élève !</p>";
*/

/*
// test de la méthode getEleve --------------------------------------------------------------------
// modifié par Jim le 16/11/2015
echo "<h3>Test de getEleve(id) : </h3>";
$unEleve = $dao->getEleve(1);
if ($unEleve == null)
	echo ("Identifiant 1 inexistant ! <br>");
else
	echo ($unEleve->toString());
echo ('<br>');

$unEleve = $dao->getEleve(2);
if ($unEleve == null)
	echo ("Identifiant 2 inexistant ! <br>");
else
	echo ($unEleve->toString());
echo ('<br>');

echo "<h3>Test de getEleve(adrMail) : </h3>";
$unEleve = $dao->getEleve('sophie.fonfec@gmail.com');
if ($unEleve == null)
	echo ("Adresse mail 'sophie.fonfec@gmail.com' inexistante ! <br>");
else
	echo ($unEleve->toString());
echo ('<br>');

$unEleve = $dao->getEleve('sophie.fonfec@gmail.commmm');
if ($unEleve == null)
	echo ("Adresse mail 'sophie.fonfec@gmail.commmm' inexistante ! <br>");
else
	echo ($unEleve->toString());
echo ('<br>');
*/

/*
// test de la méthode supprimerCompteEleve --------------------------------------------------------
// modifié par Jim le 11/05/2016
echo "<h3>Test de supprimerCompteEleve(adrMail) : </h3>";
$ok = $dao->supprimerCompteEleve('sophie.fonfec@gmail.com');
if ( ! $ok )
	echo ("Adresse mail 'sophie.fonfec@gmail.com' inexistante ! <br>");
else
	echo ("Adresse mail 'sophie.fonfec@gmail.com' supprimée ! <br>");
echo ('<br>');

$ok = $dao->supprimerCompteEleve('sophie.fonfec@gmail.comm');
if ( ! $ok )
	echo ("Adresse mail 'sophie.fonfec@gmail.comm' inexistante ! <br>");
else
	echo ("Adresse mail 'sophie.fonfec@gmail.comm' supprimée ! <br>");
echo ('<br>');
*/

/*
// test de la méthode getAdministrateur -----------------------------------------------------------
// modifié par Jim le 11/5/2016
echo "<h3>Test de getAdministrateur(id) : </h3>";
$unAdministrateur = $dao->getAdministrateur(1);
if ($unAdministrateur == null)
	echo ("Identifiant 1 inexistant ! <br>");
else
	echo ($unAdministrateur->toString());
echo ('<br>');

$unAdministrateur = $dao->getAdministrateur(4);
if ($unAdministrateur == null)
	echo ("Identifiant 2 inexistant ! <br>");
else
	echo ($unAdministrateur->toString());
echo ('<br>');

echo "<h3>Test de getAdministrateur(adrMail) : </h3>";
$unAdministrateur = $dao->getAdministrateur('jean.michel.cartron@gmail.com');
if ($unAdministrateur == null)
	echo ("Adresse mail 'jean.michel.cartron@gmail.com' inexistante ! <br>");
else
	echo ($unAdministrateur->toString());
echo ('<br>');

$unAdministrateur = $dao->getAdministrateur('jean.michel.cartron@gmail.commmm');
if ($unAdministrateur == null)
	echo ("Adresse mail 'jean.michel.cartron@gmail.commmm' inexistante ! <br>");
else
	echo ($unAdministrateur->toString());
echo ('<br>');
*/









/*
// test de la méthode validerCreationCompte -------------------------------------------------------
// modifié par Jim le 16/11/2015
echo "<h3>Test de validerCreationCompte : </h3>";
$ok = $dao->validerCreationCompte(4, 'acceptation');
if ( ! $ok)
	echo ("Mise à jour (4, 'acceptation') refusée ! <br>");
else {
	$unEleve = $dao->getEleve(4);
	echo ("compteAccepte : " . $unEleve->getCompteAccepte());
}
echo ('<br>');

$ok = $dao->validerCreationCompte(4, 'rejet');
if ( ! $ok)
	echo ("Mise à jour (4, 'rejet') refusée ! <br>");
else {
	$unEleve = $dao->getEleve(4);
	echo ("compteAccepte : " . $unEleve->getCompteAccepte());
}
echo ('<br>');

$ok = $dao->validerCreationCompte(4, 'rejetee');
if ( ! $ok)
	echo ("Mise à jour (4, 'rejetee') refusée ! <br>");
else {
	$unEleve = $dao->getEleve(4);
	echo ("compteAccepte : " . $unEleve->getCompteAccepte());
}
echo ('<br>');





/*
// test de la méthode modifierMdp -----------------------------------------------------------------
// modifié par Jim le 16/11/2015
echo "<h3>Test de modifierMdp : </h3>";
$dao->modifierMdp(1, "admin");
$unEleve = $dao->getEleve(1);
echo ("Nouveau mot de passe : " . $unEleve->getMotDePasse()) . "<br>";
$dao->modifierMdp(1, "passe");
$unEleve = $dao->getEleve(1);
echo ("Nouveau mot de passe : " . $unEleve->getMotDePasse()) . "<br>";


/*
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