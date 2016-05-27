<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue VueCreerMonInscription.php : visualiser le formulaire d'inscription à la soirée
// Ecrit le 02/02/2016 par Nicolas Esteve
// Modifié le 25/05/2016 par Killian BOUTIN

// Ligne 48 : => <label class ="label2" for="txtNouveauMdp"> <= ?????????? (Killian)
	
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
				
				<?php if ($eleveInscrit == null){ ?>
					<form action="index.php?action=CreerMonInscription" method="post" data-ajax="false" >
					
						<div data-role="fieldcontain">
							<label class ="label2" for="txtNbPlaces">Nombre de places  :</label>
							<input type="number"  name="txtNbPlaces" id="txtNbPlaces" pattern="^[0-9]{2}$" maxlength="30" value="1" required/>
						</div>
						
							<label class ="label2" for="txtNouveauMdp">En cochant cette case vous vous vous engagez a payer <?php echo $tarif ?> euros par places réservées. </label>
						
						<div data-role="fieldcontain">
							<input type="checkbox" required name="validation" id="validation" maxlength="30"  required/>	
						</div> 
						<div data-role="fieldcontain">
							<label class ="label2" for="txtNbPlaces"> Vous pouvez payer en avance en envoyant un chèque au nom d'INPACT(en précisant votre nom) ou payer au moment où vous arrivez à la soirée.	</label>		
						</div>
						
						<?php if(! empty ($tarif))
						{?>
						<p>
							<label class="label2" for="txtTarif">Le prix pour une place est de <?php echo $tarif ?> euros</label>
							
						</p>
						<?php }
						else 
						{?>
						<p>
							<label class="label2" for="txtTarif">Le prix pour la soirée n'a pas été fixé</label>
							
						</p>
						<?php }?>
						<p>
							<input type="submit" name="btnInscription"  id="btnInscription" value="S'inscrire" >
						</p>
					</form>
				<?php }
				else{ ?>
					Vous êtes déjà inscrit à la soirée. Si vous souhaitez modifier votre inscription, merci de vous rendre sur <a href=index.php?action=ModifierMonInscription >cette page</a>
				<?php } ?>
				
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
			
			<!-- au clic sur "Fermer" on reload la page afin de re-vérifier si il possède une inscription (ce qui est le cas après le clic sur le bouton "S'inscrire" -->
			<div data-role="footer" class="ui-bar" data-theme="<?php echo $themeFooter; ?>">
				<a onclick="myFunction()" data-transition="<?php echo $transition; ?>">Fermer</a>
				
				<script>
					function myFunction() {
					    location.reload()
					}
				</script>
			</div>

		</div>
		
		
	</body>
</html>