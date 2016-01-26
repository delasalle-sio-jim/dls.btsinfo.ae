<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlDetailSoiree.php : 
// Ecrit le 21/01/2016 par Nicolas Esteve


// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();
// obtention de la collection des fonctions occupées par les anciens élèves (pour liste déroulante)
$urgence = false;
$Soiree = $dao->GetDonnesSoiree($urgence);
$themeFooter = $themeNormal;
include_once ($cheminDesVues . 'VueDetailsSoiree.php');