<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue VueChangerDeMdp.php : visualiser la demande de changement de mot de passe
	// Ecrit le 1/12/2015 par Jim
	
	// pour obliger la page à se recharger
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
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Inscription à la soiree</h4>
				<form action="index.php?action=InscriptionSoiree" method="post" data-ajax="false" >

				<div data-role="fieldcontain">
						<label for="txtNbPlaces">Nombre de places  :</label>
					<input type="number"  name="txtNbPlaces" id="txtNbPlaces" pattern="^[0-9]{2}$" maxlength="30" value="1" required/>
				</div>
					<div data-role="fieldcontain">
						<label class ="label2" for="txtNouveauMdp">En cochant cette case vous vous vous engagez a payer <?php echo $tarif ?> euros par places réservées. </label>
				</div>
				<div data-role="fieldcontain">
						<input type="checkbox" requiered name="validation" id="validation" maxlength="30"  required/>	
				</div> 
				<div data-role="fieldcontain">
						<label class ="label2" for="txtNbPlaces"> Vous pouvez payer en avance en envoyant un chèque au nom d'INPACT(en précisant votre nom) ou payer au moment où vous arrivez à la soirée.	</label>		
				</div>
				
				<?php if(! empty ($tarif))
				{?>
				<p>
					<label class="label2" for="txtTarif">Le prix pour une place est de <?php echo $tarif ?> euros</label>
					
				</p>
				<?php }
				else 
				{?>
				<p>
					<label class="label2" for="txtTarif">Le prix pour la soirée n'a pas été fixé</label>
					
				</p>
				<?php }?>
				<p>
						<input type="submit" name="btnInscription"  id="btnInscription" value="S'inscrire" >
				</p>
			</form>
				
		</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
			</div>
		</div>
		
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		
	</body>
</html>