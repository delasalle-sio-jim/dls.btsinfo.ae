<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueVoirDetailsSoiree.php : visualiser les infos sur la soirée
	// Ecrit le 06/01/2016 par Nicolas Esteve
	// Modifié le 07/06/2016 par Killian BOUTIN
	
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
		<!-- Ajout de data-url pour google maps -->
		<div data-role="page" id="page_principale" data-url="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4><?php echo $titreHeader ?></h4>
				<a href="index.php?action=Menu#menu2" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
				<?php include_once 'ReseauxSociaux.php';?>
			</div>
			
			<div data-role="content">
			<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">La galerie photos des anciens</h4>
			<h5 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Cliquez sur la photo pour la voir en plus claire</h5>
			
			<?php 
				/* Pour chaque image de la collection */
				foreach ($lesImages as $uneImage){
					echo '<div style="text-align: center;">';
					/* On regarde si l'année est différente de celle de la photo d'avant */
					if($annee != $uneImage->getPromo()) {
						echo "<div style=\"width: 2000px; overflow:hidden;\"></div>";
					}
					
					/* On change l'année */
					$annee = $uneImage->getPromo();
					
					if ($uneImage->getClasse() == 1)
						$classe = "1ère année";
					elseif ($uneImage->getClasse() == 2 )
						$classe = "2ème année";
					elseif ($uneImage->getClasse() == 3 )
						$classe = "Post-BTS";
					else $classe = "Année X"; ?>
					
					<a href="photos.initiales/<?php echo $uneImage->getLien() ?>" target="_blank"><img src="photos.300/<?php echo $uneImage->getLien() ?>" /></a>
					</div>
					<br>
					<span style="color: white; text-shadow: 0px 0px; position: absolute; margin-top: -43px; margin-left: 80px;"><?php echo "Année " . $uneImage->getPromo() . " " . $classe ?> </span>
					
				<?php } ?>
				</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		
	</body>
</html>