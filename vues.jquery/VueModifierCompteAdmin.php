<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.jquery/VueModifierCompteAdmin.php : visualiser la vue de modification de compte administrateur par un administrateur
// Ecrit le 18/1/2016 par Nicolas Esteve
// Modifié le 08/06/2016 par Killian BOUTIN

header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');
header('Content-Tranfer-Encoding: none');
header('Expires: 0');
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
	
	<script>
		<?php if ($typeMessage != '') { ?>
			// associe une fonction à l'événement pageinit
			$(document).bind('pageinit', function() {
				// affiche la boîte de dialogue 'affichage_message'
				$.mobile.changePage('#affichage_message', {transition: "<?php echo $transition; ?>"});
			} );
		<?php } ?>

	</script>

</head> 
<body>
	<div data-role="page" id="page_principale">
		<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
			<h4><?php echo $titreHeader ?></h4>
			<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
		</div>
		<div data-role="content">
			<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Modifier un administrateur</h4>
			<form name="form1" id="form1" action="index.php?action=ModifierCompteAdmin" method="post" data-ajax="false">
			
			<div class="ui-widget">
				<label for="listeAdmins">Administrateur: </label>
				<input id="listeAdmins" type="email"  value="<?php if($etape == 1 ) echo $uneAdrMail; else echo ''; ?>" name="listeAdmins" required pattern="^.+@.+\..+$" placeholder="Recherchez à l'aide de l'email de l'administrateur">

				<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
			</div>
				<?php if($etape == 1)
				{?>
				<div data-role="fieldcontain" class="ui-hide-label">
					<label for="txtNom">Nom (de naissance) * :</label>
					<input type="text" name="txtNom" id="txtNom" maxlength="30" required value="<?php echo $nom; ?>" />

					<label for="txtPrenom">Prénom * :</label>
					<input type="text" name="txtPrenom" id="txtPrenom" maxlength="30" required value="<?php echo $prenom; ?>" />

					<input type="submit" value="Envoyer les données" name="btnEnvoyer" id="btnEnvoyer" />
				</div>
				<?php }?>	
			</form>
		</div>
		<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
			<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
		</div>
	</div>
	
	<?php include_once ('vues.jquery/dialog_message.php'); ?>
	
</body>
</html>						