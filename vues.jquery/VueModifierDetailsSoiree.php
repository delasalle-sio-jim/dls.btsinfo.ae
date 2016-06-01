<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueModifierDetailsSoiree : afficher le formulaire de modification des infos sur la soirée
	// Ecrit le 6/1/2016 par Nicolas Esteve
	// Modifié le 01/06/2016 par Killian BOUTIN
	
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
			
		</script>
	</head> 
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
				<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Modifier les détails de la soirée</h4>
				<form action="index.php?action=ModifierDetailsSoiree" method="post" data-ajax="false" >
				<table>
					<p>
						<label for="txtDate">Date de la soirée :</label>
						<input type="text" name="txtDate" id="txtDate"  pattern="^[0-9]{2}(/)[0-9]{2}(/)[0-9]{4}$" required placeholder="Date de la soirée"  value="<?php if(isset($uneSoiree)) echo Outils::convertirEnDateFR($uneSoiree->getDateSoiree()); else echo "";?>" >
					</p>
					<p>
						<label for="txtNomRestaurant">Nom du restaurant:</label>
						<input type="text" name="txtNomRestaurant" id="txtNomRestaurant" maxlength="50" placeholder="Nom du restaurant" value="<?php if(isset($uneSoiree)) echo $uneSoiree->getNomRestaurant(); else echo "";?>" >
					</p>
					<p>
						<label for="txtNom">adressse du restaurant :</label>
						<input type="text" name="txtAdresse" id="txtAdresse" maxlength="50" placeholder="L'adresse du restautant"  value="<?php if(isset($uneSoiree)) echo $uneSoiree->getAdresse(); else echo "";?>" >
					</p>
					<p>
						<label for="txtTarif">Tarif :</label>
						<input type="text" name="txtTarif" id="txtTarif" maxlength="8" placeholder="Tarif"  value="<?php if(isset($uneSoiree)) echo $uneSoiree->getTarif(); else echo "";?>" >
					</p>
					<p>
						<label for="txtLienMenu"> Lien vers le Menu du site du restaurant :</label>
						<input type="text" name="txtLienMenu" id="txtLienMenu" maxlength="100" placeholder="Lien vers le menu du restaurant"  value="<?php if(isset($uneSoiree)) echo $uneSoiree->getLienMenu(); else echo "";?>" >
					</p>
					<p>
						<label for="txtLatitude">Latitude :</label>
						<input type="text" name="txtLatitude" id="txtLatitude" maxlength="20" placeholder="Latitude" value="<?php if(isset($uneSoiree)) echo $uneSoiree->getLatitude(); else echo "";?>" >
					</p>
					<p>
						<label for="txtLongitude">Longitude :</label>
						<input type="text" name="txtLongitude" id="txtLongitude" maxlength="20" placeholder="Longitude"  value="<?php if(isset($uneSoiree)) echo $uneSoiree->getLongitude(); else echo "";?>" >
					</p>			
					<p>
						<input type="submit" name="btnModifier" id="btnModifier" value="Changer les données de la soirée">
					</p>
				</table>
			</form>

		</div>
		
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>