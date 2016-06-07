<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueVoirDetailsSoiree.php : visualiser les infos sur la soirée
	// Ecrit le 06/01/2016 par Nicolas Esteve
	// Modifié le 07/06/2016 par Killian BOUTIN
	
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
		
		<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<script>
			// Fonction qui permet d'afficher la carte au chargement de la page
			// mettre bind ou on ?
			$(document).on('pageinit','#page_principale', function() {
				var latlng = new google.maps.LatLng(<?php echo $laLatitude ?>, <?php echo $laLongitude ?>);
				var myOptions = {
						zoom: 19,
						center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
				var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			});		
		</script>
	</head> 
	
	<body>
		<!-- Ajout de data-url pour google maps -->
		<div data-role="page" id="page_principale" data-url="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4><?php echo $titreHeader ?></h4>
				<a href="index.php?action=Menu#menu2" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			
			<div data-role="content">
			<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">La prochaine soirée des anciens</h4>
			
				<?php 
				if ($uneSoiree == null ){ ?>
					La prochaine soirée des anciens n'a pas encore été programmée à ce jour !
				<?php }
				else{ ?>
					<p>Bonjour,</p>
					<p>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO (ex BTS IG) du Lycée De La Salle sont conviés.</p>
					<p>Cette soirée vous permettra de retrouver vos camarades et vos professeurs préférés. À l'image des précédents repas, elle vous permettra également de faire connaissance avec les nouveaux étudiants.
					<p>Ce repas aura lieu le <b> <!-- vendredi --> <?php echo $laDateSoiree ?> à 20 h</b>	au restaurant <b> <?php echo $leRestaurant ?> </b> situé <b> <?php echo $lAdresse ?> </b>.</p>
					<p>Le tarif est de <b> <?php echo $leTarif ?> €</b> par personne. </p>
					<p>Informations plus détaillées sur le restaurant ou sur les menus proposés sur <a target="_blank" href=" <?php echo $leLienMenu  ?>">le site de <?php echo $leRestaurant ?></a>.</p>
					<p>Dans l'espoir de vous voir à cette soirée,<br/><br/>Cordialement,<br/>L'équipe d'INPACT</p>
				<?php } ?>
				
			</div>
			
			<div id="map_canvas">
				Veuillez attendre le chargement de la page...
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>