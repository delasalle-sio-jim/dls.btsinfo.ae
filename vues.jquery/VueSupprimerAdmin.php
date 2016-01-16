<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueChangerDeMdp.php : visualiser la demande de suppression d'administrateur
	// Ecrit le 06/01/2016 par Nicolas Esteve
	
	// pour obliger la page à se recharger
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Pragma: no-cache');
	header('Content-Tranfer-Encoding: none');
	header('Expires: 0');
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
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Supprimer un administrateur</h4>
				<form action="index.php?action=SupprimerAdmin" method="post" data-ajax="false" >
				
					<div data-role="fieldcontain" class="ui-hide-label">
						<label for="txtAdrMailAdmin">Adresse mail de l'administrateur à supprimer :</label>
						<input type="text" name="txtAdrMailAdmin" id="txtAdrMailAdmin" class="normal" value="<?php if($etape == 1 ) echo $txtMailAdmin ; else echo '' ?>" placeholder="Adresse mail de l'administrateur à supprimer" required>
					</div>
					
					<div data-role="fieldcontain">
						<input type="submit" name="btnDetailAdmin"  id="btnDetailAdmin" value="Obtenir les details sur l'administrateur">
					</div>
					
					
					<?php if ($etape == 1)	
						{?> 
					
					<div data-role="fieldcontain">
						<label for="txtAdrMailAdmin">Prénom de l'administrateur  :<?php echo $prenomAdmin ?></label>
					</div>
					
					<div data-role="fieldcontain">
						<label for="txtAdrMailAdmin">Nom de l'administrateur :<?php echo $nomAdmin ?></label>
					</div>
					
					<div data-role="fieldcontain">
						<label>Adresse mail de l'administrateur :<?php echo $txtMailAdmin ?></label>
					</div>
					
					<div data-role="fieldcontain">
						<label for="txtAdrMailAdmin">Entrez le mail de l'administrateur pour confimer la suppression de celui-ci :</label>
						<input type="text" name="txtAdrMailAdmin2" id="txtAdrMailAdmin" placeholder="Adresse mail de l'administrateur a supprimer" required>
					</div>
					
					<div data-role="fieldcontain" class="ui-hide-label">
					<input type="submit" name="btnSupprimerAdmin"  id="btnSupprimerAdmin" value="Supprimer Administrateur">
					</div>
				</form>
						
				<?php } ?>
				<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
					<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
				</div>
			</div>
		</div>
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		</body>
</html>