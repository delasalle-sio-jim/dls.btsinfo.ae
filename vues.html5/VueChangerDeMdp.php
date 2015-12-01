<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 1/12/2015 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
	<script>
		window.onload = initialisations;
		
		function initialisations()
		{
			document.getElementById("caseAfficherMdp").onchange = afficherMdp;
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
	</script>
	
</head> 
<body>
	<div id="conteneur">
		<ul id="menu">
			<li><a href="index.php?action=Menu" data-ajax="false">Retour menu</a></li>
		</ul>
			
		<div id="contenu">

			<img src="images/Logo_DLS.gif" class="logo" alt="Lycée De La Salle (Rennes)" />&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="images/Intitules_bts_ig_sio.png" class="logo" alt="BTS Informatique" />
			 		
			<h2>Changer mon mot de passe</h2>
			<form name="form1" id="form1" action="index.php?action=ChangerDeMdp" method="post">
				<table>
					<tr>
						<td><label for="txtNouveauMdp">Nouveau mot de passe :</label></td>
						<td><input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtNouveauMdp" id="txtNouveauMdp" size="40" maxlength="20" placeholder="Mon nouveau mot de passe" required value="<?php echo $nouveauMdp; ?>" ></td>
					</tr>
					<tr>
						<td><label for="txtConfirmationMdp">Confirmation du nouveau mot de passe :</label></td>
						<td><input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtConfirmationMdp" id="txtConfirmationMdp" size="40" maxlength="20" placeholder="Confirmation" required value="<?php echo $confirmationMdp; ?>" ></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" onclick="afficherMdp();" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
							<label for="caseAfficherMdp">Afficher le mot de passe en clair</label>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="btnChangerDeMdp" id="btnChangerDeMdp" value="Changer mon mot de passe"></td>
					</tr>
				</table>
			</form>
			
		</div>
		
		<p id="message"><?php echo str_replace('<br>', ' ', $message); ?></p>
		
		<p id="footer">Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
	</div>
</body>
</html>