<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueModifierDetailsSoiree : afficher le formulaire de modification des infos sur la soirée
	// Ecrit le 6/1/2016 par Nicolas Esteve
	// Modifié le 01/06/2016 par Killian BOUTIN
?>
<!doctype html>
<html>
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
					<li><a href="index.php?action=Menu#menu2" data-ajax="false">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>Exporter les données au format .CSV</h2>
			<form name="form1" id="form1" action="index.php?action=ExporterLesDonnees" method="post">
					
					<label class= "label2">Données des élèves (trié par promo)</label>
					<input class= "label2" type="checkbox" name="export[]" value="EleveParPromo">
					
					<label class= "label2">Données des élèves (trié par nom)</label>
					<input class= "label2" type="checkbox" name="export[]" value="EleveParNom">
					
					<label class= "label2">Liste des inscrits </label>
					<input class= "label2" type="checkbox" name="export[]" value="Inscrits">
					
					<label class= "label2">Liste des non inscrits</label>
					<input class= "label2" type="checkbox" name="export[]" value="NonInscrits">
					
					<div class="ui-widget">
						<input type="submit" name="btnExporter" id="btnExporter" value="Télécharger">
					</div>
			</form>				
		</div>
		
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>
	
	<aside id="affichage_message" class="classe_message">
		<div>
			<h2 id="titre_message" class="classe_information">Message</h2>
			<p id="texte_message" class="classe_texte_message">Texte du message</p>
			<a href="#close" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>