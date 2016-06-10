<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueSupprimerCompteEleve.php : visualiser la vue de suppression d'un compte élève
// Ecrit le 18/1/2016 par Nicolas Esteve
// Modifié le 26/05/2016 par Killian BOUTIN
	
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
<!-- 
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
																				     <?php /*
																			     	$eleveMails='"';
																					foreach($lesMails as $unMail){ 
																						$eleveMails .= $unMail.'","';
																					 } 
																					 $eleveMails = substr($eleveMails ,0,-2);
																					 echo $eleveMails; */?>	         			    
																					];
																				    $( "#listeEleves" ).autocomplete({
																				      source: listeEleves
																				    });
																				  });
																			</script>		
		 -->
		 
		 <script>
		function afficher_information(msg) {
			document.getElementById("titre_message").innerHTML = "Information...";
			document.getElementById("titre_message").className = "classe_information";
			document.getElementById("texte_message").innerHTML = msg;
			window.open ("#affichage_message", "_self");
		}
		function afficher_avertissement(msg) {
			document.getElementById("titre_message").innerHTML = "Avertissement...";
			document.getElementById("titre_message").className = "classe_avertissement";
			document.getElementById("texte_message").innerHTML = msg;
			window.open ("#affichage_message", "_self");
		}
	</script>
		
</head> 
<body>
	<body>
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4><?php echo $titreHeader ?></h4>
				<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Supprimer un utilisateur</h4>
				<form name="form1" id="form1" data-ajax="false" action="index.php?action=SupprimerCompteEleve" method="post">
		
				<?php if($etape == 0){ ?>
									
				<div class="ui-widget">
				
					 <label for="listeEleves">Mail de l'utilisateur à supprimer: </label>
 					 <input id="listeEleves" value="<?php if($etape == 1 ) echo $mail ; else echo ''; ?>" name="listeEleves" placeholder="recherchez à l'aide de l'email de l'utilisateur">
 						
				</div>
	
				<div data-role="fieldcontain" class="ui-hide-label">
					<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
				</div>	
				
			
				<?php }else
						{?> 
					
					
						<label for="txtAdrMailAdmin"><b>Prénom   : </b><?php echo $prenom ?></label>
			
		
						<label for="txtAdrMailAdmin"><b>Nom  : </b><?php echo $nom ?></label>
					
					
					
						<label><b>Adresse mail de l'utilisateur : </b><?php echo $mail ?></label>
			
						<label for="annee"><b>Année d'entrée en BTS : </b><?php echo $annee?></label>
					
					<div data-role="fieldcontain" class="ui-hide-label">
					<input type="submit" name="btnSupprimer"  id="btnSupprimer" value="Supprimer l'utilisateur">
					</div>
					<?php } ?>
				</form>
						
				</div>
					<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
						<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
					</div>
			</div>
		
			<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>
					