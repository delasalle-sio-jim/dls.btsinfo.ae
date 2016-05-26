<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlVoirListeInscrits.php : traiter la demande de consultation des informations sur les inscriptions des anciens élèves à la soirée des anciens
// Ecrit le 25/05/2015 par Killian BOUTIN
// Modifié le 26/05/2016 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

// récupère les détails des inscriptions pour les afficher
$lesInscriptions = $dao->getLesInscriptions();
$themeFooter = $themeNormal;

include_once ($cheminDesVues . 'VueVoirListeInscrits.php');