<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VuedepotStage.php : visualiser la demande de changement de mot de passe
	// Ecrit le 1/19/2015 par Nicolas Esteve
	
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
				<h2>Depot de Stage</h2>
				<label>Si vous souhaitez déposer une offre de stage suivez le lien ci-dessous :</label>
				<a href="http://www.lycee-delasalle.com/fr/relations-entreprises/deposer-une-offre-d-emploi.php?type_offre=2">www.lycee-delasalle.com</a>
				<label class="labelImportant">Les élèves et professeurs de BTS SIO vous remercient d'avance pour le temps que vous prenez pour aider la nouvelle génération.</label>
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
			</div>
			
		
	</body>
	
</html>