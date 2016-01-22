<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 6/1/2016 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php');?>
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
		
			<?php	
			if($Soiree->getDate() !== "00-00-0000"  ||$Soiree->getNomRestaurant() !== null  ||$Soiree->getAdresse() !== null  ||$Soiree->getLienMenu() !== null  ||$Soiree->getTarif() !== null )
			{
			$message =	"Bonjour,<br/>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO (ex BTS IG) du Lycée De La Salle sont conviés.<br/>";
					
				
				if($Soiree->getDate() !== "00-00-0000")
						{
							$message .="Ce repas aura lieu le vendredi  ".Outils::convertirEnDateFR($Soiree->getDate()) ."  à 20h ";
						}
						
				if($Soiree->getNomRestaurant() !== null)
						{
							$message .= "au restaurant ".$Soiree->getNomRestaurant();
							
							
					if($Soiree->getAdresse() !== null)
							{
								$message .= " dont les coordonnées sont :<br/> ".$Soiree->getAdresse().". <br/>";
							}
							else 
							{
								$message .="dont les coordonnées sont précisées dans le lien ci-joint. <br/>";
							}
						}
				if($Soiree->getLienMenu() !== null)
						{
							$message.= "Vous pouvez vous renseigner sur les menus proposé à l'aide de ce lien : <br/> ".$Soiree->getLienMenu().". <br/>";
						}
						
				if($Soiree->getTarif() !== null)
						{
							$message.= "Le prix prévu pour la soirée est de : ".$Soiree->getTarif()."euros. <br/> <br/>";
						}
						
					$message .= " Dans l'espoir de vous voir à cette soirée,<br/><br/>\t Cordialement,<br/>\t L'équipe d'INPACT";
					echo $message;
			}
			else
			{
				echo " Aucun détail a propos de la soirée n'a encore été décidé";
			}
				?>
			
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