<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueDemanderCreationCompte.php : visualiser la vue de création de compte élève
	// Ecrit le 16/11/2015 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
</head> 
<body>
	<div id="conteneur">
		<ul id="menu">
			<li><a href="index.php?action=Connecter">Retour accueil</a></li>
		</ul>
			
		<div id="contenu">

			<img src="images/Logo_DLS.gif" class="logo" alt="Lycée De La Salle (Rennes)" />&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="images/Intitules_bts_ig_sio.png" class="logo" alt="BTS Informatique" />
			 		
			<h2>Création d'un compte élève (actuel ou ancien)</h2>
			
			<p>Après vérification de votre demande par les administrateurs de l'annuaire (cette opération peut prendre quelques jours éventuellement),
			 vous recevrez un mail de confirmation avec votre mot de passe (que vous pourrez ensuite modifier).</p>
			 
			<h3>Entrez les données nécessaires à la création de votre compte :</h3>
			
			<form name="form1" id="form1" action="index.php?action=DemanderCreationCompte" method="post">
				<table>
					<tr>
						<td><label for="txtNom">Nom (de naissance) *</label></td>
						<td><input type="text" name="txtNom" id="txtNom" size="30" maxlength="30" class="<?php echo $class_nom; ?>" value="<?php echo $nom; ?>" /></td>
					</tr>
					<tr>
						<td><label for="txtPrenom">Prénom *</label></td>
						<td><input type="text" name="txtPrenom" id="txtPrenom" size="30" maxlength="30" class="<?php echo $class_prenom; ?>" value="<?php echo $prenom; ?>" /></td>
					</tr>
					<tr> 
						<td><label for="radioSexe">Sexe *</label></td>
						<td>
							<span class="<?php echo $class_sexe; ?>">
			  					<input type="radio" name="radioSexe" id="radioSexeH" value="H" <?php if ($sexe == "H") echo 'checked="checked"';?> />Homme
              					<input type="radio" name="radioSexe" id="radioSexeF" value="F" <?php if ($sexe == "F") echo 'checked="checked"';?> />Femme
              				</span>
              			</td>
					</tr>
					<tr>
						<td><label for="txtAnneeDebutBTS">Année d'entrée en BTS *</label></td>
						<td><input type="text" name="txtAnneeDebutBTS" id="txtAnneeDebutBTS" size="4" maxlength="4" class="<?php echo $class_anneeDebutBTS; ?>" value="<?php echo $anneeDebutBTS; ?>" /></td>
					</tr>
					<tr>
						<td><label for="txtTel">Téléphone *</label></td>
						<td><input type="text" name="txtTel" id="txtTel" size="14" maxlength="14"  class="<?php echo $class_tel; ?>" value="<?php echo $tel; ?>" /></td>
					</tr>
					<tr>
						<td><label for="txtAdrMail">Adresse mail *</label></td>
						<td><input type="text" name="txtAdrMail" id="txtAdrMail" size="50" maxlength="50" class="<?php echo $class_adrMail; ?>" value="<?php echo $adrMail; ?>" /></td>
					</tr>
					<tr>
						<td><label for="txtEtudesPostBTS">Etudes post BTS</label></td>
						<td><textarea rows="2" name="txtEtudesPostBTS" id="txtEtudesPostBTS" cols="82" maxlength="150" class="<?php echo $class_etudesPostBTS; ?>" ><?php echo $etudesPostBTS; ?></textarea></td>
					</tr>		
					<tr>
						<td><label for="txtRue">Rue</label></td>
						<td><input type="text" name="txtRue" id="txtRue" size="80" maxlength="80" class="<?php echo $class_rue; ?>" value="<?php echo $rue; ?>" /></td>
					</tr>						
					<tr>
						<td><label for="txtCodePostal">Code postal</label></td>
						<td><input type="text" name="txtCodePostal" id="txtCodePostal" size="5" maxlength="5" class="<?php echo $class_codePostal; ?>" value="<?php echo $codePostal; ?>" /></td>
					</tr>
					<tr>
						<td><label for="txtVille">Ville</label></td>
						<td><input type="text" name="txtVille" id="txtVille" size="30" maxlength="30" class="<?php echo $class_ville; ?>" value="<?php echo $ville; ?>" /></td>
					</tr>					
					<tr>
						<td><label for="txtEntreprise">Entreprise actuelle</label></td>
						<td><input type="text" name="txtEntreprise" id="txtEntreprise" size="50" maxlength="50" class="<?php echo $class_entreprise; ?>" value="<?php echo $entreprise; ?>" /></td>
					</tr>						
					<tr>
						<td><label for="listeFonctions">Fonction actuelle</label></td>
						<td>
							<select size="1" name="listeFonctions" id="listeFonctions">
								<?php foreach ($lesFonctions as $uneFonction) { ?>
									<option value="<?php echo $uneFonction->getId(); ?>" <?php if ($idFonction == $uneFonction->getId()) echo 'selected="selected"'; ?>><?php echo $uneFonction->getLibelle(); ?></option>
								<?php } ?>				
							</select>
							&nbsp;&nbsp;
							<input type="submit" value="Envoyer les données" name="btnEnvoyer" id="btnEnvoyer" />
						</td>
					</tr>											
		            <tr>
		              <td>&nbsp;</td>
		              <td>&nbsp;</td>
		            </tr>
				</table>
			</form>
		</div>

		<p id="message"><?php echo $message; ?></p>
		
		<p id="legende"><b>Légende : </b>&nbsp;&nbsp;
		<input type="text" size="30" class="normal" value="Une * indique un champ obligatoire." />&nbsp;&nbsp;
		<input type="text" size="25" class="nonRempli" value="Champ obligatoire non rempli." />&nbsp;&nbsp;
		<input type="text" size="20" class="incorrect" value="Valeur incorrecte." />
		</p>
			
		<p id="footer">Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
	</div>
</body>
</html>