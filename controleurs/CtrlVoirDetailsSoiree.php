<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlVoirDetailSoiree.php : traiter la demande de consultation des informations sur la soirée
// Ecrit le 21/01/2016 par Nicolas Esteve
// Modifié le 20/5/2016 par Jim

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

// récupère les détails de la soirée pour les afficher
$relire = false;
$Soiree = $dao->getSoiree($relire);
$themeFooter = $themeNormal;

include_once ($cheminDesVues . 'VueVoirDetailsSoiree.php');