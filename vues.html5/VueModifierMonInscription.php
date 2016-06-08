<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueModifierMonInscription.php : modifier son inscription à la soirée
// Ecrit le 28/05/2016 par Killian BOUTIN
// Modifié le 06/06/2016 par Killian BOUTIN
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
			<h2>Modification ou annulation de mon inscription</h2>
			<form name="form1" id="form1" action="index.php?action=ModifierMonInscription" method="post">

				<p>La prochaine soirée aura lieu le <b><?php echo $laDateSoiree ?> à 20h </b>au restaurant <b> <?php echo $leRestaurant ?> </b> situé <b> <?php echo $lAdresse ?> </b>.</p>
				
				<p>Le tarif pour cette soirée est de <b> <?php echo $leTarif ?> €</b> par personne. </p>
				
				<p><i>Nombre de places à réserver :</i> <input type="number" style="width:32px;" name="txtNbPlaces" id="txtNbPlaces" pattern="^[0-9]{1,2}$" maxlength="30" min="0" max="10" step="1" value="<?php echo $nbPersonnes; ?>" required/></p>
					
				<p>
					<input type="submit" name="btnModification"  id="btnModification" value="Modifier mon inscription" >
				</p>
				<p>
					<input type="submit" name="btnAnnulation"  id="btnAnnulation" value="Annuler mon inscription" >
				</p>
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
			<a href="<?php echo $lienRetour; ?>" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>