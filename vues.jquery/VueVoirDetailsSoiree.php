<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueVoirDetailsSoiree.php : visualiser les infos sur la soirée
	// Ecrit le 06/01/2016 par Nicolas Esteve
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
	</head> 
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
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
					<p>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO (ex BTS IG) du Lycée De La Salle y sont conviés.</p>
					<p>Cette soirée vous permettra de retrouver vos camarades et vos professeurs préférés. À l'image des précédents repas, elle vous permettra également de faire connaissance avec les nouveaux élèves.
					<p>Ce repas aura lieu le <b>vendredi <?php echo $laDateSoiree ?> à 20 h</b>	au restaurant <b> <?php echo $leRestaurant ?> </b> situé <b> <?php echo $lAdresse ?> </b>.</p>
					<p>Le tarif est de <b> <?php echo $leTarif ?> €</b> par personne. </p>
					<p>Informations plus détaillées sur le restaurant ou sur les menus proposés sur <a target="_blank" href=" <?php echo $leLienMenu  ?>">le site de <?php echo $leRestaurant ?></a>.</p>
					<p>Dans l'espoir de vous voir à cette soirée,<br/><br/>Cordialement,<br/>L'équipe d'INPACT</p>
				<?php } ?>
				
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>