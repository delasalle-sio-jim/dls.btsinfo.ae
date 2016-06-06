<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueCreerMonInscription.php : visualiser le formulaire d'inscription à la soirée
// Ecrit le 02/02/2016 par Nicolas Esteve
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
			<h2>Inscription à la soirée</h2>
			<form name="form1" id="form1" action="index.php?action=CreerMonInscription" method="post">
			
				<p>La prochaine soirée aura lieu le <b>vendredi <?php echo $laDateSoiree ?> à 20h </b>au restaurant <b> <?php echo $leRestaurant ?> </b> situé <b> <?php echo $lAdresse ?> </b>.</p>
				
				<p>Le tarif pour cette soirée est de <b> <?php echo $leTarif ?> €</b> par personne. </p>
				
				<p style="text-align:center;margin-bottom: -8px;"><i>Nombre de places à réserver :</i> <input type="number" style="width:32px;" name="txtNbPlaces" id="txtNbPlaces" pattern="^[0-9]{1,2}$" maxlength="30" min="1" max="10" value="1" step="1" required/></p>
					
				<p><input type="checkbox" required name="validation" id="validation" required> En cochant cette case vous vous vous engagez à régler la somme de <?php echo $leTarif ?> € par place réservée. </p>
				
				<p> Vous pouvez payer en avance en envoyant un chèque au nom d'INPACT (avec l'adresse), en précisant votre nom, ou régler à votre arrivée à la soirée.</p>
						
				<p>
					<input type="submit" name="btnInscription"  id="btnInscription" value="M'inscrire" >
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
			<a href="index.php?action=Menu#menu2" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>