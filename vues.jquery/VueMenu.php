<?php
	// Projet Réservations M2L - version web mobile
	// Fonction de la vue VueMenu.php : visualiser le menu de l'utilisateur ou de l'administrateur
	// cette vue est appelée par le lien "index.php?action=Menu", sans passer par un contôleur
	// la barre d'entête possède un lien de déconnexion permettant de retourner à la page de connexion
	// Ecrit le 12/10/2015 par Jim
?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
	</head> 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Deconnecter">Déconnexion</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 20px; margin-bottom: 20px;">Utilisateur : <?php echo $nom; ?></h4>
				<ul data-role="listview" data-inset="true">
					<li><a href="index.php?action=ConsulterReservations">Consulter mes réservations</a></li>
					<li><a href="index.php?action=ConfirmerReservation">Confirmer une réservation</a></li>
					<li><a href="index.php?action=AnnulerReservation">Annuler une réservation</a></li>
					<li><a href="index.php?action=ChangerDeMdp">Modifier mon mot de passe</a></li>
					<?php if ( $niveauUtilisateur == "administrateur" ) {
						// le menu administrateur possède 2 options supplémentaires ?>
						<li><a href="index.php?action=CreerUtilisateur">Créer un utilisateur</a></li>
						<li><a href="index.php?action=SupprimerUtilisateur">Supprimer un utilisateur</a></li>
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