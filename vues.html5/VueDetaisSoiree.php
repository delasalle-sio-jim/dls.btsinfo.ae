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
			$message =	"Bonjour,\n \tComme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO (ex BTS IG) du Lycée De La Salle sont conviés.\n";
					
				
				if($Soiree->getDate() !== null)
						{
							$message .="Ce repas aura lieu le vendredi".$Soiree->getDate()." à 20h ";
						}
						
				if($Soiree->getNomRestaurant() !== null)
						{
							$message .= "au restaurant ".$Soiree->getNomRestaurant();
						}
						
				if($Soiree->getAdresse() !== null)
						{
							$message .= " dont les coordonnées sont ".$Soiree->getAdresse()."\n";
						}
						else 
						{
							$message .="dont les coordonnées sont précisées dans le lien ci-joint. \n";
						}
						
				if($Soiree->getLienMenu() !== null)
						{
							$message.= "Vous pouvez vous renseigner sur les menus proposé à l'aide de ce lien : ".$Soiree->getLienMenu()." \n.";
						}
						
				if($Soiree->getTarif() !== null)
						{
							$message.= "Le prix prévu pour la soirée est de : ".$Soiree->getTarif()."euros \n .";
						}
						
					$message .= 	"Dans l'espoir de vous voir à cette soirée,\n\n\t Cordialement,\n\t L'équipe d'INPACT";
					echo $message;
						
				?>
					
				Bonjour,

Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO (ex BTS IG) du Lycée De La Salle sont conviés.

Ce repas aura lieu le vendredi 16 octobre à 20h au restaurant Le Wok (spécialités asiatiques) dont les coordonnées sont précisées dans le PDF ci-joint.

Merci de répondre avant le 9 octobre,

Dans l'espoir de vous voir à cette soirée,

Cordialement,
L'équipe d'INPACT
				
				
				
				
				
				
				
				
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