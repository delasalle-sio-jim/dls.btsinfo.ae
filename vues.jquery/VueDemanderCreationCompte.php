<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueDemanderCreationCompte.php : visualiser la vue de création de compte élève
	// Ecrit le 17/11/2015 par Jim
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
				<a href="index.php?action=Deconnecter">Accueil</a>
			</div>
			
			<div data-role="content">
				<div data-role="collapsible-set">
					<div data-role="collapsible">
						<h3>Avertissement...</h3>
						<p>Après vérification de votre demande par les administrateurs de l'annuaire (cette opération peut prendre quelques jours éventuellement),
						 vous recevrez un mail de confirmation avec votre mot de passe (que vous pourrez ensuite modifier).</p>
					</div>
										
					<div data-role="collapsible" data-collapsed="false">
						<h3>Créer mon compte</h3>
							<form name="form1" id="form1" action="index.php?action=DemanderCreationCompte" method="post">
								<div data-role="fieldcontain" class="ui-hide-label">
									<label for="txtNom">Nom (de naissance) :</label>
									<input type="text" name="txtNom" id="txtNom" placeholder="Nom (de naissance)" value="<?php echo $nom; ?>">

									<label for="txtPrenom">Prénom :</label>
									<input type="email" name="txtPrenom" id="txtPrenom" placeholder="Prénom" value="<?php echo $prenom; ?>">
								</div>

								
								
								
								
								
								
								
								<div data-role="fieldcontain">
									<input type="submit" value="Envoyer les données" name="btnEnvoyer" id="btnEnvoyer">
								</div>
							</form>
					</div>

				</div>
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeFooter; ?>">
				<h4><?php echo $message; ?></h4>
			</div>
		</div>
	</body>
</html>