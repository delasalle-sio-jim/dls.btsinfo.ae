<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction du contrôleur CtrlProposerStage.php : traiter la demande de dépôt de stage
// Ecrit le 1/19/2015 par Nicolas Esteve
// Modifié le 20/5/2016 par Jim

// on vérifie si le demandeur de cette action est bien authentifié
if ( $_SESSION['typeUtilisateur'] != 'eleve' && $_SESSION['typeUtilisateur'] != 'administrateur') {
	// si le demandeur n'est pas authentifié, il s'agit d'une tentative d'accès frauduleux
	// dans ce cas, on provoque une redirection vers la page de connexion
	header ("Location: index.php?action=Deconnecter");
}
else {
	include_once ($cheminDesVues . 'VueProposerStage.php');
}