<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueChangerDeMdp.php : visualiser la demande de changement de mot de passe
	// Ecrit le 1/12/2015 par Jim
	
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
			<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Détails  de la soirée</h4>
			<?php	
			if ($Soiree->getDateSoiree() !== "00-00-0000"  || $Soiree->getNomRestaurant() !== null  || $Soiree->getAdresse() !== null  || $Soiree->getLienMenu() !== null  || $Soiree->getTarif() !== null )
			{
				$message =	"Bonjour,<br/>Comme chaque année, l'association INPACT organise un repas auquel les étudiants, anciens étudiants et professeurs du BTS SIO (ex BTS IG) du Lycée De La Salle sont conviés.<br/>";
					
				
				if($Soiree->getDateSoiree() !== "00-00-0000")
						{
							$message .="Ce repas aura lieu le vendredi  ".Outils::convertirEnDateFR($Soiree->getDateSoiree()) ."  à 20h ";
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
			
			
			
						</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>