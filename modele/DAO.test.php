<?php
// Projet DLS - BTS Info - Anciens élèves
// Test de la classe DAO
// Création : 16/11/2015 par JM CARTRON
// Mise à jour : 13/5/2016 par JM CARTRON

// ATTENTION : la position des tests dans ce fichier est identique à la position des méthodes testées dans la classe DAO

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
// test de la méthode modifierCompteEleve ---------------------------------------------------------
// modifié par Jim le 13/05/2016
echo "<h3>Test de modifierCompteEleve : </h3>";
$unId = 0;
$unNom = "fonfecccc";
$unPrenom = "sophieeee";
$unSexe = "H";
$uneAnneeDebutBTS = "2000";
$unTel = "0011223344";
$uneAdrMail = "sophie.fonfec@gmail.com";
$uneRue = "1, rue de la mairieeee";
$unCodePostal = "35555";
$uneVille = "Rennessss";
$uneEntreprise = "Orangeeeeeeeeeee";
$unCompteAccepte = false;
$unMotDePasse = "passe";
$desEtudesPostBTS = 'Bachelor Informatique "Systèmes, Réseaux et Cloud Computing" au Lycée De La Salleeeee';
$uneDateDerniereMAJ = date('Y-m-d H:i:s', time());		// l'heure courante
$unIdFonction = 2;

$unEleve = new Eleve($unId, $unNom, $unPrenom, $unSexe, $uneAnneeDebutBTS, $unTel, $uneAdrMail, $uneRue,
		$unCodePostal, $uneVille, $uneEntreprise, $unCompteAccepte, $unMotDePasse, $desEtudesPostBTS, $uneDateDerniereMAJ, $unIdFonction);

$ok = $dao->modifierCompteEleve($unEleve);
if ($ok)
	echo "<p>Elève bien mis à jour !</p>";
else
	echo "<p>Echec lors de la mise à jour de l'élève !</p>";
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
// test de la méthode getLesEleves ----------------------------------------------------------------
// modifié par Jim le 13/5/2016
echo "<h3>Test de getLesEleves : </h3>";
$lesEleves = $dao->getLesEleves();
$nbReponses = sizeof($lesEleves);
echo "<p>Nombre d'élèves : " . $nbReponses . "</p>";
// affichage du premier élève de la collection
echo ($lesEleves[0]->toString());
echo ('<br>');
// affichage du dernier élève de la collection
echo ($lesEleves[$nbReponses-1]->toString());
echo ('<br>');
*/

/*
// test de la méthode getLesAdressesMails ---------------------------------------------------------
// modifié par Jim le 13/5/2016
echo "<h3>Test de getLesAdressesMails : </h3>";
$lesAdressesMails = $dao->getLesAdressesMails();
$nbReponses = sizeof($lesAdressesMails);
echo "<p>Nombre d'adresses mails : " . $nbReponses . "</p>";
// affichage de la première adresse de la collection
echo ($lesAdressesMails[0]);
echo ('<br>');
// affichage de la dernière adresse de la collection
echo ($lesAdressesMails[$nbReponses-1]);
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
// test de la méthode validerCreationCompte -------------------------------------------------------
// modifié par Jim le 16/11/2015
echo "<h3>Test de validerCreationCompte : </h3>";
$ok = $dao->validerCreationCompte(5, 'acceptation');
if ( ! $ok)
	echo ("Mise à jour (5, 'acceptation') refusée ! <br>");
else {
	$unEleve = $dao->getEleve(5);
	echo ("compteAccepte : " . $unEleve->getCompteAccepte());
}
echo ('<br>');

$ok = $dao->validerCreationCompte(5, 'rejet');
if ( ! $ok)
	echo ("Mise à jour (5, 'rejet') refusée ! <br>");
else {
	$unEleve = $dao->getEleve(5);
	echo ("compteAccepte : " . $unEleve->getCompteAccepte());
}
echo ('<br>');

$ok = $dao->validerCreationCompte(5, 'rejetee');
if ( ! $ok)
	echo ("Mise à jour (5, 'rejetee') refusée ! <br>");
else {
	$unEleve = $dao->getEleve(5);
	echo ("compteAccepte : " . $unEleve->getCompteAccepte());
}
echo ('<br>');
*/

/*
// test de la méthode modifierMdpEleve ------------------------------------------------------------
// modifié par Jim le 13/05/2016
echo "<h3>Test de modifierMdpEleve : </h3>";
$dao->modifierMdpEleve('jean.michel.cartron@gmail.com', "admin");
$unEleve = $dao->getEleve('jean.michel.cartron@gmail.com');
echo ("Nouveau mot de passe : " . $unEleve->getMotDePasse()) . "<br>";

$dao->modifierMdpEleve('jean.michel.cartron@gmail.com', "passe");
$unEleve = $dao->getEleve('jean.michel.cartron@gmail.com');
echo ("Nouveau mot de passe : " . $unEleve->getMotDePasse()) . "<br>";
*/

/*
// test de la méthode envoyerMdp ------------------------------------------------------------------
// modifié par Jim le 12/05/2016
echo "<h3>Test de envoyerMdp : </h3>";
$dao->modifierMdp('jean.michel.cartron@gmail.com', "passe");
$ok = $dao->envoyerMdp('jean.michel.cartron@gmail.com', "passe");
if ($ok)
 	echo "<p>Mail bien envoyé !</p>";
else
 	echo "<p>Echec lors de l'envoi du mail !</p>";
*/

/*
// test de la méthode creerCompteAdministrateur ---------------------------------------------------
// modifié par Jim le 12/05/2016
echo "<h3>Test de creerCompteAdministrateur : </h3>";
$unId = 0;
$uneAdrMail = "sophie.fonfec@gmail.com"; 
$unMotDePasse = "admin";
$unPrenom = "sophie";
$unNom = "fonfec";

$unAdministrateur = new Administrateur($unId, $uneAdrMail, $unMotDePasse, $unPrenom, $unNom);

$ok = $dao->creerCompteAdministrateur($unAdministrateur);
if ($ok)
	echo "<p>Administrateur bien enregistré !</p>";
else
	echo "<p>Echec lors de l'enregistrement de l'administrateur !</p>";
*/

/*
 // test de la méthode getAdministrateur ----------------------------------------------------------
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
 	echo ("Identifiant 4 inexistant ! <br>");
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
// test de la méthode supprimerCompteAdministrateur -----------------------------------------------
// modifié par Jim le 12/05/2016
echo "<h3>Test de supprimerCompteAdministrateur(id) : </h3>";
$ok = $dao->supprimerCompteAdministrateur(4);
if ( ! $ok )
	echo ("Identifiant '4' inexistant ! <br>");
else
	echo ("Administrateur '4' supprimé ! <br>");
echo ('<br>');

$ok = $dao->supprimerCompteAdministrateur(6);
if ( ! $ok )
	echo ("Identifiant '6' inexistant ! <br>");
else
	echo ("Administrateur '6' supprimé ! <br>");
echo ('<br>');

echo "<h3>Test de supprimerCompteAdministrateur(adrMail) : </h3>";
$ok = $dao->supprimerCompteAdministrateur('sophie.fonfec@gmail.com');
if ( ! $ok )
	echo ("Adresse mail 'sophie.fonfec@gmail.com' inexistante ! <br>");
else
	echo ("Adresse mail 'sophie.fonfec@gmail.com' supprimée ! <br>");
echo ('<br>');

$ok = $dao->supprimerCompteAdministrateur('sophie.fonfec@gmail.comm');
if ( ! $ok )
	echo ("Adresse mail 'sophie.fonfec@gmail.comm' inexistante ! <br>");
else
	echo ("Adresse mail 'sophie.fonfec@gmail.comm' supprimée ! <br>");
echo ('<br>');
*/

/*
// test de la méthode modifierMdpAdministrateur ---------------------------------------------------
// modifié par Jim le 13/05/2016
echo "<h3>Test de modifierMdpAdministrateur : </h3>";
$dao->modifierMdpAdministrateur('jean.michel.cartron@gmail.com', "passe");
$unAdministrateur = $dao->getAdministrateur('jean.michel.cartron@gmail.com');
echo ("Nouveau mot de passe : " . $unAdministrateur->getMotDePasse()) . "<br>";

$dao->modifierMdpAdministrateur('jean.michel.cartron@gmail.com', "admin");
$unAdministrateur = $dao->getAdministrateur('jean.michel.cartron@gmail.com');
echo ("Nouveau mot de passe : " . $unAdministrateur->getMotDePasse()) . "<br>";
*/

/*
// test de la méthode getSoiree -------------------------------------------------------------------
// modifié par Jim le 13/05/2016
session_start();		// permet d'utiliser des variables de session
echo "<h3>Test de getSoiree : </h3>";
if ( isset($_SESSION['Soiree']) == true )
	echo "La variable de session 'Soiree' existe";
else 
	echo "La variable de session 'Soiree' n'existe pas";
echo ('<br>');
$uneSoiree = $dao->getSoiree(true);
echo $uneSoiree->toString() . "<br>";
if ( isset($_SESSION['Soiree']) == true )
	echo "La variable de session 'Soiree' existe";
else
	echo "La variable de session 'Soiree' n'existe pas";
echo ('<br>');
*/









// ferme la connexion à MySQL :
unset($dao);
?>

</body>
</html>