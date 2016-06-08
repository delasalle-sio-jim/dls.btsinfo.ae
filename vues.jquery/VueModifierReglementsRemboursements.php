<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.jquery/VueModifierReglementsRemboursements.php : visualiser la vue de remboursement
// Ecrit le 31/05/2016 par Killian BOUTIN

/* MESSAGE D'ERREUR QUI NE S'AFFICHE PAS, LOGO DE RELOAD EN BOUCLE */
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
		<div data-role="page" id="page_principale">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4><?php echo $titreHeader ?></h4>
				<a href="index.php?action=Menu#menu2" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center;">Mise à jour des réglements et remboursements d'un élève</h4>
				<form action="index.php?action=ModifierReglementsRemboursements" method="post" data-ajax="false">
					<div data-role="fieldcontain" >

						<div class="ui-widget">
						<p>
							 <label for="listeEleves">Eleves: </label>
		 					 <input type="email" id="listeEleves"   name="listeEleves" placeholder="Recherchez à l'aide de l'email de l'utilisateur" value = "<?php if (!empty ($_POST ["listeEleves"]) == true) echo $_POST ["listeEleves"]; else echo "";?>" pattern="^.+@.+\..+$" required>
						</p>
						<p>
							<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
						</p>	
					</div>

					<?php if ($etape == 1){?>
						<p>
							<label >Nombre de places réservées :</label>
							<input type="text" value="<?php echo $unNbrePersonnes ?>" disabled>
						</p>
						<p>
							<label >Date d'inscription :</label>
							<input type="text" value="<?php echo $dateInscription ?>" disabled >
						</p>
						<p>
							<label  for="txtMontantRegle">Montant réglé par l'élève :</label>
							<input type="text" name="txtMontantRegle" id="txtMontantRegle" maxlength="20" placeholder="Montant regle à l'avance par l'élève"  value="<?php echo $montantRegle?>" >
						</p>
						<p>
							<label for="txtMontantRembourse">Montant remboursé à l'élève :</label>
							<input type="text" name="txtMontantRembourse" id="txtMontantRembourse" maxlength="20" placeholder="Montant rembourse à l'élève"  value="<?php echo $montantRembourse?>" >
						</p>
						<p>
							<label>Coût total à payer par l'élève :</label>
							<input type="text" value="<?php echo $montantTotal ?> €" disabled>
						</p>
						<p>
							<label>Voulez-vous annuler l'inscription ?</label>
							<fieldset data-role="controlgroup" data-type="vertical" required>
								<input type="radio" onclick="$('#annulerInscription').slideDown(2);" name="radioAnnuler" id="radioAnnulerOui" value="oui" data-mini="true">
								<label for="radioAnnulerOui">Oui</label>
								<input type="radio" onclick="$('#caseConfirmation').attr('checked', false); $('#annulerInscription').hide(2);" name="radioAnnuler" id="radioAnnulerNon" value="non" data-mini="true" checked>
								<label for="radioAnnulerNon">Non</label>
							</fieldset>
						</p>
							<div id="annulerInscription" style="display: none">
								<p>
									<label>Veuillez confirmer l'annulation de l'inscription :</label>
									<input style="margin: 3px 0px 0px -7px;" type=checkbox id="caseConfirmation" name="caseConfirmation">
								</p>
							</div>
					</div>
					
					<div data-role="fieldcontain">
						<input type="submit" value="Envoyer les données" name="btnModifier" id="btnModifier" data-mini="true">
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