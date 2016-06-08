	<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueSupprimerCompteAdmin.php : supprimer un administrateur
// Ecrit le 06/01/2016 par Nicolas Esteve
// Modifié le 03/06/2016 par Killian BOUTIN
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
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
		// on ajoute onClick="confirmation();" au niveau du boutton ou  onsubmit="return confirmation();" au niveau de la balise form
		// ce script est censé mettre un fenêtre pop-up de confirmation avant la suppression d'un Administrateur
		// script non fonctionel
		function confirmation()
		{
		return confirm("Êtes vous sur de vouloir supprimer cet administrateur?")
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
					<li><a href="index.php?action=Menu#menu5" data-ajax="false">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
		<div id="content">	
		<h2>Supprimer un administrateur</h2>
			<form name="form1" id="form1" action="index.php?action=SupprimerCompteAdmin" method="post" >
			
				<?php if ($etape == 0)
				{?>
					<p>
						<label for="listeAdmins">Adresse mail de l'administrateur à supprimer :</label>
						<input type="text" name="listeAdmins" id="listeAdmins" maxlength="50" pattern="^.+@.+\..+$" placeholder="Adresse mail de l'administrateur à supprimer" class="normal" value="<?php if($etape == 1 ) echo $txtMailAdmin ; else echo ''; ?>" required>
					</p>
					<p>
					
			 			<input type="submit" name="btnDetailAdmin"  id="btnDetailAdmin" value="Obtenir détail">
					</p>
				<?php } else
				{?>
					<p>
						<label class="label2" for="prenomAdmin"><b>Prénom de l'administrateur: </b><?php echo $prenomAdmin ?></label>
					</p>
					<p>
						<label class="label2" for="nomAdmin"><b>Nom de l'administrateur : </b><?php echo $nomAdmin ?></label>
					</p>
					<p>
						<label class="label2" for="MailAdmin"><b>Mail de l'administrateur : </b><?php echo $txtMailAdmin ?></label>
					</p>
					<p>
						<label class="label2" for="txtAdrMailAdmin">Entrez le mail de l'administrateur pour confimer la suppression de celui-ci :</label>
						<input type="text" name="txtAdrMailAdmin2" id="txtAdrMailAdmin" maxlength="50" class ="normal" pattern="^.+@.+\..+$" required>
					</p>
					<p>
						<input type="submit" name="btnSupprimerAdmin"  id="btnSupprimerAdmin" value="Supprimer l'administrateur" >
					</p>
					<?php echo $_SESSION['adrMailAdmin'];?>
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