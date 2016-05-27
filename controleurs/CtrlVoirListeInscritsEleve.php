<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlVoirListeInscritsEleve.php : traiter la demande de consultation des informations sur les inscriptions des anciens élèves à la soirée des anciens par un eleve
// Ecrit le 25/05/2015 par Killian BOUTIN
// Modifié le 27/05/2016 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

// récupère les détails des inscriptions pour les afficher
$lesInscriptions = $dao->getLesInscriptions();

/* récupération du nombre d'inscriptions */
$nombreInscrits = sizeof($lesInscriptions);
$themeFooter = $themeNormal;

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

include_once ($cheminDesVues . 'VueVoirListeInscritsEleve.php');