<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueModifUserAdmin.php : visualiser la vue de modification de compte élève par un administrateur
	// Ecrit le 18/1/2016 par Nicolas Esteve
	
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');
header('Content-Tranfer-Encoding: none');
header('Expires: 0');
?>
<!doctype html>
<html lang="en">
<head>	
<meta charset="utf-8">
	<?php include_once ('head.php');
	include_once ('modele/DAO.class.php');
	$dao = new DAO();
	//echo $listeMails;?>
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
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>DLS-Info-AE</h4>
				<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Supprimer un utilisateur</h4>
				<form name="form1" id="form1" data-ajax="false" action="index.php?action=ModifUserAdmin" method="post">
				
				<!--ceci est un prototype de liste déroulante dynamique non utilisée car trop d'objets à gerer
				<p>

					 <select size="1" onchange="submit()" name="listeEleve" id="listeEleve">
					<option value="<?php //if( isset($mail)) echo $mail ?>"><?php // if( isset($mail)) echo $mail ?></option>
					
						<?php //foreach ($lesEleves as $unEleve) { ?>
						<option value="<?php //echo $unEleve->getId()?>" <?php //if ($idEleve == $unEleve->getAdrMail()) echo 'selected="selected"'; ?>><?php //echo $unEleve->getAdrMail(); ?></option>					
						<?php //} ?>	
										
					</select>
				</p> -->
		
				<div class="ui-widget">
				
					 <label for="listeEleves">Mail de Eleve à modifier: </label>
 					 <input id="listeEleves" value="<?php if($etape == 1 ) echo $mail ; else echo ''; ?>" name="listeEleves" placeholder="recherchez à l'aide de l'email de l'utilisateur">
 					 	
				</div>
	
				<div data-role="fieldcontain" class="ui-hide-label">
					<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
				</div>	
				
			
				<?php if ($etape == 1)	
						{?> 
						<div data-role="fieldcontain" class="ui-hide-label">

								<label for="txtNom">Nom (de naissance) *</label>
								<input type="text" name="txtNom" id="txtNom" maxlength="30" placeholder="Nom (de naissance) *" data-mini="true" required value="<?php echo $nom; ?>">

								<label for="txtPrenom">Prénom *</label>
								<input type="text" name="txtPrenom" id="txtPrenom" maxlength="30" placeholder="Prénom *" data-mini="true" required value="<?php echo $prenom; ?>">
								
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
							<?php } ?>
						</form>
					</div>

				</div>