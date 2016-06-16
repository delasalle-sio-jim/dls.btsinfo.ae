<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueGererPhotos.php : permet de gérer la galerie
	// Ecrit le 15/06/2016 par Killian BOUTIN 
?>
<!doctype html>

<head>	
	<?php include_once ('head.php'); ?>
	<script>
		window.onload = initialisations;
		
		function initialisations() {

			<?php if ($typeMessage == 'avertissement') { ?>
				afficher_avertissement("<?php echo $message; ?>");
			<?php } ?>
			
			<?php if ($typeMessage == 'information') { ?>
				afficher_information("<?php echo $message; ?>");
			<?php } ?>
		}
		
		function afficher_information(msg) {
			document.getElementById("titre_message").innerHTML = "Information...";
			document.getElementById("titre_message").className = "classe_information";
			document.getElementById("texte_message").innerHTML = msg;
			window.open ("#affichage_message", "_self");
		}
		function afficher_avertissement(msg) {
			document.getElementById("titre_message").innerHTML = "Avertissement...";
			document.getElementById("titre_message").className = "classe_avertissement";
			document.getElementById("texte_message").innerHTML = msg;
			window.open ("#affichage_message", "_self");
		}
	
	</script>
	
</head> 
<body>
	<div id="page">
	
		<div id="header">
			<div id="header-menu">
				<ul id="menu-horizontal">
					<li><a href="index.php?action=Menu#menu3" data-ajax="false">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>Modifier la galerie photo</h2>
			
			<h3>Vous pouvez ajouter, modifier ou supprimer des photos de classe :</h3>
		
			<table class="tableau">
				<!-- affichage ligne d'entête colorée en vert (success)-->
				<thead>
					<tr>
						<th>Photo</th>
						<th>Promo</th>
						<th>Classe</th>
						<th>Modifier</th>
						<th>Supprimer</th>
					</tr>
				</thead>
					<!-- Pour chaque image, on ajoute une nouvelle ligne dans le tableau -->
					<?php foreach ($lesImages as $uneImage){?>
					<tr>
						<td><a href="images/galerie/<?php echo $uneImage->getLien(); ?>"><img src="photos.700/<?php echo $uneImage->getLien(); ?>" alt="Photo" width= 400px height= 200px;/></a></td>
						<td><?php echo $uneImage->getPromo(); ?></td>
						<td><?php echo $uneImage->getClasse(); ?></td>
						<td><a href="index.php?action=AjouterModifierPhoto&actionGalerie=modifier&id=<?php echo $uneImage->getId() ?>"><img src="images.galerie/edit.png" alt="Modifier"></a></td>
						<td><a href="index.php?action=GererPhotos&actionGalerie=supprimer&id=<?php echo $uneImage->getId() ?>"><img src="images.galerie/remove.png" alt="Supprimer"></a></td>
					</tr>
					<?php } ?>
							
					<tr>
						<td>Ajouter une photo de classe</td>
						<td></td>
						<td></td>
						<td></td>
						<td><a href="index.php?action=AjouterModifierPhoto&actionGalerie=ajouter"><img src="images.galerie/ajout.png" alt="Ajouter"/></a></td>
					</tr>
			</table>
		</div>
				
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>
	
	<aside id="affichage_message" class="classe_message">
		<div>
			<h2 id="titre_message" class="classe_information">Message</h2>
			<p id="texte_message" class="classe_texte_message">Texte du message</p>
			<a href="<?php echo $lienRetour; ?>" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>