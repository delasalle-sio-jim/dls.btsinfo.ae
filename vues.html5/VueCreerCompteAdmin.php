<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueCreerCompteAdmin.php : créer un administrateur
// Ecrit le 07/01/2016 par Nicolas Esteve
// Modifié le 25/05/2016 par Killian BOUTIN
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
   	
   <body>
	<div id="page">
	
		<div id="header">
			<div id=header-menu>
				<ul id="menu-horizontal">
					<li><a href="index.php?action=Menu#menu5">Retour menu</a></li>
					<?php include_once 'ReseauxSociaux.php';?>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			 		
			<h2>Création d'un compte administrateur </h2>
			 
			<h3>Entrez les données demandées (tous les champs sont obligatoires) :</h3>
						
			<form name="form1" id="form1" action="index.php?action=CreerCompteAdmin" method="post">

				<p>
					<label for="txtNom">Nom * :</label>
					<input type="text" name="txtNom" id="txtNom" maxlength="30" required value="" required/>
				</p>
				<p>
					<label for="txtPrenom">Prénom * :</label>
					<input type="text" name="txtPrenom" id="txtPrenom" maxlength="30" required value="" required/>
				</p>
				<p>
					<label for="txtAdrMail">Adresse mail * :</label>
					<input type="email" name="txtAdrMail" id="txtAdrMail" maxlength="50" required pattern="^.+@.+\..+$" value="" required/>
				</p>
				<p>
						<input type="submit" name="btnCreation"  id="btnCeation" value="Créer l'administrateur" >
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