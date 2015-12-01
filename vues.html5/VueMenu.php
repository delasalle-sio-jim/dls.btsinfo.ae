<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueMenu.php : visualiser le menu de l'élève ou de l'administrateur
	// cette vue est appelée par le lien "index.php?action=Menu"
	// la barre d'entête possède un lien de déconnexion permettant de retourner à la page de connexion
	// Ecrit le 29/11/2015 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
</head> 
<body>
	<div id="conteneur">
		<ul id="menu">
			<li><a href="index.php?action=Connecter" data-ajax="false">Déconnexion</a></li>
		</ul>
			
		<div id="contenu">

			<img src="images/Logo_DLS.gif" class="logo" alt="Lycée De La Salle (Rennes)" />&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="images/Intitules_bts_ig_sio.png" class="logo" alt="BTS Informatique" />
			 		
			<h2><?php echo $titre . $prenom . ' ' . $nom; ?></h2>
			
			<ul data-role="listview" data-inset="true">
				<?php if ( $typeUtilisateur == "eleve" ) {
					// menu élève ?>
					<li><a href="index.php?action=ChangerDeMdp" data-transition="<?php echo $transition; ?>">Modifier mon mot de passe</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Informations sur la soirée des anciens</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">M'inscrire à la soirée des anciens</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Recherche d'autres anciens élèves</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Mettre à jour mon profil</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Galerie des photos de classe</a></li>
				<?php } ?>
				<?php if ( $typeUtilisateur == "administrateur" ) {
					// menu administrateur ?>
					<li><a href="index.php?action=ChangerDeMdp" data-transition="<?php echo $transition; ?>">Modifier mon mot de passe</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Créer un administrateur</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Supprimer un administrateur</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Gérer les comptes élèves</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">MAJ des informations sur la soirée</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Consulter les inscriptions à la soirée</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Envoyer courriels de relance</a></li>
					<li><a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Gérer la galerie des photos de classe</a></li>
				<?php } ?>
			</ul>
			
		</div>

		<p id="message">&nbsp;</p>
			
		<p id="footer">Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
	</div>
</body>
</html>