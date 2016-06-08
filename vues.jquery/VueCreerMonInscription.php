<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue VueCreerMonInscription.php : visualiser le formulaire d'inscription à la soirée
// Ecrit le 02/02/2016 par Nicolas Esteve
// Modifié le 06/06/2016 par Killian BOUTIN

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
				<h4><?php echo $titreHeader ?></h4>
				<a href="index.php?action=Menu#menu2" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Inscription à la soiree</h4>
				<form action="index.php?action=CreerMonInscription" method="post" data-ajax="false" >
				
					<p>La prochaine soirée aura lieu le <b><?php echo $laDateSoiree ?> à 20h </b>au restaurant <b> <?php echo $leRestaurant ?> </b> situé <b> <?php echo $lAdresse ?> </b>.</p>
					
					<p>Le tarif pour cette soirée est de <b> <?php echo $leTarif ?> €</b> par personne. </p>
					
					<p style="text-align:center;"><i>Nombre de places à réserver :</i> <input type="number" name="txtNbPlaces" id="txtNbPlaces" pattern="^[0-9]{1,2}$" maxlength="30" min="1" max="10" value="1" step="1" required/></p>
					
					<label for="validation">En cochant cette case vous vous vous engagez a payer <?php echo $leTarif ?> euros par place réservée. </label>
					
					<p> Vous pouvez régler à l'avance en envoyant un chèque au nom d'INPACT (Association Inpact, 5 rue de la Motte Brûlon, 35000 Rennes), en précisant votre nom, ou régler à votre arrivée à la soirée.</p>
					
					<div data-role="fieldcontain">
						<input type="checkbox" required name="validation" id="validation" maxlength="30"  required/>	
					</div> 
				
					<p>
						<input type="submit" name="btnInscription"  id="btnInscription" value="S'inscrire" >
					</p>
				</form>				
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>

	</body>
</html>