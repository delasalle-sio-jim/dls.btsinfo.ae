<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vue.jquery/VueSupprimerCompteAdmin.php : supprimer un administrateur
// Ecrit le 06/01/2016 par Nicolas Esteve
// Modifié le 26/05/2016
	
// pour obliger la page à se recharger
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
		    var listeAdmins  = [ 
		     <?php 
	     	$adminMails='"';
			foreach($lesMailsAdmin as $unMail){ 
				$adminMails .= $unMail.'","';
			 } 
			 $adminMails = substr($adminMails ,0,-2);
			 echo $adminMails;?>	         			    
			];
		    $( "#listeAdmins" ).autocomplete({
		      source: listeAdmins
		    });
		  });
	</script>	
		
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
				<a href="index.php?action=Menu" data-ajax="false" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Supprimer un administrateur</h4>
				<form action="index.php?action=SupprimerCompteAdmin" method="post" data-ajax="false" >
				
					<div class="ui-widget">
						<label for="listeAdmins">Administrateur: </label>
						<input id="listeAdmins" type="email"  value="<?php if($etape == 1 ) echo $txtMailAdmin; else echo ''; ?>" name="listeAdmins" required pattern="^.+@.+\..+$" placeholder="Recherchez à l'aide de l'email de l'administrateur">
		
						<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
					</div>
					
					<?php if ($etape == 1)	
						{?> 
					<div>
						<label for="txtAdrMailAdmin"><b>Prénom de l'administrateur  : </b><?php echo $prenomAdmin ?></label>

						<label for="txtAdrMailAdmin"><b>Nom de l'administrateur : </b><?php echo $nomAdmin ?></label>

						<label for="txtAdrMailAdmin">Entrez le mail de l'administrateur pour confirmer la suppression de celui-ci :</label>
						<input type="text" name="txtAdrMailAdmin2" id="txtAdrMailAdmin" placeholder="Adresse mail de l'administrateur a supprimer" required>
					</div>
					
					<div data-role="fieldcontain" class="ui-hide-label">
					<input type="submit" name="btnSupprimerAdmin"  id="btnSupprimerAdmin" value="Supprimer Administrateur">
					</div>
				</form>
						
				<?php } ?>
				<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
					<h4>Annuaire des anciens du BTS Informatique<br>Lycée De La Salle (Rennes)</h4>
				</div>
			</div>
		</div>
		<?php include_once ('vues.jquery/dialog_message.php'); ?>
		</body>
</html>