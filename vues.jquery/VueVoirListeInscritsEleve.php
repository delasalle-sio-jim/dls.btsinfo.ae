<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueVoirListeInscritsEleve.php : voir la liste des inscrits à la soirée des anciens élèves par un eleve
	// Ecrit le 26/05/2016 par Killian BOUTIN
	// Modifié le 27/05/2016 par Killian BOUTIN
	
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
		<style> 
			table tr:nth-child(1) {
				font-weight: bold;
			}
			
		</style> 
	</head> 
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
				<a href="index.php?action=Menu#menu2" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			
			<div data-role="content">

					<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;"><?php echo $titre; ?></h4>
			
					<ul data-role="listview" data-mini="true" style="margin-top: 5px;">
						<?php
						foreach ($lesInscriptions as $uneInscription)
						{ ?>
							<li><a href="#">
								<h5><?php echo $uneInscription->getNom() . " " . $uneInscription->getPrenom() . " (" .$uneInscription->getAnneeDebutBTS() . ")"; ?></h5>
							</a></li>
						<?php
						} ?>
					</ul>
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>