<?php
// Projet DLS - BTS Info - Anciens élèves
// Test de la classe DAO
// fichier : modele/DAO.test.php
// Création : 16/11/2015 par JM CARTRON
// Mise à jour : 13/5/2016 par JM CARTRON

// ATTENTION : la position des tests dans ce fichier est identique à la position des méthodes testées dans la classe DAO

include_once ('Fonction.class.php');
include_once ('Eleve.class.php');
include_once ('Administrateur.class.php');
include_once ('Soiree.class.php');
include_once ('Inscription.class.php');
include_once ('Image.class.php');
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
// test de la méthode modifierCompteAdmin ---------------------------------------------------------
// créé par Killian BOUTIN le 24/05/16
echo "<h3>Test de modifierCompteAdmin : </h3>";
$unId = 4;
$uneAdrMail = "jean.michel.cartron@gmail.com";
$unMotDePasse = "passe";
$unPrenom = "Eddy";
$unNom = "TAVULEUR";

$unAdministrateur = new Administrateur($unId, $uneAdrMail, $unMotDePasse, $unPrenom, $unNom);

$ok = $dao->modifierCompteAdmin($unAdministrateur);
if ($ok)
	echo "<p>Administrateur bien mis à jour !</p>";
else
	echo "<p>Echec de la mise à jour</p>" . ' UPDATE ae_administrateurs SET nom = "' . $unAdministrateur->getNom() . '", prenom = "' . $unAdministrateur->getPrenom() . '" WHERE adrMail = "' . $unAdministrateur->getAdrMail() . '"';
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
if ($uneSoiree != null) echo $uneSoiree->toString() . "<br>";

if ( isset($_SESSION['Soiree']) == true ){
	echo "La variable de session 'Soiree' existe";
}
else
	echo "La variable de session 'Soiree' n'existe pas";
echo ('<br>');
*/


/*
// test de la méthode modifierSoiree --------------------------------------------------------------
// modifié par Jim le 13/05/2016
session_start();		// permet d'utiliser des variables de session
echo "<h3>Test de modifierSoiree : </h3>";

$uneSoiree = $dao->getSoiree(true);
if ($uneSoiree != null) echo $uneSoiree->toString() . "<br>";

$uneSoiree->setDateSoiree("25/12/2016");
$uneSoiree->setNomRestaurant("Cot' et Boeuffff");
$uneSoiree->setAdresse("1 Ter Route de Fougères, 35510 Cesson-Sévignéééé");
$uneSoiree->setTarif("222");
$uneSoiree->setLienMenu("http://www.pagesjaunes.fr/pros/51832422++++");
$uneSoiree->setLatitude("-1.6339654");
$uneSoiree->setLongitude("48.1326846");
$dao->modifierSoiree($uneSoiree);

$uneSoiree = $dao->getSoiree(true);
if ($uneSoiree != null) echo $uneSoiree->toString() . "<br>";

$uneSoiree->setDateSoiree("04/11/2016");
$uneSoiree->setNomRestaurant("Cot' et Boeuf");
$uneSoiree->setAdresse("1 Ter Route de Fougères, 35510 Cesson-Sévigné");
$uneSoiree->setTarif("22");
$uneSoiree->setLienMenu("http://www.pagesjaunes.fr/pros/51832422");
$uneSoiree->setLatitude("48.1326846");
$uneSoiree->setLongitude("-1.6339654");
$dao->modifierSoiree($uneSoiree);

$uneSoiree = $dao->getSoiree(true);
if ($uneSoiree != null) echo $uneSoiree->toString() . "<br>";
*/

/*
// test de la méthode creerInscription ------------------------------------------------------------
// modifié par Jim le 13/05/2016
echo "<h3>Test de creerInscription : </h3>";
$unId = 0;
$dateInscription = "13/05/2016";
$unNbrePersonnes = 2;
$montantRegle = 20.50;
$montantRembourse = 10.50;
$idEleve = 10;
$idSoiree = 1;
$inscriptionAnnulee = true;

$uneInscription = new Inscription($unId, $dateInscription, $unNbrePersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee);
echo $uneInscription->toString() . "<br>";

$ok = $dao->creerInscription($uneInscription);
if ($ok)
	echo "<p>Inscription bien enregistrée !</p>";
else
	echo "<p>Echec lors de l'enregistrement de l'inscription !</p>";
*/

/*
// test de la méthode getInscription --------------------------------------------------------------
// modifié par Jim le 13/05/2016
echo "<h3>Test de getInscription(id) : </h3>";
$uneInscription = $dao->getInscription(1);
if ($uneInscription == null)
	echo ("Identifiant 1 inexistant ! <br>");
else
	echo ($uneInscription->toString());
echo ('<br>');

$uneInscription = $dao->getInscription(107);
if ($uneInscription == null)
	echo ("Identifiant 107 inexistant ! <br>");
else
	echo ($uneInscription->toString());
echo ('<br>');
*/

/*
// test de méthode getInscriptionEleve -----------------------------------------------------------
// créé par Killian le 28/05/2016
echo "<h3>Test de getInscriptionEleve(idEleve) : </h3>";
$uneInscription = $dao->getInscriptionEleve(2);
if ($uneInscription == null)
	echo ("L'ancien élève à l'identifiant 2 n'est pas inscrit ! <br>");
else{
	echo ("L'ancien élève à l'identifiant 2 possède l'inscription suivante : <br><br>");
	echo ($uneInscription->toString());
}
echo ('<br>');
$uneInscription = $dao->getInscriptionEleve(9);
if ($uneInscription == null)
	echo ("L'ancien élève à l'identifiant 9 n'est pas inscrit ! <br>");
else{
	echo ("L'ancien élève à l'identifiant 7 possède l'inscription suivante : <br><br>");
	echo ($uneInscription->toString());
}
echo ('<br>');
*/

/*
// test de la méthode getLesInscriptions ---------------------------------------------------------
// créé par le 25/05/2016 Killian BOUTIN
// modifié le 26/05/2015 par Killian BOUTIN 

echo "<h3>Test de getLesInscriptions : </h3>";
$lesInscriptions = $dao->getLesInscriptions();
$nbReponses = sizeof($lesInscriptions);
echo "<p>Nombre d'inscriptions : " . $nbReponses . "</p>";

// affichage des inscriptions
foreach ($lesInscriptions as $uneInscription)
{	echo ($uneInscription->toString());
	echo ('<br>');
}

// affichage des noms et prénoms des élèves inscrits
$numInscription = 0;
foreach ($lesInscriptions as $uneInscription)
{	$numInscription += 1; // incrémentation du numéro d'inscription
	// affichage d'un numéro incrémenté, du nom et du prénom de chaque "$uneInscription" dans la collection "$lesInscriptions"
	echo ($numInscription . " " . $uneInscription->getNom() . " " . $uneInscription->getPrenom());
	echo ('<br>');
}
*/


/*
// test de la méthode modifierInscription ---------------------------------------------------------
// modifié par Jim le 13/05/2016
echo "<h3>Test de modifierInscription : </h3>";
$unId = 108;
$unNom = "Boutin";
$unPrenom = "Killian";
$anneeDebutBTS = "2015";
$dateInscription = "13/05/2015";
$nbPersonnes = 10; 
$montantRegle = 10;
$montantRembourse = 5;
$idEleve = 9;
$idSoiree = 1;
$inscriptionAnnulee = 0;
$unTarif = 24;

$uneInscription = new Inscription($unId, $unNom, $unPrenom, $anneeDebutBTS, $dateInscription, $nbPersonnes, $montantRegle, $montantRembourse, $idEleve, $idSoiree, $inscriptionAnnulee, $unTarif);

$ok = $dao->modifierInscription($uneInscription);
if ($ok)
	echo "<p>Inscription bien mise à jour !</p>";
else
	echo "<p>Echec lors de la mise à jour de l'inscription !</p>";
echo ('<br>');

$uneInscription = $dao->getInscriptionEleve(9);
if ($uneInscription == null)
	echo ("Identifiant inexistant ! <br>");
else
	echo ($uneInscription->toString() . "<br>");
echo ('<br>');
*/

/*
// test de la méthode getIdInscription ------------------------------------------------------------
// modifié par Jim le 13/05/2016
echo "<h3>Test de getIdInscription(idEleve) : </h3>";
$unIdInscription = $dao->getIdInscription(3);
if ($unIdInscription == -1)
	echo ("L'élève 3 n'a pas d'inscription ! <br>");
else
	echo ("L'élève 3 a  une inscription : " . $unIdInscription . "<br>");
echo ('<br>');

$unIdInscription = $dao->getIdInscription(33);
if ($unIdInscription == -1)
	echo ("L'élève 33 n'a pas d'inscription ! <br>");
else
	echo ("L'élève 33 a  une inscription : " . $unIdInscription . "<br>");
echo ('<br>');
*/

/*
// test de la méthode annulerInscription ---------------------------------------------------------
// modifié par Jim le 13/05/2016
echo "<h3>Test de annulerInscription : </h3>";
$ok = $dao->annulerInscription(1);
if ($ok)
	echo "<p>Annulation de l'inscription 1 !</p>";
else
	echo "<p>Echec lors de l'annulation de l'inscription 1 !</p>";
echo ('<br>');

$ok = $dao->annulerInscription(2);
if ($ok)
	echo "<p>Annulation de l'inscription 2 !</p>";
else
	echo "<p>Echec lors de l'annulation de l'inscription 2 !</p>";
echo ('<br>');
*/

/*
// test de la méthode getLesAdressesMailsDesInscrits ---------------------------------------------------------
// modifié par Jim le 14/5/2016
echo "<h3>Test de getLesAdressesMailsDesInscrits : </h3>";
$lesAdressesMails = $dao->getLesAdressesMailsDesInscrits();
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
// test de la méthode creerAdressesMails ---------------------------------------------------------
// créé par Killian BOUTIN le 30/05/2016
echo "<h3>Test de creerAdressesMails : </h3>";
$lesAdressesMails = $dao->creerAdressesMails("delasallesioboutink");
$nbReponses = sizeof($lesAdressesMails);
echo "<p>Nombre d'adresses mails créées : " . $nbReponses . "</p>";

$i =0;
// affichage des adresses mails
foreach ($lesAdressesMails as $uneAdresseMail)
{	
	$i +=1;
	echo $i . " " . $uneAdresseMail;
	echo ('<br>');
}
*/

/*
// test de la méthode creerCompteEleveAuto ---------------------------------------------------------
// elle teste en plus la méthode creerAdressesMails, existeAdrMail et l'outil::envoyerMail
// créé par Killian BOUTIN le 30/05/2016
echo "<h3>Test de creerCompteEleveAuto : </h3>";
$lesAdressesMails = $dao->creerAdressesMails("delasallesioboutin");
$nbReponses = sizeof($lesAdressesMails);
echo "<p>Nombre d'adresses mails créées : " . $nbReponses . "</p>";

$i =0;
// affichage des adresses mails
foreach ($lesAdressesMails as $uneAdresseMail)
{
	$i +=1;
	echo $i . " " . $uneAdresseMail;
	
	if ($dao->existeAdrMail($uneAdresseMail) == true){
		echo " => Eleve existant dans la BDD<br>";
	}
	else{
		$ok = $dao->creerCompteEleveAuto($uneAdresseMail);
		if ($ok){
			echo " => L'élève a bien été enregistré !<br>";
			
				$sujet = "3 - Essai n° " . $i . "  d'envoi de masse";
				$message = "L'envoi de masse n° " . $i . "  est un succès";
				$ok = Outils::envoyerMail ($uneAdresseMail, $sujet, $message, $ADR_MAIL_EMETTEUR);
					if($ok){
						echo " => L'envoi de mail s'est effectué avec succès<br>";
					}
					else{
						echo " => Le mail n'a pas pu être envoyé";
					}
					
		}
		else{
			echo " => Echec lors de l'enregistrement de l'élève !<br>";
		}
	}
	
}
*/

/*
// test de la méthode ExportToCSV ($nomColonnes, $requeteSQL, $nomFichierCSV) ---------------------------------------------------------
// créé par Killian BOUTIN le 01/06/2016
echo "<h3>Test de ExportToCSV (nomColonnes, donneesTable, nomFichierCSV) : </h3>";

$nomColonnes = array("anneeDebutBTS","tel","prenom");
$requeteSQL = "SELECT anneeDebutBTS,tel,prenom FROM ae_eleves";
$nomFichierCSV = "Eleves";

$dao->ExportToCSV($nomColonnes, $requeteSQL, $nomFichierCSV);
*/

/*
// test de la méthode getLesImages ---------------------------------------------------------
// créé par le 15/06/2016 Killian BOUTIN

echo "<h3>Test de getLesImages : </h3>";
$lesImages = $dao->getLesImages();
$nbPhotos = sizeof($lesImages);
echo "<p>Nombre de photos : " . $nbPhotos . "</p>";

// affichage des infos sur les photos et de la photos
foreach ($lesImages as $uneImage)
{	$lien = $uneImage->getLien();
	echo ($uneImage->toString());
	echo ('<a href="../images/galerie/' . $lien . '"> Lien vers la photo </a>');
	echo ('<br><br>');
}
*/

/*
// test de la méthode getImage ---------------------------------------------------------
// créé par le 16/06/2016 Killian BOUTIN

echo "<h3>Test de getImage : </h3>";
$uneImage = $dao->getImage(1);

if ($uneImage){
	// affichage des infos sur la photo
	echo ($uneImage->toString());
	echo ('<a href="../photos.700/' . $uneImage->getLien() . '"> Lien vers la photo </a>');
	echo ('<br><br>');
}
else{
	echo "Aucune image ne possède l'identifiant 1";
}

$uneImage = $dao->getImage(50);

if ($uneImage){
	// affichage des infos sur la photo
	echo ($uneImage->toString());
	echo ('<a href="../photos.700/' . $uneImage->getLien() . '"> Lien vers la photo </a>');
	echo ('<br><br>');
}
else{
	echo "Aucune image ne possède l'identifiant 50";
}
*/

/*
// test de la méthode ajouterImage(uneImage) ---------------------------------------------------------
// créé par le 16/06/2016 Killian BOUTIN

echo "<h3>Test de ajouterImage(uneImage) : </h3>";
$unId = 0;
$unePromo = 2001;
$uneClasse = 1;
$unLien = "01-02-Info2.jpg";

$uneImage = new Image($unId, $unePromo, $uneClasse, $unLien);

$ok = $dao->ajouterImage($uneImage);

if ($ok){
	echo "L'image a été ajoutée avec succès";
}
else{
	echo "L'ajout est un echec";
}
*/


/*
// test de la méthode modifierImage(uneImage) ---------------------------------------------------------
// créé par le 16/06/2016 Killian BOUTIN

echo "<h3>Test de modifierImage(uneImage) : </h3>";
$unId = 4;
$unePromo = 2001;
$uneClasse = 2;
$unLien = "01-02-Info2.jpg";

$uneImage = new Image($unId, $unePromo, $uneClasse, $unLien);

$ok = $dao->modifierImage($uneImage);

if ($ok){
	echo "L'image a été modifiée avec succès";
}
else{
	echo "L'ajout est un echec";
}
*/


/*
// test de la méthode supprimerImage(idImage) ---------------------------------------------------------
// créé par le 15/06/2016 Killian BOUTIN

echo "<h3>Test de supprimerImage(idImage) : </h3>";
$ok = $dao->supprimerImage(1);
if ($ok){
	echo "L'image a été supprimée avec succès";
}
else{
	echo "La suppression est un echec";
}
*/


// test de la méthode redimensionnerImage(uneImage, uneDestination, uneTailleMax) ---------------------------------------------------------
// créé par le 17/06/2016 Killian BOUTIN

echo "<h3>Test de redimensionnerImage(uneImage, uneDestination, uneTailleMax) : </h3>";

?> 
<form enctype="multipart/form-data" action="DAO.test.php" method="post">
	<input type="file" name="filePhoto" id="filePhoto" required><br>
	<input type="submit" value="Envoyer les données" name="btnEnvoi" id="btnEnvoi" />		
</form>

<?php
if (!empty ($_FILES['filePhoto'])){
	
	/* Initialisation des variables d'upload de la photo */
	$uneSource = '../photos.initiales/'; // Le dossier d'enregistrement
	$uneImage = $_FILES['filePhoto']['name']; // Le fichier récupéré
	
	/* Deplacement de la photo téléchargé dans le dossier => photos.initiales/ */
	move_uploaded_file($_FILES['filePhoto']['tmp_name'], $uneSource . $uneImage);
	
	$toUpperImage = strtoupper($_FILES['filePhoto']['tmp_name']);
	echo "<br>L'extension de l'image avant de la déplacer est " . strrchr($toUpperImage, '.') . ".<br>";
	
	$toUpperImage =  strtoupper($uneSource . $uneImage);
	echo "L'extension de l'image après l'avoir déplacé est " .  strrchr($toUpperImage, '.') . ".<br>";
	echo "La largeur était de " . getimagesize($uneSource . $uneImage)[0] . " et la hauteur de " .	$src_w = getimagesize($uneSource . $uneImage)[1] . ".<br>";
	
	/* On met dans images.galerie pour ne pas effacer les autres photos */
	$ok = $dao->redimensionnerImage($uneImage, $uneSource,'../images.galerie/',500);
	
	if ($ok){
		echo "<b>L'image a été redimensionnée avec succès.</b>";
	}
	else{
		echo "<b>Le redimensionnement est un échec.</b>";
	}
}

// ferme la connexion à MySQL
unset($dao);
?>

</body>
</html>