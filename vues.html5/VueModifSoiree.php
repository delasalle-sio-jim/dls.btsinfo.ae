<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 6/1/2016 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php');?>
	<script>
		window.onload = initialisations;
		
		function initialisations() {
			document.getElementById("caseAfficherMdp").onchange = afficherMdp;

			<?php if ($typeMessage == 'avertissement') { ?>
				afficher_avertissement("<?php echo $message; ?>");
			<?php } ?>
			
			<?php if ($typeMessage == 'information') { ?>
				afficher_information("<?php echo $message; ?>");
			<?php } ?>
		}
		
		function afficherMdp()
		{	if (document.getElementById("caseAfficherMdp").checked == true)
			{	document.getElementById("txtNouveauMdp").type="text";
				document.getElementById("txtConfirmationMdp").type="text";
			}
			else
			{	document.getElementById("txtNouveauMdp").type="password";
				document.getElementById("txtConfirmationMdp").type="password";
			}
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
					<li><a href="index.php?action=Menu" data-ajax="false">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>Changer les données de la soirée</h2>
			<form name="form1" id="form1" action="index.php?action=ModifSoiree" method="post">
				<table>
					<p>
						<label for="txtDate">Date de la soirée :</label>
						<input type="text	" name="txtDate" id="txtDate"  pattern="^[0-9]{2}(/)[0-9]{2}(/)[0-9]{4}$" placeholder="Date de la soirée"  value="<?php if(isset($Soiree)) echo Outils::convertirEnDateFR($Soiree->getDate()); else echo "";?>" >
					</p>
					<p>
						<label for="txtNomRestaurant">Nom du restaurant:</label>
						<input type="text" name="txtNomRestaurant" id="txtNomRestaurant" maxlength="50" placeholder="Nom du restaurant" value="<?php if(isset($Soiree)) echo $Soiree->getNomRestaurant(); else echo "";?>" >
					</p>
					<p>
						<label for="txtNom">adressse du restaurant :</label>
						<input type="text" name="txtAdresse" id="txtAdresse" maxlength="50" placeholder="L'adresse du restautant"  value="<?php if(isset($Soiree)) echo $Soiree->getAdresse(); else echo "";?>" >
					</p>
					<p>
						<label for="txtTarif">Tarif :</label>
						<input type="text" name="txtTarif" id="txtTarif" maxlength="8" placeholder="Tarif"  value="<?php if(isset($Soiree)) echo $Soiree->getTarif(); else echo "";?>" >
					</p>
					<p>
						<label for="txtLienMenu"> Lien vers le Menu du site du restaurant :</label>
						<input type="text" name="txtLienMenu" id="txtLienMenu" maxlength="100" placeholder="Lien vers le menu du restaurant"  value="<?php if(isset($Soiree)) echo $Soiree->getLienMenu(); else echo "";?>" >
					</p>
					<p>
						<label for="txtLatitude">Latitude :</label>
						<input type="text" name="txtLatitude" id="txtLatitude" maxlength="20" placeholder="Latitude" value="<?php if(isset($Soiree)) echo $Soiree->getLatitude(); else echo "";?>" >
					</p>
					<p>
						<label for="txtLongitude">Longitude :</label>
						<input type="text" name="txtLongitude" id="txtLongitude" maxlength="20" placeholder="Longitude"  value="<?php if(isset($Soiree)) echo $Soiree->getLongitude(); else echo "";?>" >
					</p>			
					<p>
						<input type="submit" name="btnModifier" id="btnModifier" value="Changer les données de la soirée">
					</p>
				</table>
			</form>
				<table>
				
			<?php	
			if($Soiree->getDate() !== null  ||$Soiree->getNomRestaurant() !== null  ||$Soiree->getAdresse() !== null  ||$Soiree->getLienMenu() !== null  ||$Soiree->getTarif() !== null )
			{
			$message =	"Bonjour,<br/>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO (ex BTS IG) du Lycée De La Salle sont conviés.<br/>";
					
				
				if($Soiree->getDate() !== "00/00/0000")
						{
							$message .="Ce repas aura lieu le vendredi  ".Outils::convertirEnDateFR($Soiree->getDate()) ."  à 20h ";
						}
						
				if($Soiree->getNomRestaurant() !== "")
						{
							$message .= "au restaurant ".$Soiree->getNomRestaurant();
							
							
					if($Soiree->getAdresse() !== "")
							{
								$message .= " dont les coordonnées sont :<br/> ".$Soiree->getAdresse().". <br/>";
							}
							else 
							{
								$message .="dont les coordonnées sont précisées dans le lien ci-joint. <br/>";
							}
						}
				if($Soiree->getLienMenu() !== "")
						{
							$message.= "Vous pouvez vous renseigner sur les menus proposé à l'aide de ce lien : <br/> ".$Soiree->getLienMenu().". <br/>";
						}
						
				if($Soiree->getTarif() !== "0")
						{
							$message.= "Le prix prévu pour la soirée est de : ".$Soiree->getTarif()." euros. <br/> <br/>";
						}
						
					$message .= " Dans l'espoir de vous voir à cette soirée,<br/><br/>\t Cordialement,<br/>\t L'équipe d'INPACT";
					echo $message;
			}
			else
			{
				echo " Aucun détail a propos de la soirée n'a encore été décidé";
			}
				?>

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
			<a href="#close" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>