	<?php
// Projet DLS - BTS Info - Anciens élèves
// Fonction de la vue vues.html5/VueSupprimerCompteAdmin.php : supprimer un administrateur
// Ecrit le 06/01/2016 par Nicolas Esteve
// Modifié le 20/05/2016 par Jim
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
			<?php } 
			if(! isset($txtAdrMailAdmin))
					{
						$txtAdrMailAdmin ='';
					}?>
			
			<?php if ($typeMessage == 'information') { ?>
				afficher_information("<?php echo $message; ?>");
			<?php } ?>
		}
// on ajoute onClick="confirmation();" au niveau du boutton ou  onsubmit="return confirmation();" au niveau de la balise form
// ce script est censé mettre un fenêtre pop-up de confirmation avant la suppression d'un Administrateur
// script non fonctionel
function confirmation()
{
return confirm("Êtes vous sur de vouloir supprimer cet Administrateur?")
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
					<li><a href="index.php?action=Menu" data-ajax="false">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
		<div id="content">	
		<h2>Supprimer un Administrateur</h2>
			<form name="form1" id="form1" action="index.php?action=SupprimerAdmin" method="post" >
					<p>
						<label for="txtAdrMailAdmin">Adresse Mail de l'administrateur à supprimer :</label>
						<input type="text" name="txtAdrMailAdmin" id="txtAdrMailAdmin" maxlength="50" pattern="^.+@.+\..+$" placeholder="Adresse Mail de l'administrateur à supprimer" class="normal" value="<?php if($etape == 1 ) echo $txtMailAdmin ; else echo ''; ?>" required>
					</p>
					<p>
					
			 			<input type="submit" name="btnDetailAdmin"  id="btnDetailAdmin" value="Obtenir détail">
					</p>
					<!--  </form>-->
					<?php if ($etape == 1)
					{?>
					<!--  <form name="form2" id="form1" action="index.php?action=SupprimerAdmin" method="post" > -->
					<p>
						<label class="label2" for="prenomAdmin">Prénom de l'administrateur:<?php echo $prenomAdmin ?></label>
					</p>
					<p>
						<label class="label2" for="nomAdmin">Nom de l'adminisrateur :<?php echo $nomAdmin ?></label>
					</p>
					<p>
						<label class="label2" for="MailAdmin">Mail de l'administrateur :<?php echo $txtMailAdmin ?></label>
					</p>
					<p>
						<label class="label2" for="comfirmation">Entrez le mail de l'administrateur pour confimer la suppression de celui-ci :</label>
						<input type="text" name="txtAdrMailAdmin2" id="txtAdrMailAdmin2" maxlength="50" class ="normal" pattern="^.+@.+\..+$" required>
					</p>
					<p>
						<input type="submit" name="btnSupprimerAdmin"  id="btnSupprimerAdmin" value="Supprimer l'Administrateur" >
					</p>
					
					</form>	
					<?php }?>
			
		</div>
		<div id="footer">
			<p>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
		</div>		
	</div>
	
	<aside id="affichage_message" class="classe_message">
		<div>
			<h2 id="titre_message" class="classe_information">Message</h2>
			<p id="texte_message" class="classe_texte_message">Texte du message</p>
			<a href="#close" title="Fermer">Fermer</a>
		</div>
	</aside>
</body>
</html>