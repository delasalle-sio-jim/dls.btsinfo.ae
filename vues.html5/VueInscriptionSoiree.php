<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueCreerAdmin.php : creer un administrateur
// Ecrit le 26/01/2016 par Nicolas Esteve
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
	<script>
		window.onload = initialisations;
		function calculTarif()
		{
			<?php ?>
		}
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
   	
   <body>
	<div id="page">
	
		<div id="header">
			<div id=header-menu>
				<ul id="menu-horizontal">
					<li><a href="index.php?action=Menu">Retour accueil</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			 		
			<h2>Iscription à la soirée des anciens </h2>
				<form name="form1" id="form1" action="index.php?action=InscriptionSoiree" method="post">

				<p>
					<label for="txtNbPlaces">Nombre de places</label>
					<input type="number"  name="txtNbPlaces" id="txtNbPlaces" maxlength="30" required value="1" required/>
				</p>
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
				
		</div>
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>
	
	<aside id="affichage_message" class="classe_message">
		<div>
			<h2 id="titre_message" class="classe_information">Message</h2>
			<p id="texte_message" class="classe_texte_message">Texte du message</p>
			<form name="form2" id="form2" action="index.php?action=InscriptionSoiree" method="post">
			<p>
			<a href= name="confirmation" onclick="Submit();">Confirmer</a>
			</p>
			<p>
			<a href="#close" title="Fermer">Refuser</a>
			<form name="form1" id="form1" action="index.php?action=InscriptionSoiree" method="post">
			</p>
		</div>
	</aside>
</body>
</html>