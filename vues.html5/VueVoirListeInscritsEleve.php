<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueVoirListeInscritsEleve.php : voir la liste des inscrits à la soirée des anciens élèves par un eleve
// Ecrit le 25/05/2016 par Killian BOUTIN
// Modifié le 27/05/2016 par Killian BOUTIN

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
					<?php include_once 'ReseauxSociaux.php';?>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>Liste des inscrits à la prochaine soirée des anciens</h2>
			<h3 class="titre_inscription"><?php echo $titre ?></h3>
				<?php
				/* si le nombre d'inscrit n'est pas égal à 0 */
				if ($nombreInscrits != 0 ){
					/* création de la première ligne dans le tableau */
					?>
					
					<table class="tableau inscription inscriptionEleve">
						<thead>
							<tr>
								<th>Numéro</th>
								<th>Promotion</th>
								<th>Nom</th>
								<th>Prénom</th>
							</tr>
						</thead>
						
					<?php
					/* initialisation du numéro d'inscription */
					$numInscription = 0; 
					
					/* pour chaque $uneInscription de la collection $lesInscriptions */
					foreach ($lesInscriptions as $uneInscription)
					{	/* incrémentation du numéro d'inscription */
						$numInscription += 1; 
	
						/* on crée une ligne du tableau */
						?>
						<tr>
							<!-- affichage d'un numéro incrémenté, du nom et du prénom de chaque "$uneInscription" dans la collection "$lesInscriptions" -->
							<td><?php echo $numInscription ?></td>
							<td><?php echo $uneInscription->getAnneeDebutBTS() ?></td>
							<td><?php echo $uneInscription->getNom() ?></td>
							<td><?php echo $uneInscription->getPrenom() ?></td>
						</tr>
					<?php
					} ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>Total</td>
							<td><?php echo $nombreInscrits ?></td>
						</tr>
					</table>
				<?php 
				}
				?>
		</div>
		
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>
	
</body>
</html>
