<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>DLS - BTS Informatique - Anciens élèves</title>
		<meta charset="utf-8">
		
		<!-- le lien vers la feuille de styles du site -->
		<link type="text/css" rel="stylesheet" href="vues.xhtml/styles.css" />

		<!-- quelques styles internes au formulaire -->
		<style type="text/css">
			.styleColonne1 {width: 13%;}
			.styleColonne2 {width: 37%;}
			.styleColonne3 {width: 13%;}
			.styleColonne4 {width: 37%;}
			.styleColonnes234 {width: 87%;}
			.styleColonnes1234 {width: 100%;}
		</style>
		
		<script language="javascript" type="text/javascript">
			// $instructionJS contient une instruction JavaScript pour placer le focus sur la première zone à corriger
			window.onload = function () { <?php echo $instructionJS; ?> };
		</script>
	</head>

	<body>
        <form name="form1" method="post" action="index.php?action=DemanderCreationCompte">
          <h3 style="text-align:center">Création d'un compte élève (actuel ou ancien)</h3>
          <table border="0" cellpadding="0" cellspacing="1" width="100%">
            <tr>
              <td class="styleColonne1">Nom (de naissance) *</td>
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
              <td class="styleColonne3">Année d'entrée en BTS *</td>
              <td class="styleColonne4">
				<input type="text" name="txtAnneeDebutBTS" size="4" maxlength="4" class="<?php echo $class_anneeDebutBTS; ?>" value="<?php echo $anneeDebutBTS; ?>" /></td>
            </tr>
            <tr>
              <td class="styleColonne1">Téléphone *</td>
              <td class="styleColonne2">
				<input type="text" name="txtTel" size="14" maxlength="14"  class="<?php echo $class_tel; ?>" value="<?php echo $tel; ?>" /></td>
              <td class="styleColonne3">Adresse mail *</td>
              <td class="styleColonne4">
				<input type="text" name="txtAdrMail" size="50" maxlength="50" class="<?php echo $class_adrMail; ?>" value="<?php echo $adrMail; ?>" /></td>
            </tr>
            <tr>
              <td class="styleColonne1">Rue</td>
              <td class="styleColonnes234" colspan="3">
				<input type="text" name="txtRue" size="80" maxlength="80" class="<?php echo $class_rue; ?>" value="<?php echo $rue; ?>" />
              </td>
            </tr>
            <tr>
              <td class="styleColonne1">Code postal</td>
              <td class="styleColonne2">
				<input type="text" name="txtCodePostal" size="5" maxlength="5" class="<?php echo $class_codePostal; ?>" value="<?php echo $codePostal; ?>" /></td>
              <td class="styleColonne3">Ville</td>
              <td class="styleColonne4">
				<input type="text" name="txtVille" size="30" maxlength="30" class="<?php echo $class_ville; ?>" value="<?php echo $ville; ?>" />
              </td>
            </tr>
            <tr>
              <td class="styleColonne1">Entreprise actuelle</td>
              <td class="styleColonne2">
				<input type="text" name="txtEntreprise" size="50" maxlength="50" class="<?php echo $class_entreprise; ?>" value="<?php echo $entreprise; ?>" /></td>
              <td class="styleColonne3">Fonction actuelle</td>
              <td class="styleColonne4">
				<select size="1" name="listeFonctions">
					<?php foreach ($lesFonctions as $uneFonction) { ?>
						<option value="<?php echo $uneFonction->getId(); ?>" <?php if ($idFonction == $uneFonction->getId()) echo 'selected="selected"'; ?>><?php echo $uneFonction->getLibelle(); ?></option>
					<?php } ?>				
				</select>
              </td>
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
