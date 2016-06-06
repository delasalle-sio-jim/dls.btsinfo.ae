<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueVoirDetailsSoiree.php : visualiser les infos sur la soirée
	// Ecrit le 6/1/2016 par Nicolas Esteve
	// Modifié le 06/06/2016 par Killian BOUTIN
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php');?>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript">

	// Fonction qui permet d'afficher la carte au chargement de la page
	function initialize() {
		var latlng = new google.maps.LatLng(<?php echo $laLatitude ?>, <?php echo $laLongitude ?>);
		
		var myOptions = {
			zoom: 19,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.HYBRID // ROADMAP pour le plan ; SATELLITE pour les photos satellite ; HYBRID pour afficher les photos satellites avec le plan superposé ; TERRAIN pour afficher les reliefs
		}
		
		var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
		var contentString = "<b><?php echo $leRestaurant ?></b><br><?php echo $lAdresse ?>";
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString,
			maxWidth: 200
	  	});
	  	
		var marker = new google.maps.Marker({
			position: latlng,
			map: map
		});
		
		marker.addListener('click', function() {
			infowindow.open(map, marker);
		});
		
	} 
	</script>
</head> 
<body onload="initialize()">
	<div id="page">
	
		<div id="header">
			<div id="header-menu">
				<ul id="menu-horizontal">
					<li><a href="index.php?action=Menu#menu2" data-ajax="false">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>La prochaine soirée des anciens</h2>
				
				<?php 
				if ($uneSoiree == null ){ ?>
					<p>La prochaine soirée des anciens n'a pas encore été programmée à ce jour !</p>
				<?php }
				else{ ?>
					<p>Bonjour,</p>
					<p>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO (ex BTS IG) du Lycée De La Salle y sont conviés.</p>
					<p>Cette soirée vous permettra de retrouver vos camarades et vos professeurs préférés. À l'image des précédents repas, elle vous permettra également de faire connaissance avec les nouveaux élèves.
					<p>Ce repas aura lieu le <b>vendredi <?php echo $laDateSoiree ?> à 20 h</b><br>	au restaurant <b> <?php echo $leRestaurant ?> </b><br>
					 situé <b> <?php echo $lAdresse ?> </b>.</p>
					<p>Le tarif est de <b> <?php echo $leTarif ?> €</b> par personne. </p>
					<p>Informations plus détaillées sur le restaurant<br>
					ou sur les menus proposés sur <a target="_blank" href=" <?php echo $leLienMenu  ?>">le site de <?php echo $leRestaurant ?></a>.</p>
					<p>Dans l'espoir de vous voir à cette soirée,<br/><br/>Cordialement,<br/>L'équipe d'INPACT</p>
				<?php } ?>
				
				<div id="map_canvas"></div>
					
			</div>
		
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>

</body>
</html>