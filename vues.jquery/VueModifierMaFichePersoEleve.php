<?php
// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueModifierMaFichePersoEleve.php : afficher la vue de modification d'un utilisateur qui modifie sa propre fiche perso
	// Ecrit le 11/01/2016 par Nicolas esteve
	// Modifié le 22/5/2016 par Jim
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
				<form name="form1" id="form1" action="index.php?action=ModifierMaFichePersoEleve" method="post" data-ajax="false">
					<div data-role="fieldcontain" class="ui-hide-label">

						<label for="txtNom">Nom (de naissance) *</label>
						<input type="text" name="txtNom" id="txtNom" maxlength="30" placeholder="Nom (de naissance) *" data-mini="true" required value="<?php echo $nom; ?>">

						<label for="txtPrenom">Prénom *</label>
						<input type="text" name="txtPrenom" id="txtPrenom" maxlength="30" placeholder="Prénom *" data-mini="true" required value="<?php echo $prenom; ?>">
						
						<fieldset data-role="controlgroup" data-type="horizontal" required>
							<legend data-mini="true">Sexe :</legend>
							<input type="radio" name="radioSexe" id="radioSexeH" value="H" data-mini="true" <?php if ($sexe == "H") echo 'checked';?> >
							<label for="radioSexeH">Homme</label>
							<input type="radio" name="radioSexe" id="radioSexeF" value="F" data-mini="true" <?php if ($sexe == "F") echo 'checked';?> >
							<label for="radioSexeF">Femme</label>
						</fieldset>
																
						<label for="txtAnneeDebutBTS">Année d'entrée en BTS *</label>
						<input type="text" name="txtAnneeDebutBTS" id="txtAnneeDebutBTS" maxlength="4" pattern="[0-9]{4,4}" placeholder="Année d'entrée en BTS (4 chiffres) *" data-mini="true" required value="<?php echo $anneeDebutBTS; ?>">

						<label for="txtAdrMail">Adresse mail *</label>
						<input type="email" name="txtAdrMail" id="txtAdrMail" maxlength="50" placeholder="Adresse mail *" pattern="^.+@.+\..+$" data-mini="true" required value="<?php echo $adrMail; ?>">
						
						<label for="txtTel">Téléphone</label>
						<input type="tel" name="txtTel" id="txtTel" maxlength="14" pattern="^([0-9]{2}( |-|\.)?){4}[0-9]{2}$" placeholder="Téléphone" data-mini="true" value="<?php echo $tel; ?>">
						
						<label for="txtRue">Rue</label>
						<input type="text" name="txtRue" id="txtRue" maxlength="80" placeholder="Rue" data-mini="true" value="<?php echo $rue; ?>" />
						
						<label for="txtCodePostal">Code postal</label>
						<input type="text" name="txtCodePostal" id="txtCodePostal" maxlength="5" pattern="[0-9]{5,5}" placeholder="Code postal" data-mini="true" value="<?php echo $codePostal; ?>" />

						<label for="txtVille">Ville</label>
						<input type="text" name="txtVille" id="txtVille" maxlength="30" placeholder="Ville" data-mini="true" value="<?php echo $ville; ?>" />
						
						<label for="txtEtudesPostBTS" data-mini="true">Etudes post-BTS</label>
						<textarea rows="2" cols="100" name="txtEtudesPostBTS" id="txtEtudesPostBTS" maxlength="150" placeholder="Etudes suivies après le BTS" data-mini="true"><?php echo $etudesPostBTS; ?></textarea>

						<label for="txtEntreprise">Entreprise actuelle</label>
						<input type="text" name="txtEntreprise" id="txtEntreprise" maxlength="50" placeholder="Entreprise actuelle" data-mini="true" value="<?php echo $entreprise; ?>" />
						
						<label for="listeFonctions">Situation actuelle</label>
						<select size="1" name="listeFonctions" id="listeFonctions" data-mini="true">
								<option value="0" <?php if ($idFonction == '') echo 'selected'; ?>>-- Indiquez votre fonction actuelle --</option>
							<?php foreach ($lesFonctions as $uneFonction) { ?>
								<option value="<?php echo $uneFonction->getId(); ?>" <?php if ($idFonction == $uneFonction->getId()) echo 'selected'; ?>><?php echo $uneFonction->getLibelle(); ?></option>
							<?php } ?>				
						</select>
					</div>
					
					<div data-role="fieldcontain">
						<input type="submit" value="Envoyer les données" name="btnModifier" id="btnModifier" data-mini="true">
					</div>
				</form>
			</div>
				
			<?php if($debug == true) {
				// en mise au point, on peut afficher certaines variables dans la page
				echo "<p>typeMessage = " . $typeMessage . "</p>";
				echo "<p>message = " . $message . "</p>";
			} ?>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>