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
				<?php if ($idInscription == -1){ ?>
					<form name="form1" id="form1" action="index.php?action=CreerMonInscription" method="post">
	
						<p>
							<label class="label2" for="txtNbPlaces">Nombre de places  :</label>
							<input class="label2" type="number"  name="txtNbPlaces" id="txtNbPlaces" pattern="^[0-9]{2}$" maxlength="30" value="1" required/>
						
							<label class ="label2" >En cochant cette case vous vous vous engagez a payer <?php echo $unTarif ?> euros par places réservées. </label>
							<input class ="label2" type="checkbox" required name="validation" id="validation" required>En cochant cette case vous vous vous engagez a payer <?php echo $unTarif ?> euros par places réservées. 
							<label class ="label2" > Vous pouvez payer en avance en envoyant un chèque au nom d'INPACT (en précisant votre nom) ou payer au moment où vous arrivez à la soirée.	</label>		
						</p>
						
						<?php if(! empty ($unTarif))
						{?>
						<p>
							<label class="label2" for="txtTarif">Le prix pour une place est de <?php echo $unTarif ?> euros</label>
							
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
						<!-- A supprimer quand la partie SupprimerMonInscription sera faite -->
						<p>
							<input type="submit" name="btnAnnulation"  id="btnAnnulation" value="Annuler mon inscription" >
						</p>
					</form>
				<?php }
				else{ ?>
					<h3 class="titre_inscription">Vous êtes déjà inscrit à la soirée.<br><br></h3>
					<h3><a href=index.php?action=ModifierMonInscription >- Modifier mon inscription</a><br></h3>
					<h3><a href=index.php?action=SupprimerMonInscription >- Annuler mon inscription</a><br></h3>
					<h3><a href=index.php?action=VoirListeInscritsEleve >- Consulter la liste des inscrits</a><br></h3>
				<?php } ?>
				
				
		</div>
		
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>
	
	<aside id="affichage_message" class="classe_message">
		<div>
			<h2 id="titre_message" class="classe_information">Message</h2>
			<p id="texte_message" class="classe_texte_message">Texte du message</p>
			<a href="" onclick='window.location.reload(false)' title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>