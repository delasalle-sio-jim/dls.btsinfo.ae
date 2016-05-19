<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueChangerDeMdp.php : visualiser la demande de changement de mot de passe
	// Ecrit le 6/1/2016 par Nicolas Esteve
	// Modifié le 18/5/2016 par Jim
	
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
				<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			
			<div data-role="content">
			<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">La prochaine soirée des anciens</h4>
			
			<?php	
			if ($Soiree == null )
			{	echo "La prochaine soirée des anciens n'a pas encore été programmée à ce jour !";
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
					{	$message .= "<br>situé <b> " . $Soiree->getAdresse( ). "</b>.</p>";
					}
					else 
					{	$message .="<br>dont l'adresse est précisée dans le lien ci-joint. </p>";
					}
				}

				if ($Soiree->getTarif() != null)
				{	$message .= "<p>Le tarif est de <b>" . $Soiree->getTarif() . " euros</b> par personne. </p>";
				}
				
				if ($Soiree->getLienMenu() != null)
				{	$message .= '<p>Informations plus détaillées sur le restaurant ou sur les menus proposés : <br> <a target="_blank" href="' . $Soiree->getLienMenu() . '".>' . $Soiree->getLienMenu() .'</a></p>';
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