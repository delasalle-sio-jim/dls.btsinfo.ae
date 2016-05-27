<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueVoirListeInscritsAdmin.php : voir la liste des inscrits à la soirée des anciens élèves par un admin
	// Ecrit le 27/05/2016 par Killian BOUTIN
	
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
			
					<div data-role="collapsible-set">
						<?php
						foreach ($lesInscriptions as $uneInscription)
						{
							/* obtention du coût total à payer puis du montant final */
							$coutTotal = $uneInscription->getTarif() * $uneInscription->getNbrePersonnes();
							$montantTotalFinal += $coutTotal;
							
							/*obtention du montant à régler puis du montant total à regler */
							$montantRegle = $uneInscription->getMontantRegle();
							$montantTotalRegle += $montantRegle;
							
							/* on formate les nombres au format français */
							$montantRegle = number_format($uneInscription->getMontantRegle(), 2, ',', ' ');
							$coutTotal = number_format($coutTotal, 2, ',', ' ');
						?>
						
						<div data-role="collapsible" >
						<h3 data-mini="true"><?php echo $uneInscription->getNom() . " " . $uneInscription->getPrenom() . " (" .$uneInscription->getAnneeDebutBTS() . ")"; ?></h3>
							<ul data-role="listview" data-mini="true">
							<li>
								<h5>Nombre d'inscriptions : <?php echo $uneInscription->getNbrePersonnes() ?></h5>
							</li>
							<li>
								<h5>Montant réglé : <?php echo $montantRegle; ?> €</h5>
							</li>
							<li>
								<h5>Montant total à régler : <?php echo $coutTotal; ?> €</h5>
							</li>
							</ul>
						</div>

						<?php
						
						/* ajout du nombre d'inscrits de cet enregistrement au nombre total d'inscrits */
						$nombreInscritsTotal += $uneInscription->getNbrePersonnes();
	
					} 
					
						/* on formate les nombres au format français */
						$montantTotalRegle = number_format($montantTotalRegle, 2, ',', ' ');
						$montantTotalFinal = number_format($montantTotalFinal, 2, ',', ' ');
						
						?>
						<ul data-role="listview" data-mini="true" style="margin-top: 5px;">
							<li>
								<h5>Nombre total d'inscriptions : <?php echo $nombreInscritsTotal ?></h5>
							</li>
							<li>
								<h5>Montant réglé : <?php echo $montantTotalRegle; ?> €</h5>
							</li>
							<li>
								<h5>Montant total : <?php echo $montantTotalFinal; ?> €</h5>
							</li>
						</ul>
						
					</div>
			</div>
		</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>