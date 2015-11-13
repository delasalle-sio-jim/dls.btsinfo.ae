<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Exemple de formulaire</title>

		<!-- le lien vers la feuille de styles du site -->
		<link type="text/css" rel="stylesheet" href="styles.css" />

		<!-- quelques styles internes au formulaire -->
		<style type="text/css">
			.styleColonne1 {width: 12%;}
			.styleColonne2 {width: 38%;}
			.styleColonne3 {width: 12%;}
			.styleColonne4 {width: 38%;}
			.styleColonnes234 {width: 88%;}
			.styleColonnes1234 {width: 100%;}
		</style>
		
		<script language="javascript" type="text/javascript">
			// $instructionJS contient une instruction JavaScript pour placer le focus sur la première zone à corriger
			window.onload = function () { <?php echo $instructionJS; ?> };
		</script>
	</head>

	<body>
        <form name="form1" method="post" action="controleSaisie.php?action=Traitement">
          <h3 style="text-align:center">Entrez les données demandées</h3>
          <table border="0" cellpadding="0" cellspacing="1" width="100%">
            <tr>
              <td class="styleColonne1">Nom *</td>
              <td class="styleColonne2">
				<input type="text" name="txtNom" size="30" maxlength="30" class="<?php echo $class_nom; ?>" value="<?php echo $nom; ?>" /></td>
              <td class="styleColonne3">Prénom *</td>
              <td class="styleColonne4">
				<input type="text" name="txtPrenom" size="30" maxlength="30" class="<?php echo $class_prenom; ?>" value="<?php echo $prenom; ?>" /></td>
            </tr>
            <tr>
              <td class="styleColonne1">Sexe *</td>
              <td class="styleColonne2">
              	<span class="<?php echo $class_sexe; ?>">
			  		<input type="radio" name="radioSexe" value="H" <?php if ($sexe == "H") echo 'checked="checked"';?> />Homme
              		<input type="radio" name="radioSexe" value="F" <?php if ($sexe == "F") echo 'checked="checked"';?> />Femme
              	</span>
              </td>
              <td class="styleColonne3">Situation *</td>
              <td class="styleColonne4">
			  	<select size="1" name="listeSituations" class="<?php echo $class_situation; ?>">
					<option value=""  <?php if ($situation == "") echo 'selected="selected"'; ?>>Situation familiale...</option>
					<option value="C" <?php if ($situation == "C") echo 'selected="selected"'; ?>>Célibataire</option>
					<option value="M" <?php if ($situation == "M") echo 'selected="selected"'; ?>>Marié</option>
					<option value="D" <?php if ($situation == "D") echo 'selected="selected"'; ?>>Divorcé</option>
					<option value="V" <?php if ($situation == "V") echo 'selected="selected"'; ?>>Veuf</option>
				</select>
              </td>
            </tr>
            <tr>
              <td class="styleColonne1">Date naissance *</td>
              <td class="styleColonne2">
				<input type="text" name="txtDateNaissance" size="10" maxlength="10" class="<?php echo $class_dateNaissance; ?>" 
					value="<?php echo $dateNaissance; ?>" /> (format <strong>jj-mm-aaaa</strong> ou <strong>jj/mm/aaaa</strong>)</td>
              <td class="styleColonne3">Permis</td>
              <td class="styleColonne4">
				<input type="checkbox" name="caseMoto" value="O" <?php if($caseMoto=="O") echo 'checked="checked"'; ?> />Moto
				<input type="checkbox" name="caseVoiture" value="O" <?php if($caseVoiture=="O") echo 'checked="checked"'; ?> />Voiture
				<input type="checkbox" name="casePL" value="O" <?php if($casePL=="O") echo 'checked="checked"'; ?> />Poids-lourd
		 	</td>
            </tr>
            <tr>
              <td class="styleColonne1">Rue *</td>
              <td class="styleColonnes234" colspan="3">
				<input type="text" name="txtRue" size="80" maxlength="80" class="<?php echo $class_rue; ?>" value="<?php echo $rue; ?>" />
              </td>
            </tr>
            <tr>
              <td class="styleColonne1">Code postal *</td>
              <td class="styleColonne2">
				<input type="text" name="txtCodePostal" size="5" maxlength="5" class="<?php echo $class_codePostal; ?>" value="<?php echo $codePostal; ?>" /></td>
              <td class="styleColonne3">Ville *</td>
              <td class="styleColonne4">
				<input type="text" name="txtVille" size="25" maxlength="25" class="<?php echo $class_ville; ?>" value="<?php echo $ville; ?>" />
              </td>
            </tr>
            <tr>
              <td class="styleColonne1">Tél 1 *</td>
              <td class="styleColonne2">
				<input type="text" name="txtTel1" size="14" maxlength="14" class="<?php echo $class_tel1; ?>" value="<?php echo $tel1; ?>" /></td>
              <td class="styleColonne3">Tél 2</td>
              <td class="styleColonne4">
				<input type="text" name="txtTel2" size="14" maxlength="14" class="<?php echo $class_tel2; ?>" value="<?php echo $tel2; ?>" />
              </td>
            </tr>
            <tr>
              <td class="styleColonne1">Fax</td>
              <td class="styleColonne2">
				<input type="text" name="txtFax" size="14" maxlength="14"  class="<?php echo $class_fax; ?>" value="<?php echo $fax; ?>" /></td>
              <td class="styleColonne3">Email</td>
              <td class="styleColonne4">
				<input type="text" name="txtEmail" size="30" maxlength="30" class="<?php echo $class_email; ?>" value="<?php echo $email; ?>" /></td>
            </tr>
            <tr>
              <td class="styleColonne1">Expérience<br />professionnelle</td>
              <td class="styleColonnes234" colspan="3">
				<textarea rows="3" name="txtExperience" cols="60"><?php echo $experience; ?></textarea></td>
            </tr>
            <tr>
              <td class="styleColonnes1234" colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td class="styleColonne1"></td>
              <td class="styleColonne2">(une * indique un champ obligatoire)</td>
              <td class="styleColonne3"></td>
              <td class="styleColonne4">
				<input type="submit" value="Envoyer" name="btnEnvoyer" />
                <input type="reset" value="Effacer" name="btnEffacer" /></td>
            </tr>
          </table>
        </form>
	<p id="msgErreur"><?php if ($premierAppel == false) echo "Les zones en orange doivent être saisies, les zones en rouge sont incorrectes !"; ?></p>
	</body>
</html>
