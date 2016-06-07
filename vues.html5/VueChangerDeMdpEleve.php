<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueChangerDeMdpEleve.php : visualiser la vue de changement de mot de passe par l'élève
	// Ecrit le 6/1/2016 par Jim
	// Modifié le 22/5/2016 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
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
		
		function afficherMdp()
		{	if (document.getElementById("caseAfficherMdp").checked == true)
			{	document.getElementById("txtNouveauMdp").type="text";
				document.getElementById("txtConfirmationMdp").type="text";
			}
			else
			{	document.getElementById("txtNouveauMdp").type="password";
				document.getElementById("txtConfirmationMdp").type="password";
			}
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
					<li><a href="index.php?action=Menu#menu1" data-ajax="false">Retour menu</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">
			<h2>Modifier mon mot de passe</h2>
			<form name="form1" id="form1" action="index.php?action=ChangerDeMdpEleve" method="post">
				<p>
					<label for="txtNouveauMdp">Nouveau mot de passe :</label>
					<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtNouveauMdp" id="txtNouveauMdp" maxlength="20" placeholder="Mon nouveau mot de passe" required value="<?php echo $nouveauMdp; ?>" >
				</p>
				<p>
					<label for="txtConfirmationMdp">Confirmation :</label>
					<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtConfirmationMdp" id="txtConfirmationMdp" maxlength="20" placeholder="Confirmation" required value="<?php echo $confirmationMdp; ?>" >
				</p>
				<p>
					<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" onclick="afficherMdp();" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
					<label for="caseAfficherMdp">Afficher en clair</label>
				</p>
				<p>
					<input type="submit" name="btnChangerDeMdp" id="btnChangerDeMdp" value="Envoyer les données">
				</p>
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