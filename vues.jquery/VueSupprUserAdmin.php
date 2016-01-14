<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueDemanderCreationCompte.php : visualiser la vue de création de compte élève
	// Ecrit le 12/1/2016 par Nicolas Esteve
?>
<!doctype html>
<html lang="en">
<head>	
<meta charset="utf-8">
	<?php include_once ('head.php');
	include_once ('modele/DAO.class.php');
	$dao = new DAO();?>
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
			    <?php echo $liste ?>			         			    
				];
			    $( "#listeEleves" ).autocomplete({
			      source: listeEleves
			    });
			  });
		</script>		
</head> 
<body>
	<div id="page">
	
		<div id="header">
			<div id=header-menu>
				<ul id="menu-horizontal">
					<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
				</ul>
			</div>
		</div>
			
		<div id="content">
		<h2>Supprimer un Utilisateur</h2>
	<form name="form1" id="form1" action="index.php?action=SupprUserAdmin" method="post">
				
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
				<p>
					 <label for="listeEleves">Eleves: </label>
 					 <input id="listeEleves" value="<?php if($etape == 1 ) echo $mail ; else echo ''; ?>" name="listeEleves" placeholder="recherchez à l'aide de l'email de l'utilisateur">
				</p>
				
					</p>
				<p>
					<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
				</p>	
				</div>
			
				<?php if ($etape == 1)	
						{?> 
					
					<div data-role="fieldcontain">
						<label for="txtAdrMailAdmin">Prénom de l'utilisateur  :<?php echo $prenom ?></label>
					</div>
					
					<div data-role="fieldcontain">
						<label for="txtAdrMailAdmin">Nom de l'utilisateur :<?php echo $nom ?></label>
					</div>
					
					<div data-role="fieldcontain">
						<label>Adresse mail de l'utilisateur :<?php echo $mail ?></label>
					</div>
					
					<div data-role="fieldcontain">
						<label for="txtAdrMailAdmin">Entrez le mail de l'administrateur pour confimer la suppression de celui-ci :</label>
						<input type="text" name="txtAdrMailAdmin2" id="txtAdrMailAdmin" placeholder="Adresse mail de l'administrateur a supprimer" required>
					</div>
					
					<div data-role="fieldcontain" class="ui-hide-label">
					<input type="submit" name="btnSupprimerAdmin"  id="btnSupprimerAdmin" value="Supprimer Administrateur">
					</div>
					<?php } ?>
				</form>
						
				
				</div>
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>
	<?php include_once ('vues.jquery/dialog_message.php'); ?>
</body>
</html>						