<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueVoirDetailsSoiree.php : visualiser les infos sur la soirée
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
					<li><a href="index.php?action=Menu#menu2" data-ajax="false">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>La prochaine soirée des anciens</h2>
		
			<?php	
			if ($uneSoiree == null )
			{	echo "La prochaine soirée des anciens n'a pas encore été programmée à ce jour !";
			}
			else
			{
				$message = "<p>Bonjour,</p>";
				$message .= "<p>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO ";
				$message .= " (ex BTS IG) du Lycée De La Salle sont conviés.</p>";
										
				if ($uneSoiree->getDateSoiree() != "00-00-0000")
				{	$message .= "<p>Ce repas aura lieu le <b>vendredi " . Outils::convertirEnDateFR($uneSoiree->getDateSoiree()) . " à 20 h</b>";
				}
						
				if ($uneSoiree->getNomRestaurant() != null)
				{	$message .= "<br>au restaurant <b>" . $uneSoiree->getNomRestaurant() . "</b>";		
							
					if ($uneSoiree->getAdresse() != null)
					{	$message .= "<br>situé <b> " . $uneSoiree->getAdresse( ). "</b>.</p>";
					}
					else 
					{	$message .="<br>dont l'adresse est précisée dans le lien ci-joint. </p>";
					}
				}

				if ($uneSoiree->getTarif() != null)
				{	$message .= "<p>Le tarif est de <b>" . $uneSoiree->getTarif() . " euros</b> par personne. </p>";
				}
				
				if ($uneSoiree->getLienMenu() != null)
				{	$message .= '<p>Informations plus détaillées sur le restaurant ou sur les menus proposés : <br> <a target="_blank" href="' . $uneSoiree->getLienMenu() . '".>' . $uneSoiree->getLienMenu() .'</a></p>';
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

</body>
</html>