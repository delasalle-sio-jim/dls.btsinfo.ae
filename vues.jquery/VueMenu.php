<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueMenu.php : visualiser le menu de l'élève ou de l'administrateur
	// cette vue est appelée par le lien "index.php?action=Menu", sans passer par un contôleur
	// la barre d'entête possède un lien de déconnexion permettant de retourner à la page de connexion
	// Ecrit le 29/11/2015 par Jim
?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
	</head> 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
				<a href="index.php?action=Deconnecter" data-transition="<?php echo $transition; ?>">Déconnexion</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 20px; margin-bottom: 20px;"><?php echo $titre . $prenom . ' ' . $nom; ?></h4>
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
				
				<?php if($debug == true) {
					echo "<p>SESSION['nom'] = " . $_SESSION['nom'] . "</p>";
					echo "<p>SESSION['mdp'] = " . $_SESSION['mdp'] . "</p>";
					echo "<p>SESSION['niveauUtilisateur'] = " . $_SESSION['niveauUtilisateur'] . "</p>";
				} ?>
				
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Menu</h4>
			</div>
		</div>
	</body>
</html>