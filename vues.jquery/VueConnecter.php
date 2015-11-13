<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 9/11/2015 par Jim
?>
<!doctype html>
<html>
	<head>	
		<?php include_once ('head.php'); ?>
	</head> 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 0px; margin-bottom: 0px;">M'identifier</h4>
				<form name="form1" id="form1" action="index.php?action=Connecter" method="post">
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="txtAdrMail">Adresse mail :</label>
						<input type="text" name="txtAdrMail" id="txtAdrMail" data-mini="true" placeholder="Mon adresse mail" value="<?php echo $adrMail; ?>" >

						<label for="txtMotDePasse">Mot de passe :</label>
						<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtMotDePasse" id="txtMotDePasse" data-mini="true" placeholder="Mon mot de passe" value="<?php echo $motDePasse; ?>" >
					</div>														
					<div data-role="fieldcontain" data-type="horizontal" data-mini="true" class="ui-hide-label">
						<label for="caseAfficherMdp">Afficher le mot de passe en clair</label>
						<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" data-mini="true" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
					</div>
					<div data-role="fieldcontain" data-mini="true" style="margin-top: 0px; margin-bottom: 0px;">
						<p style="margin-top: 0px; margin-bottom: 0px;">
							<input type="submit" name="btnConnecter" id="btnConnecter" data-mini="true" value="Me connecter">
						</p>
					</div>
				</form>
				
				<p style="margin-top: 0px; margin-bottom: 20px;">
					<a href="index.php?action=DemanderMdp" data-mini="true" data-role="button">J'ai oublié mon mot de passe</a>
				</p>
				
				<p style="margin-top: 0px; margin-bottom: 0px;">
					<a href="index.php?action=DemanderCreationCompte" data-mini="true" data-role="button" data-ajax="false">Créer mon compte</a>
				</p>
				
				<?php if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					echo "<p>SESSION['adrMail'] = " . $_SESSION['adrMail'] . "</p>";
					echo "<p>SESSION['motDePasse'] = " . $_SESSION['motDePasse'] . "</p>";
					echo "<p>SESSION['typeUtilisateur'] = " . $_SESSION['typeUtilisateur'] . "</p>";
				} ?>
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeFooter; ?>">
				<h4><?php echo $msgFooter; ?></h4>
			</div>
		</div>
	</body>
</html>