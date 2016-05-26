<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueVoirListeInscrits.php : voir la liste des inscrits à la soirée des anciens élèves
	// Ecrit le 26/05/2016 par Killian BOUTIN
	
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
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Liste des inscrits à la prochaine soirée des anciens</h4>
				<table data-role="table" class="ui-responsive">
				
				<?php	
				if ($lesInscriptions == null )
				{	echo "Aucun élève n'est inscrit à ce jour.";
				}
				else
				{
					$lesInscriptions = $dao->getLesInscriptions();
					$message = "<p> La liste des inscrits à la prochaine soirée des anciens est la suivante : </p>";
					$numInscription = 0;
					$message .= "<thead>
									<tr>
										<td>Nom</td>
										<td>Prénom</td>
									</tr>
								</thead>
								<tbody>";
				
					foreach ($lesInscriptions as $uneInscription)
					{
						$message .= "<tr><tr>";
							// affichage du nom et du prénom de chaque "$uneInscription" dans la collection "$lesInscriptions"
							$message .= "<td>" . $uneInscription->getNom() . "</td>";
							$message .= "<td>" . $uneInscription->getPrenom() . "</td>";
						$message .= "</tr></tr>";
					}
					$message .= "</tbody>";
					$message .=	"</table>";
							
							$nbReponses = sizeof($lesInscriptions);
							$message .= "<br> Le nombre d'inscrits est de <b>" . $nbReponses . "</b>.";
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