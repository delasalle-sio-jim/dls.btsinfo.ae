<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 24/11/2015 par Jim
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
				<div data-role="collapsible-set">
					<div data-role="collapsible">
						<h3>Bienvenue sur l'annuaire des anciens élèves...</h3>
						<p>L'annuaire des anciens élèves du <b>BTS Informatique</b> du <b>Lycée De La Salles</b> (Rennes) vous propose les services suivants :</p>
						<ul>
							<li>Formulaire d'inscription à la soirée des anciens</li>
							<li>Consultation de la liste des anciens déjà inscrits à la soirée des anciens</li>
							<li>Outil de recherche d'anciens élèves inscrits à l'annuaire</li>
							<li>Consultation de galeries photos</li>
						</ul>
					</div>
								
					<div data-role="collapsible">
						<h3>Créer mon compte</h3>
						<p>Si vous n'avez pas encore de compte, commencez par le créer.</p>
						<p>Après vérification de votre demande par les administrateurs de l'annuaire (cette opération peut prendre quelques jours éventuellement),
						 vous recevrez un mail de confirmation avec votre mot de passe (que vous pourrez ensuite modifier).</p>
						<p style="margin-top: 0px; margin-bottom: 0px;">
							<a href="index.php?action=DemanderCreationCompte" data-role="button" data-ajax="false">Créer mon compte</a>
						</p>
					</div>

					<div data-role="collapsible" <?php if($divConnecterDepliee == true) echo ('data-collapsed="false"'); ?>>
						<h3>Accéder à mon compte</h3>
						<form name="form1" id="form1" action="index.php?action=Connecter" method="post" data-transition="<?php echo $transition; ?>">
							<div data-role="fieldcontain" class="ui-hide-label">
								<label for="txtAdrMail">Adresse mail :</label>
								<input type="text" name="txtAdrMail" id="txtAdrMail" placeholder="Mon adresse mail" value="<?php echo $adrMail; ?>" >
		
								<label for="txtMotDePasse">Mot de passe :</label>
								<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtMotDePasse" id="txtMotDePasse" placeholder="Mon mot de passe" value="<?php echo $motDePasse; ?>" >
							</div>														
							<div data-role="fieldcontain" data-type="horizontal" data-mini="true" class="ui-hide-label">
								<label for="caseAfficherMdp">Afficher le mot de passe en clair</label>
								<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
							</div>
							<div data-role="fieldcontain" data-mini="true" style="margin-top: 0px; margin-bottom: 0px;">
								<p style="margin-top: 0px; margin-bottom: 0px;">
									<input type="submit" name="btnConnecter" id="btnConnecter" value="Me connecter">
								</p>
							</div>
						</form>
					</div>
					
					<div data-role="collapsible" <?php if($divDemanderMdpDepliee == true) echo ('data-collapsed="false"'); ?>>
						<h3>J'ai oublié mon mot de passe</h3>
						<p>Cette option permet de regénérer un nouveau mot de passe qui vous sera immédiatement envoyé par mail. Nous vous conseillons de le changer aussitôt.</p>
						<form name="form2" id="form2" action="index.php?action=DemanderMdp" method="post">
							<div data-role="fieldcontain" class="ui-hide-label">
								<label for="txtAdrMail2">Adresse mail :</label>
								<input type="text" name="txtAdrMail2" id="txtAdrMail2" placeholder="Mon adresse mail" value="<?php echo $adrMail; ?>" >
							</div>														
							<div data-role="fieldcontain" data-mini="true" style="margin-top: 0px; margin-bottom: 0px;">
								<p style="margin-top: 0px; margin-bottom: 0px;">
									<input type="submit" name="btnConnecter2" id="btnConnecter2" value="Obtenir un nouveau mot de passe">
								</p>
							</div>
						</form>
					</div>

				</div>
												
				<?php if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					echo "<p>SESSION['adrMail'] = " . $_SESSION['adrMail'] . "</p>";
					echo "<p>SESSION['motDePasse'] = " . $_SESSION['motDePasse'] . "</p>";
					echo "<p>SESSION['typeUtilisateur'] = " . $_SESSION['typeUtilisateur'] . "</p>";
				} ?>
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeFooter; ?>">
				<h4><?php echo $message; ?></h4>
			</div>
		</div>
	</body>
</html>