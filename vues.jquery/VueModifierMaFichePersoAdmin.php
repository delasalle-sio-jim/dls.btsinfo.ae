<?php
// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueModifierMaFichePersoAdmin.php : 
	//    afficher la vue de modification d'un administrateur qui modifie sa propre fiche perso
	// Ecrit le 24/05/2016 par Killian BOUTIN
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
				<?php include_once 'ReseauxSociaux.php';?>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Mettre à jour mon profil</h4>
				<form name="form1" id="form1" action="index.php?action=ModifierMaFichePersoAdmin" method="post" data-ajax="false">
					<div data-role="fieldcontain" class="ui-hide-label">

						<label for="txtNom">Nom (de naissance) *</label>
						<input type="text" name="txtNom" id="txtNom" maxlength="30" placeholder="Nom (de naissance) *" 
							data-mini="true" required value="<?php echo $nom; ?>">

						<label for="txtPrenom">Prénom *</label>
						<input type="text" name="txtPrenom" id="txtPrenom" maxlength="30" placeholder="Prénom *" 
							data-mini="true" required value="<?php echo $prenom; ?>">
						
					</div>
					
					<div data-role="fieldcontain">
						<input type="submit" value="Envoyer les données" name="btnModifier" id="btnModifier" data-mini="true">
					</div>
				</form>
			</div>
				
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>