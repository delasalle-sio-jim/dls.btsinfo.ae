<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.jquery/VueModifierCompteEleve.php : visualiser la vue de modification de compte élève par un administrateur
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<style>
		  .ui-autocomplete {
		    max-height: 100px;
		    overflow-y: auto;
		    /* prevent horizontal scrollbar */
		    overflow-x: hidden;
		  }
		  /* IE 6 doesn't support max-height
		   * we use height instead, but this forces the menu to always be this tall
		   */
		  * html .ui-autocomplete {
		    height: 100px;
		  }
		  </style>
		<script>
		 $(function() {
			    var listeEleves  = [ 
			     <?php 
		     	$eleveMails='"';
				foreach($lesMails as $unMail){ 
					$eleveMails .= $unMail.'","';
				 } 
				 $eleveMails = substr($eleveMails ,0,-2);
				 echo $eleveMails;?>	         			    
				];
			    $( "#listeEleves" ).autocomplete({
			      source: listeEleves
			    });
			  });
		</script>		

</head> 
<body>
	<div data-role="page" id="page_principale">
		<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
			<h4><?php echo $titreHeader ?></h4>
			<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
		</div>
		<div data-role="content">
			<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Modifier un utilisateur</h4>
			<form name="form1" id="form1" action="index.php?action=ModifierCompteEleve" method="post" data-ajax="false">
		
				<div class="ui-widget">

					 <label for="listeEleves">Eleves: </label>
 					 <input type="email" id="listeEleves"  value="<?php if($etape == 1 ) echo $mail; else echo ''; ?>" name="listeEleves" required pattern="^.+@.+\..+$" placeholder="Recherchez à l'aide de l'email de l'utilisateur">

					<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">	
				</div>
					
					
				<?php if($etape == 1)
				{?>
				<div data-role="fieldcontain" class="ui-hide-label">
				
					<label for="txtNom">Nom (de naissance) * :</label>
					<input type="text" name="txtNom" id="txtNom" placeholder="Nom" maxlength="30" required value="<?php echo $nom; ?>" />
				
					<label for="txtPrenom">Prénom * :</label>
					<input type="text" name="txtPrenom" id="txtPrenom" placeholder="Prénom" maxlength="30" required value="<?php echo $prenom; ?>" />
				
					<label for="txtAnneeDebutBTS">Année d'entrée en BTS * :</label>
					<input type="text" name="txtAnneeDebutBTS" id="txtAnneeDebutBTS" placeholder=">Année d'entrée en BTS" maxlength="4" pattern="^[0-9]{4}$" required value="<?php echo $anneeDebutBTS; ?>" />
				
					<label for="txtAdrMail">Adresse mail * :</label>
					<input type="email" name="txtAdrMail" id="txtAdrMail" placeholder="Adresse mail" maxlength="50" required pattern="^.+@.+\..+$" value="<?php echo $mail; ?>" />
				
					<label for="txtTel">Téléphone :</label>
					<input type="text" name="txtTel" id="txtTel" placeholder="Téléphone" maxlength="14" pattern="^([0-9]{2}( |-|\.)?){4}[0-9]{2}$" value="<?php echo $tel; ?>" />
				
					<label for="txtRue">Rue :</label>
					<input type="text" name="txtRue" id="txtRue" placeholder="Rue" maxlength="80" value="<?php echo $rue; ?>" />
				
					<label for="txtCodePostal">Code postal :</label>
					<input type="text" name="txtCodePostal" id="txtCodePostal" placeholder="Code postal" maxlength="5" pattern="^[0-9]{5}$" value="<?php echo $codePostal; ?>" />
				
					<label for="txtVille">Ville :</label>
					<input type="text" name="txtVille" id="txtVille" placeholder="Ville" maxlength="30" value="<?php echo $ville; ?>" />
				
					<label for="txtEtudesPostBTS">Etudes post BTS :</label>
					<textarea rows="2" name="txtEtudesPostBTS" id="txtEtudesPostBTS" placeholder="Etudes post BTS" maxlength="150"><?php echo $etudesPostBTS; ?></textarea>
				
					<label for="txtEntreprise">Entreprise actuelle :</label>
					<input type="text" name="txtEntreprise" id="txtEntreprise" placeholder="Entreprise actuelle" maxlength="50" value="<?php echo $entreprise; ?>" />
				
					<label for="listeFonctions">Fonction actuelle :</label>
					
					<select size="1" name="listeFonctions" id="listeFonctions">
							<option value="0" <?php if ($idFonction == '') echo 'selected'; ?>>-- Indiquez votre fonction actuelle --</option>
						<?php foreach ($lesFonctions as $uneFonction) { ?>
							<option value="<?php echo $uneFonction->getId(); ?>" <?php if ($idFonction == $uneFonction->getId()) echo 'selected="selected"'; ?>><?php echo $uneFonction->getLibelle(); ?></option>
						<?php } ?>
					</select>
				
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