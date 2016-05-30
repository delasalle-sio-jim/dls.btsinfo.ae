<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueModifierReglementsRemboursements.php : visualiser la vue de remboursement
// Ecrit le 6/1/2016 par Nicolas Esteve
// Modifié le 20/05/2016 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php');?>
	
	<script>
		window.onload = initialisations;
		function initialisations() {
			<?php if ($typeMessage == 'avertissement') { ?>
				afficher_avertissement("<?php echo $message; ?>");
			<?php } ?>
			
			<?php if ($typeMessage == 'information') { ?>
				afficher_information("<?php echo $message; ?>");
			<?php } ?>
		}
		
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
	<script>
		window.onload = initialisations;
		
		function initialisations() {
			document.getElementById("caseAfficherMdp").onchange = afficherMdp;

			<?php if ($typeMessage == 'avertissement') { ?>
				afficher_avertissement("<?php echo $message; ?>");
			<?php } ?>
			
			<?php if ($typeMessage == 'information') { ?>
				afficher_information("<?php echo $message; ?>");
			<?php } ?>
		}
		
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
	<div id="page">
	
		<div id="header">
			<div id="header-menu">
				<ul id="menu-horizontal">
					<li><a href="index.php?action=Menu#menu2" data-ajax="false">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>Modifier les comptes d'un Eleve</h2>
			<form name="form1" id="form1" action="index.php?action=Remboursement" method="post">
				<table>
					<div class="ui-widget">
						<p>
							 <label for="listeEleves">Eleves: </label>
		 					 <input id="listeEleves"   name="listeEleves" placeholder="recherchez à l'aide de l'email de l'utilisateur">
						</p>
						
							
						<p>
							<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
						</p>	
					</div>

					<?php if($etape == 1)
					{ ?>
					<p>
						<label class=label2 for="txtMontantRegle">Nombre de places réservées : <?php echo $nbPlacesReserve?></label>
					</p>
					<p>
						<label class=label2 for="txtMontantRegle">Date d'inscription : <?php echo $dateinscription?></label>
					</p>
					<p>
						<label class=label2 for="txtMontantRegle">Montant regle à l'avance par l'élève : <?php echo $MontantRegle?></label>
					</p>
					<p>
						<label class=label2 for="txtMontantRegle">Montant Remboursé à l'élève : <?php echo $MontantRembourse?></label>
					</p>
										
					
					
					
					<p>
						<label for="txtMontantRegle">Modifier le montant regle à l'avance per l'élève :</label>
						<input type="text" name="txtMontantRegle" id="txtMontantRegle" maxlength="20" placeholder="Montant regle à l'avance per l'eleve"  value="<?php echo $MontantRegle?>" >
					</p>	
					<p>
						<label for="txtMontantRembourse">Modifier le montant Rembourse à l'élève :</label>
						<input type="text" name="txtMontantRembourse" id="txtMontantRembourse" maxlength="20" placeholder="Montant Rembourse à l'eleve"  value="<?php echo $MontantRembourse?>" >
					</p>		
					<p>
						<input type="submit" name="btnModifier" id="btnModifier" value="Changer les données">
					</p>
					<?php }?>
				</table>
			</form>
		</div>
		
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>
	
	<aside id="affichage_message" class="classe_message">
		<div>
			<h2 id="titre_message" class="classe_information">Message</h2>
			<p id="texte_message" class="classe_texte_message">Texte du message</p>
			<a href="" onclick='window.location.reload(false)' title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>