<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueVoirListeInscrits.php : voir la liste des inscrits à la soirée des anciens élèves
// Ecrit le 25/05/2016 par Killian BOUTIN
// Modifié le 26/05/2016 par Killian BOUTIN

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
			<h2>Liste des inscrits à la prochaine soirée des anciens</h2>
			
			<!-- création d'un tableau de 1 pixel permettant de contourer le tableau pour qu'il soit plus visible -->
			<table class="tableau">
			
			<?php	
			/* s'il n'y a pas d'inscription */
			// if ($lesInscriptions == null )
			if (sizeof($lesInscriptions) == 0 )
			{	echo "Aucun élève n'est inscrit à ce jour.";
			}
			/* sinon */
			else
			{
				/* récupération de la collection $lesInscriptions */
				// $lesInscriptions = $dao->getLesInscriptions();	// déjà fait dans le contrôleur
				$message = "<p> La liste des inscrits à la prochaine soirée des anciens est la suivante : </p>";
				$numInscription = 0;
				/* création de la première ligne dans le tableau */
				$message .= "<thead>
								<tr>
									<th>Numéro</th>
									<th>Entrée BTS</th>
									<th>Nom</th>
									<th>Prénom</th>
								</tr>
							</thead>";
			
				/* pour chaque $uneInscription de la collection $lesInscriptions */
				foreach ($lesInscriptions as $uneInscription)
				{	$numInscription += 1; // incrémentation du numéro d'inscription
					
					/* récupération de $unEleve en fonction de son idEleve */
					$unEleve = $dao->getEleve($uneInscription->getIdEleve());
				
					/* on crée une ligne du tableau */
					$message .= "<tr>";
						// affichage d'un numéro incrémenté, du nom et du prénom de chaque "$uneInscription" dans la collection "$lesInscriptions"
						$message .= "<td>" . $numInscription . "</td>";
						$message .= "<td>" . $uneInscription->getNom() . "</td>";
						$message .= "<td>" . $uneInscription->getPrenom() . "</td>";
						$message .= "<td>" . $uneInscription->getAnneeDebutBTS() . "</td>";
					$message .= "</tr>";
				}
				
				/* récupération du nombre d'inscriptions */
				$nbReponses = sizeof($lesInscriptions);
				$message .= "<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>Total</td>
								<td>$nbReponses</td>
							</tr>";
				$message .= "</table>";

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
