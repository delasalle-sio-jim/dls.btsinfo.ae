<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 6/1/2016 par Nicolas Esteve
	// Modifié le 18/5/2016 par Jim
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
			<h2>Les données de la soirée</h2>
		
			<?php	
			if ($Soiree == null )
			{	echo " Aucun détail a propos de la soirée n'a encore été décidé";
			}
			else
			{
				$message = "<p>Bonjour,</p>";
				$message .= "<p>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO ";
				$message .= " (ex BTS IG) du Lycée De La Salle sont conviés.</p>";
										
				if ($Soiree->getDateSoiree() != "00-00-0000")
				{	$message .= "<p>Ce repas aura lieu le <b>vendredi " . Outils::convertirEnDateFR($Soiree->getDateSoiree()) . " à 20 h</b>";
				}
						
				if ($Soiree->getNomRestaurant() != null)
				{	$message .= "<br>au restaurant <b>" . $Soiree->getNomRestaurant() . "</b>";		
							
					if ($Soiree->getAdresse() != null)
					{	$message .= "<br>dont les coordonnées sont :<b> " . $Soiree->getAdresse( ). "</b>.</p>";
					}
					else 
					{	$message .="<br>dont les coordonnées sont précisées dans le lien ci-joint. </p>";
					}
				}
				
				if ($Soiree->getLienMenu() != null)
				{	$message .= '<p>Vous pouvez vous renseigner sur les menus proposés à l\'aide de ce lien : <br> <a target="_blank" href="' . $Soiree->getLienMenu() . '".>' . $Soiree->getLienMenu() .'</a></p>';
				}
						
				if ($Soiree->getTarif() != null)
				{	$message .= "<p>Le prix prévu pour la soirée est de <b>" . $Soiree->getTarif() . " euros</b>. </p>";
				}
						
				$message .= "<p>Dans l'espoir de vous voir à cette soirée,<br/><br/>Cordialement,<br/>L'équipe d'INPACT</p>";
				echo $message;
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