<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueChangerDeMdp.php : visualiser la demande de changement de mot de passe
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
				<a href="index.php?action=Menu">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Changer mon mot de passe</h4>
				<form action="index.php?action=ChangerDeMdp" method="post">
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="nouveauMdp">Nouveau mot de passe :</label>
						<input type="password" name="nouveauMdp" id="nouveauMdp" placeholder="Entrez votre nouveau mot de passe" required value="<?php echo $nouveauMdp; ?>">
					</div>
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="confirmationMdp">Confirmation nouveau mot de passe :</label>
						<input type="password" name="confirmationMdp" id="confirmationMdp" placeholder="Confirmez votre nouveau mot de passe" required value="<?php echo $confirmationMdp; ?>">
					</div>
					<div data-role="fieldcontain">
						<input type="submit" name="btnChangerDeMdp" id="btnChangerDeMdp" value="Changer mon mot de passe">
					</div>
				</form>

				<?php if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					echo "<p>nouveauMdp = " . $nouveauMdp . "</p>";
					echo "<p>confirmationMdp = " . $confirmationMdp . "</p>";
				} ?>
				
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeFooter; ?>">
				<h4><?php echo $message; ?></h4>
			</div>
		</div>
	</body>
</html>