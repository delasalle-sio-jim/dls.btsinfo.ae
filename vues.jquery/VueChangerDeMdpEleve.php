<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueChangerDeMdpEleve.php : visualiser la demande de changement de mot de passe par l'élève
	// Ecrit le 1/12/2015 par Jim
	// Modifié le 03/06/2016 par Killian BOUTIN
	
	// pour obliger la page à se recharger
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Pragma: no-cache');
	header('Content-Tranfer-Encoding: none');
	header('Expires: 0');
?>
<!doctype html>
<html>
	<head>	
		<?php include_once ('vues.jquery/head.php'); ?>
		
		<script>
			<?php if ($typeMessage != '') { ?>
				// associe une fonction à l'événement pageinit
				$(document).bind('pageinit', function() {
					// affiche la boîte de dialogue 'affichage_message'
					$.mobile.changePage('#affichage_message', {transition: "<?php echo $transition; ?>"});
				} );
			<?php } ?>
			
			// associe une fonction à l'événement click sur la case à cocher 'caseAfficherMdp'
			$('#caseAfficherMdp').live('click', function() {
				if ($('#caseAfficherMdp').attr('checked') == true) {
					('#txtNouveauMdp').attr('type', 'text');
					('#txtNouveauMdp').input('refresh');
					('#txtConfirmationMdp').attr('type', 'text');
					('#txtConfirmationMdp').input('refresh');
					//window.alert('true');
				}
				else {
					('#txtNouveauMdp').attr('type', 'password');
					('#txtNouveauMdp').input('refresh');
					('#txtConfirmationMdp').attr('type', 'password');
					('#txtConfirmationMdp').input('refresh');
					//window.alert('false');
				};
			} );
						
			function afficherMdp()
			{	if (document.getElementById("caseAfficherMdp").checked == true)
				{	document.getElementById("txtNouveauMdp").type="text";
					document.getElementById("txtConfirmationMdp").type="text";
					// window.alert('true');
				}
				else
				{	document.getElementById("txtNouveauMdp").type="password";
					document.getElementById("txtConfirmationMdp").type="password";
					// window.alert('false');
				}
			};
		</script>
	</head> 
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4><?php echo $titreHeader ?></h4>
				<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Modifier mon mot de passe</h4>
				<form action="index.php?action=ChangerDeMdpEleve" method="post" data-ajax="false" >
					<p>
						<label for="txtNouveauMdp">Nouveau mot de passe :</label>
						<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtNouveauMdp" id="txtNouveauMdp" placeholder="Mon nouveau mot de passe" required value="<?php echo $nouveauMdp; ?>">
					</p>
					<p>
						<label for="txtConfirmationMdp">Confirmation nouveau mot de passe :</label>
						<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtConfirmationMdp" id="txtConfirmationMdp" placeholder="Confirmation de mon nouveau mot de passe" required value="<?php echo $confirmationMdp; ?>">
					</p>
					<p data-type="horizontal" class="ui-hide-label">
						<label for="caseAfficherMdp">Afficher le mot de passe en clair</label>
						<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" onclick="afficherMdp();" data-mini="true" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
					</p>
					<p>
						<input type="submit" name="btnChangerDeMdp" id="btnChangerDeMdp" value="Envoyer les données" data-mini="true">
					</p>
				</form>

				<?php if($debug == true) {
					// en mise au point, on peut afficher certaines variables dans la page
					echo "<p>nouveauMdp = " . $nouveauMdp . "</p>";
					echo "<p>confirmationMdp = " . $confirmationMdp . "</p>";
					echo "<p>afficherMdp = " . $afficherMdp . "</p>";
					echo "<p>typeMessage = " . $typeMessage . "</p>";
					echo "<p>message = " . $message . "</p>";
				} ?>
				
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
	
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>