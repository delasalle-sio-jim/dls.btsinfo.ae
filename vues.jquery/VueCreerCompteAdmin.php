<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueCreerCompteAdmin.php : visualiser la vue de création de compte administrateur
	// Ecrit le 07/01/2016 par Nicolas Esteve
	// Modifié le 20/5/par Jim
?>
<!doctype html>
<html>
	<head>	
		<?php include_once ('head.php'); ?>
		
		<script>
			<?php if ($typeMessage != '') { ?>
				// associe une fonction à l'événement pageinit
				$(document).bind('pageinit', function() {
					// affiche la boîte de dialogue 'affichage_message'
					$.mobile.changePage('#affichage_message', {transition: "<?php echo $transition; ?>"});
				} );
			<?php } ?>
		</script>
	</head> 
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
				<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Creer un administrateur</h4>
				<form action="index.php?action=CreerAdmin" method="post" data-ajax="false" >
				
					<div data-role="fieldcontain" >
						<label for="txtAdrMailAdmin">Nom :</label>
						<input type="text" name="txtNom" id="txtNom" class="normal" placeholder="Nom de l'administrateur" required>
					</div>
					
					<div data-role="fieldcontain" >
						<label for="txtPrenom">Prenom :</label>
						<input type="text" name="txtPrenom" id="txtPrenom" class="normal" placeholder="Prenom de l'administrateur" required>
					</div>
					
					<div data-role="fieldcontain" >
						<label for="txtAdrMailAdmin">Adresse mail de l'administrateur :</label>
						<input type="text" name="txtAdrMail" id="txtAdrMail" class="normal" placeholder="Adresse mail de l'administrateur " required>
					</div>
										
					<div data-role="fieldcontain">
						<input type="submit" name="btnCreation" id="btnCreation" value="Creer l'Administrateur">
					</div>
					
				</form>
				
				<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
		</div>
			</div>
		</div>
		
		
	</body>
	<?php include_once ('vues.jquery/dialog_message.php'); ?>
</html>