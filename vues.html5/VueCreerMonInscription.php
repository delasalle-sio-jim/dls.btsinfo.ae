<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueCreerMonInscription.php : visualiser le formulaire d'inscription à la soirée
// Ecrit le 02/02/2016 par Nicolas Esteve
// Modifié le 24/05/2016
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

					<p>
						<label for="txtNbPlaces">Nombre de places  :</label>
						<input type="number"  name="txtNbPlaces" id="txtNbPlaces" pattern="^[0-9]{2}$" maxlength="30" value="1" required/>
					</p>
					<p>
						<label class ="label2" for="txtNbPlaces">En cochant cette case vous vous vous engagez a payer <?php echo $tarif ?> euros par places réservées. </label>
						<input type="checkbox" requiered name="validation" id="validation" maxlength="30"  required/>	
						<label class ="label2" for="txtNbPlaces"> Vous pouvez payer en avance en envoyant un chèque au nom d'INPACT(en précisant votre nom) ou payer au moment où vous arrivez à la soirée.	</label>		
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
					<p>
						<label class ="labelImportant"  for="txtNbinformation">Si vous avez déjà fait une reservation celle-ci écrasera la précédente </label>		
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
			<a href="#close" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>