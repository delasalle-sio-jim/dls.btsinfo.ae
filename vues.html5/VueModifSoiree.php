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
						<input type="text" name="txtDate" id="txtDate"  patern="" placeholder="Date de la soirée" required value="<?php if(isset($Soiree)) echo Outils::convertirEnDateFR($Soiree->getDate()); else echo "";?>" >
					</p>
					<p>
						<label for="txtNomRestaurant">Nom du restaurant:</label>
						<input type="text" name="txtNomRestaurant" id="txtNomRestaurant" maxlength="50" placeholder="Nom du restaurant" required value="<?php if(isset($Soiree)) echo $Soiree->getNomRestaurant(); else echo "";?>" >
					</p>
					<p>
						<label for="txtNom">adressse du restaurant :</label>
						<input type="text" name="txtAdresse" id="txtAdresse" maxlength="50" placeholder="L'adresse du restautant" required value="<?php if(isset($Soiree)) echo $Soiree->getAdresse(); else echo "";?>" >
					</p>
					<p>
						<label for="txtTarif">Tarif:</label>
						<input type="text" name="txtTarif" id="txtTarif" maxlength="8" placeholder="Tarif" required value="<?php if(isset($Soiree)) echo $Soiree->getTarif(); else echo "";?>" >
					</p>
					<p>
						<label for="txtLienMenu"> Lien vers le Menu du site du restaurant:</label>
						<input type="text" name="txtLienMenu" id="txtLienMenu" maxlength="100" placeholder="Lien vers le menu du restaurant" required value="<?php if(isset($Soiree)) echo $Soiree->getLienMenu(); else echo "";?>" >
					</p>
					<p>
						<label for="txtLatitude">Latitude:</label>
						<input type="text" name="txtLatitude" id="txtLatitude" maxlength="20" placeholder="Latitude" required value="<?php if(isset($Soiree)) echo $Soiree->getLatitude(); else echo "";?>" >
					</p>
					<p>
						<label for="txtLongitude">Longitude:</label>
						<input type="text" name="txtLongitude" id="txtLongitude" maxlength="20" placeholder="Longitude" required value="<?php if(isset($Soiree)) echo $Soiree->getLongitude(); else echo "";?>" >
					</p>			
					<p>
						<input type="submit" name="btnModifier" id="btnModifier" value="Changer les données de la soirée">
					</p>
				</table>
			</form>
				<table>
				
			<?php if($Soiree->getDate() !== null)
					{
					
						
					 }
				else ?>
				<?php if($Soiree->getNomRestaurant() !== null)
					{
				
						
					 }
				else ?>
				<?php if($Soiree->getAdresse() !== null)
					{
				
						
					}
				else ?>
				<?php if($Soiree->getTarif() !== null)
					{
				
					}
				else ?>
				
				
				
				
				
				
				
				
				
				
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