<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlVoirDetailSoiree.php : traiter la demande de consultation des informations sur la soirée
// Ecrit le 21/01/2016 par Nicolas Esteve
// Modifié le 01/06/2016 par Killian BOUTIN

// connexion du serveur web à la base MySQL
include_once ('modele/DAO.class.php');
$dao = new DAO();

// récupère les détails de la soirée pour les afficher
$relire = false;
$uneSoiree = $dao->getSoiree($relire);
$themeFooter = $themeNormal;


if ($uneSoiree == null )
{	$affichage = "La prochaine soirée des anciens n'a pas encore été programmée à ce jour !";
}
else
{
	$affichage = "<p>Bonjour,</p>";
	$affichage .= "<p>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO ";
	$affichage .= " (ex BTS IG) du Lycée De La Salle sont conviés.</p>";

	$affichage .= "<p>Ce repas aura lieu le <b>vendredi " . Outils::convertirEnDateFR($uneSoiree->getDateSoiree()) . " à 20 h</b><br>";


	if ($uneSoiree->getNomRestaurant() != null)
	{	$affichage .= "au restaurant <b>" . $uneSoiree->getNomRestaurant() . "</b>";
		
	if ($uneSoiree->getAdresse() != null)
	{	$affichage .= "<br>situé <b> " . $uneSoiree->getAdresse( ). "</b>.</p>";
	}
	else
	{	$affichage .="<br>dont l'adresse est précisée dans le lien ci-joint. </p>";
	}
	}

	if ($uneSoiree->getTarif() != null)
	{	$affichage .= "<p>Le tarif est de <b>" . $uneSoiree->getTarif() . " euros</b> par personne. </p>";
	}

	if ($uneSoiree->getLienMenu() != null)
	{	$affichage .= '<p>Informations plus détaillées sur le restaurant ou sur les menus proposés : <br> <a target="_blank" href="' . $uneSoiree->getLienMenu() . '".>' . $uneSoiree->getLienMenu() .'</a></p>';
	}

	$affichage .= "<p>Dans l'espoir de vous voir à cette soirée,<br/><br/>Cordialement,<br/>L'équipe d'INPACT</p>";
}


include_once ($cheminDesVues . 'VueVoirDetailsSoiree.php');