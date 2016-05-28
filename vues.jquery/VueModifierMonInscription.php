<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.jquery/VueModifierMonInscription.php : modifier son inscription à la soirée
// Ecrit le 28/05/2016 par Killian BOUTIN

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
				<a href="index.php?action=Menu#menu2" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Inscription à la soiree</h4>
				<form action="index.php?action=ModifierMonInscription" method="post" data-ajax="false" >
				
					<div data-role="fieldcontain">
						<label class ="label2" for="txtNbPlaces">Nombre de places  :</label>
						<input type="number"  name="txtNbPlaces" id="txtNbPlaces" pattern="^[0-9]{2}$" maxlength="30" value="<?php echo $nbPersonnes ?>" required/>
					</div>
					
						<label class ="label2" for="validation">En cochant cette case vous vous vous engagez a payer <?php echo $unTarif ?> euros par places réservées. </label>
					
					<div data-role="fieldcontain">
						<input type="checkbox" required name="validation" id="validation" maxlength="30"  required/>	
					</div> 
					<div data-role="fieldcontain">
						<label class ="label2" for="txtNbPlaces"> Vous pouvez payer en avance en envoyant un chèque au nom d'INPACT(en précisant votre nom) ou payer au moment où vous arrivez à la soirée.	</label>		
					</div>
					
					<?php if(! empty ($unTarif))
					{?>
					<p>
						<label class="label2" for="txtTarif">Le prix pour une place est de <?php echo $unTarif ?> euros</label>
						
					</p>
					<?php }
					else 
					{?>
					<p>
						<label class="label2" for="txtTarif">Le prix pour la soirée n'a pas été fixé</label>
						
					</p>
					<?php }?>
					<p>
						<input type="submit" name="btnModification"  id="btnModification" value="Modifier mon inscription" >
					</p>
					<p>
						<input type="submit" name="btnAnnulation"  id="btnAnnulation" value="Annuler mon inscription" >
					</p>
				</form>
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>

		<div data-role="dialog" id="affichage_message" data-close-btn="none">
			<div data-role="header" data-theme="<?php echo $themeFooter; ?>">
				<?php if ($typeMessage == 'avertissement') { ?>
					<h3>Avertissement...</h3>
				<?php } ?>
				<?php if ($typeMessage == 'information') { ?>
					<h3>Information...</h3>
				<?php } ?>
			</div>
			<div data-role="content">
				<p style="text-align: center;">
				<?php if ($typeMessage == 'avertissement') { ?>
					<img src="images/avertissement.png" class="image" />
				<?php } ?>
				
				<?php if ($typeMessage == 'information') { ?>
					<img src="images/information.png" class="image" />
				<?php } ?>
				</p>
				<p style="text-align: center;"><?php echo $message; ?></p>
			</div>
			
			<!-- au clic sur "Fermer" on renvoi sur le menu afin de montrer le nouveau menu -->
			<div data-role="footer" class="ui-bar" data-theme="<?php echo $themeFooter; ?>">
				<a onclick="myFunction()" data-transition="<?php echo $transition; ?>">Fermer</a>
				
				<script>
					function myFunction() {
						 location.replace("index.php?action=Menu#menu2");
					}
				</script>
			</div>
		</div>
		
	</body>
</html>