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
		
			<?php	
			if ($lesInscriptions == null )
			{	echo "Aucun élève n'est inscrit à ce jour.";
			}
			else
			{
				$lesInscriptions = $dao->getLesInscriptions();
				$message = "<p> La liste des inscrits à la prochaine soirée des anciens est la suivante : </p><br>";
				$numInscription = 0;
				
				foreach ($lesInscriptions as $uneInscription)
				{	$numInscription += 1; // incrémentation du numéro d'inscription
					// affichage d'un numéro incrémenté, du nom et du prénom de chaque "$uneInscription" dans la collection "$lesInscriptions"
					$message .= $numInscription . " " . $uneInscription->getNom() . " " . $uneInscription->getPrenom() . '<br>';
				}
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
