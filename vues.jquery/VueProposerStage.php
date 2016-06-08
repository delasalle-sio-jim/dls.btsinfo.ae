<?php
	// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.jquery/VueProposerStage.php : visualiser la vue de dépôt de stage
// Ecrit le 19/01/2016 par Nicolas Esteve
// Modifié le 20/5/2016 par Jim
	
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
				<h4><?php echo $titreHeader ?></h4>
				<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h2>Proposer un stage</h2>
				<p>Vous pouvez déposer une offre de stage sur le site web du lycée avec le lien ci-dessous :</p>
				<center><p><a Target=_Blank href="http://www.lycee-delasalle.com/fr/relations-entreprises/deposer-une-offre-d-emploi.php?type_offre=2">www.lycee-delasalle.com</a></p></center>
				<p>Les élèves et professeurs de BTS SIO vous remercient d'avance pour le temps que vous prenez pour aider la nouvelle génération.</p>
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
			</div>
			
		
	</body>
</html>