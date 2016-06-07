<?php
// Projet DLS - BTS Info - Anciens élèves
// Inclut la division permettant d'afficher un message avec une boîte de dialogue

// Ecrit le 3/1/2016 par Jim
// Modifié le 22/5/2016 par Jim
?>

		<div data-role="dialog" id="affichage_message" data-close-btn="none">
			<div data-role="header" data-theme="<?php echo $themeFooter; ?>">
				<?php if ($typeMessage == 'avertissement') { ?>
					<h3>Avertissement...</h3>
				<?php } ?>
				<?php if ($typeMessage == 'information') { ?>
					<h3>Information...</h3>
				<?php } ?>
			</div>
			<div data-role="content">
				<p style="text-align: center;">
				<?php if ($typeMessage == 'avertissement') { ?>
					<img src="images/avertissement.png" class="image" />
				<?php } ?>
				
				<?php if ($typeMessage == 'information') { ?>
					<img src="images/information.png" class="image" />
				<?php } ?>
				</p>
				<p style="text-align: center;"><?php echo $message; ?></p>
			</div>
			<div data-role="footer" class="ui-bar" data-theme="<?php echo $themeFooter; ?>">
				<a href="<?php echo $lienRetour; ?>" data-ajax="false" data-transition="<?php echo $transition; ?>">Fermer</a>
			</div>
		</div>