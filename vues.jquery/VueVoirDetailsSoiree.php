<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueVoirDetailsSoiree.php : visualiser les infos sur la soirée
	// Ecrit le 6/1/2016 par Nicolas Esteve
	// Modifié le 26/05/2016 par Killian BOUTIN
	
/* A MODIFIER !!! ENLEVER TOUTES LES VARIABLES MESSAGE ET METTRE DANS LE CONTROLEUR */
	
	// pour obliger la page à se recharger
	header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Pragma: no-cache');
	header('Content-Tranfer-Encoding: none');
	header('Expires: 0');
?>
<!doctype html>
<html>
	<head>	
		<?php include_once ('vues.jquery/head.php'); ?>
	</head> 
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
				<a href="index.php?action=Menu#menu2" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			
			<div data-role="content">
			<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">La prochaine soirée des anciens</h4>
			
			<?php	
			if ($uneSoiree == null )
			{	echo "La prochaine soirée des anciens n'a pas encore été programmée à ce jour !";
			}
			else
			{
				$message = "<p>Bonjour,</p>";
				$message .= "<p>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO ";
				$message .= " (ex BTS IG) du Lycée De La Salle sont conviés.</p>";
										
				$message .= "<p>Ce repas aura lieu le <b>vendredi " . Outils::convertirEnDateFR($uneSoiree->getDateSoiree()) . " à 20 h</b><br>";
	
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
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>