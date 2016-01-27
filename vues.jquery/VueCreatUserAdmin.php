<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueCreatuserAdmin.php : visualiser la vue de création de compte élève par un Admin
	// Ecrit le 3/1/2016 par Jim
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Pragma: no-cache');
	header('Content-Tranfer-Encoding: none');
	header('Expires: 0');
?>
<!doctype html>
<html>
	<head>	
		<?php include_once ('vues.jquery/head.php'); ?>
		
		<script>
			<?php if ($typeMessage != '') { ?>
				// associe une fonction à l'événement pageinit
				$(document).bind('pageinit', function() {
					// affiche la boîte de dialogue 'affichage_message'
					$.mobile.changePage('#affichage_message', {transition: "<?php echo $transition; ?>"});
				} );
			<?php } ?>
			
			// associe une fonction à l'événement click sur la case à cocher 'caseAfficherMdp'
			$('#caseAfficherMdp').live('click', function() {
				if ($('#caseAfficherMdp').attr('checked') == true) {
					('#txtNouveauMdp').attr('type', 'text');
					('#txtNouveauMdp').input('refresh');
					('#txtConfirmationMdp').attr('type', 'text');
					('#txtConfirmationMdp').input('refresh');
					window.alert('true');
				}
				else {
					('#txtNouveauMdp').attr('type', 'password');
					('#txtNouveauMdp').input('refresh');
					('#txtConfirmationMdp').attr('type', 'password');
					('#txtConfirmationMdp').input('refresh');
					window.alert('false');
				};
			} );
						
			function afficherMdp()
			{	if (document.getElementById("caseAfficherMdp").checked == true)
				{	document.getElementById("txtNouveauMdp").type="text";
					document.getElementById("txtConfirmationMdp").type="text";
					// window.alert('true');
				}
				else
				{	document.getElementById("txtNouveauMdp").type="password";
					document.getElementById("txtConfirmationMdp").type="password";
					// window.alert('false');
				}
			};
		</script>
	</head> 
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
				<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Créer un utilisateur</h4>
				<form action="index.php?action=CreatUserAdmin" method="post" data-ajax="false" >
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
								<input type="email" name="txtAdrMail" id="txtAdrMail" maxlength="50" placeholder="Adresse mail *" data-mini="true" required value="<?php echo $adrMail; ?>">

								<label for="txtTel">Téléphone</label>
								<input type="tel" name="txtTel" id="txtTel" maxlength="14" placeholder="Téléphone" data-mini="true" value="<?php echo $tel; ?>">
								
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
									<option value="0" <?php if ($idFonction == '') echo 'selected'; ?>>Fonction actuelle</option>
									<?php foreach ($lesFonctions as $uneFonction) { ?>
										<option value="<?php echo $uneFonction->getId(); ?>" <?php if ($idFonction == $uneFonction->getId()) echo 'selected'; ?>><?php echo $uneFonction->getLibelle(); ?></option>
									<?php } ?>				
								</select>

							</div>
							
							<div data-role="fieldcontain">
								<input type="submit" value="Envoyer les données" name="btnEnvoyer" id="btnEnvoyer" data-mini="true">
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
				