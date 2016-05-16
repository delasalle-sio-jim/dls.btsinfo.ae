<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlDetailSoiree.php : 
// Ecrit le 21/01/2016 par Nicolas Esteve


// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
// des détails de la soirée pour afficher un message au eleves avec les détails
$relire = false;
$Soiree = $dao->GetSoiree($relire);
$themeFooter = $themeNormal;
include_once ($cheminDesVues . 'VueDetailsSoiree.php');