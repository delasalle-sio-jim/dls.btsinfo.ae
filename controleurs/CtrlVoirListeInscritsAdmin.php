<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlVoirListeInscritsAdmin.php : traiter la demande de consultation des informations sur les inscriptions des anciens élèves à la soirée des anciens par un admin
// Ecrit le 27/05/2015 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

// récupère les détails des inscriptions pour les afficher
$lesInscriptions = $dao->getLesInscriptions();

/* récupération du nombre d'inscriptions */

$nombreInscrits = 0;

foreach ($lesInscriptions as $uneInscription)
{
	$nombreInscrits += $uneInscription->getNbrePersonnes();
}
$themeFooter = $themeNormal;

/* déclaration du nombre total d'inscriptions */
$nombreInscritsTotal = 0;

/* déclaration du montant total réglé */
$montantTotalRegle = 0.00;

/* déclaration du montant total remboursé */
$montantTotalRembourse = 0.00;

/* déclaration du montant total */
$montantTotalFinal = 0.00;


if ($nombreInscrits == 0 )
{
	$titre = "Aucun élève n'est inscrit à ce jour";
}

elseif ($nombreInscrits == 1) {
	$titre = $nombreInscrits . " inscrit à la prochaine soirée des anciens :";
}

else{
	$titre = $nombreInscrits . " inscrits à la prochaine soirée des anciens :";
}

include_once ($cheminDesVues . 'VueVoirListeInscritsAdmin.php');