<?php
// ce fichier est destiné à être inclus dans les pages PHP qui ont besoin de se connecter à la base mrbs de GRR
// 2 possibilités pour inclure ce fichier :
//     include_once ('include_parametres.php');
//     require_once ('include_parametres.php');

// paramètres de connexion -----------------------------------------------------------------------------------
global $PARAM_HOTE, $PARAM_PORT, $PARAM_BDD, $PARAM_USER, $PARAM_PWD;
$PARAM_HOTE = "localhost";			// si le sgbd est sur la même machine que le serveur php
$PARAM_PORT = "3306";				// le port utilisé par le serveur MySql
$PARAM_BDD = "anciensEtudiants";	// nom de la base de données
$PARAM_USER = "cartron";			// nom de l'utilisateur
$PARAM_PWD = "cartron";				// son mot de passe

// Autres paramètres -----------------------------------------------------------------------------------------
global $ADR_MAIL_EMETTEUR, $ADR_MAIL_ADMINISTRATEUR, $ADR_SERVICE_WEB;

// adresse de l'émetteur lors d'un envoi de courriel
// autres adresses fictives "delasalle.sio.emetteur@gmail.com" et "delasalle.sio.destinataire@gmail.com"
$ADR_MAIL_EMETTEUR = "delasalle.sio.eleves@gmail.com";// mot de pase sio1sio2 (boite mail test)
// adresse de l'administrateur lors d'un envoi de courriel
// $ADR_MAIL_ADMINISTRATEUR = "jean.michel.cartron@gmail.com";
$ADR_MAIL_ADMINISTRATEUR = "delasalle.sio.esteve.n@gmail.com";
// adresse du service web
$ADR_SERVICE_WEB = "http://localhost/ws-php-cartron/dls.btsinfo.ae/services/";

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!