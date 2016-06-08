<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueModifierReglementsRemboursements.php : visualiser la vue de remboursement
// Ecrit le 6/1/2016 par Nicolas Esteve
// Modifié le 31/05/2016 par Killian BOUTIN
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
			<h2>Mise à jour des réglements et remboursements d'un élève</h2>
			<form name="form1" id="form1" action="index.php?action=ModifierReglementsRemboursements" method="post">
			
					<?php if($etape == 0){ ?>
					<div class="ui-widget">
					
						<p>
							 <label for="listeEleves">Eleves: </label>
		 					 <input type="email" id="listeEleves"   name="listeEleves" placeholder="Recherchez à l'aide de l'email de l'utilisateur" value = "<?php if (!empty ($_POST ["listeEleves"]) == true) echo $_POST ["listeEleves"]; else echo "";?>" pattern="^.+@.+\..+$" required>
						</p>
						<p>
							<input type="submit" name="btnDetail" id="btnDetail" value="Obtenir les détails">
						</p>	
					</div>

					<?php }else {?>
						<p>
							<label >Nbr de places réservées :</label>
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
							<label class=label2 >Coût total à payer par l'élève : <?php echo $montantTotal ?> €</label>
						</p>
						<p>
							<label id="boutonAnnulerInscription" >Annuler l'inscription de l'élève :</label>
								Non <input type="radio" onclick="$('#caseConfirmation').attr('checked', false); $('#annulerInscription').hide(2);" value="annulerNon" id="annulerNon" name="radioAnnuler" checked="checked" >
								Oui <input type="radio" onclick="$('#annulerInscription').slideDown(2);" value="annulerOui" id="annulerOui" name="radioAnnuler"/>
								  
							<div id="annulerInscription" style="display: none">
								Cochez cette case pour confirmer l'annulation de l'inscription : <input type=checkbox id="caseConfirmation" name="caseConfirmation">
							</div>		
						</p>
						<div class="ui-widget">
							<p>
								<input type="submit" name="btnModifier" id="btnModifier" value="Changer les données">
							</p>
						</div>
					<?php }?>
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
			<a href="<?php echo $lienRetour; ?>" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>