<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.jquery/VueDemanderCreationCompte.php : visualiser la vue de création de compte élève
	// Ecrit le 27/11/2015 par Jim
?>
<!doctype html>
<html>
	<head>	
		<?php include_once ('head.php'); ?>
	</head> 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
				<a href="index.php?action=Deconnecter">Accueil</a>
			</div>
			
			<div data-role="content">
				<div data-role="collapsible-set">
					<div data-role="collapsible">
						<h3>Avertissement...</h3>
						<p>Après vérification de votre demande par les administrateurs de l'annuaire (cette opération peut prendre quelques jours éventuellement),
						 vous recevrez un mail de confirmation avec votre mot de passe (que vous pourrez ensuite modifier).</p>
					</div>
					
					<div data-role="collapsible" data-collapsed="false">
						<h3>Créer mon compte</h3>
							<p>* indique un champ obligatoire</p>
							<form name="form1" id="form1" action="index.php?action=DemanderCreationCompte" method="post">
								<div data-role="fieldcontain" class="ui-hide-label">

									<label for="txtNom">Nom (de naissance) *</label>
									<input type="text" name="txtNom" id="txtNom" placeholder="Nom (de naissance) *" data-mini="true" value="<?php echo $nom; ?>">

									<label for="txtPrenom">Prénom *</label>
									<input type="text" name="txtPrenom" id="txtPrenom" placeholder="Prénom *" data-mini="true" value="<?php echo $prenom; ?>">

									<fieldset data-role="controlgroup" data-type="horizontal">
										<legend data-mini="true">Sexe :</legend>
										<input type="radio" name="radioSexe" id="radioSexeH" value="H" data-mini="true" <?php if ($sexe == "H") echo 'checked';?> >
										<label for="radioSexeH">Homme</label>
										<input type="radio" name="radioSexe" id="radioSexeF" value="F" data-mini="true" <?php if ($sexe == "F") echo 'checked';?> >
										<label for="radioSexeF">Femme</label>
									</fieldset>
									
									<label for="txtAnneeDebutBTS">Année d'entrée en BTS *</label>
									<input type="text" name="txtAnneeDebutBTS" id="txtAnneeDebutBTS" pattern="[0-9]{4,4}" placeholder="Année d'entrée en BTS (4 chiffres) *" data-mini="true" value="<?php echo $anneeDebutBTS; ?>">

									<label for="txtTel">Téléphone *</label>
									<input type="tel" name="txtTel" id="txtTel" placeholder="Téléphone *" data-mini="true" value="<?php echo $tel; ?>">

									<label for="txtAdrMail">Adresse mail *</label>
									<input type="email" name="txtAdrMail" id="txtAdrMail" placeholder="Adresse mail *" data-mini="true" value="<?php echo $adrMail; ?>">

									<label for="txtRue">Rue</label>
									<input type="text" name="txtRue" id="txtRue" placeholder="Rue" data-mini="true" value="<?php echo $rue; ?>" />
									
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

				</div>
			</div>
			
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeFooter; ?>">
				<h4><?php echo $message; ?></h4>
			</div>
		</div>
	</body>
</html>