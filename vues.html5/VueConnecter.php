<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 30/11/2015 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
	<script>
		window.onload = initialisations;
		
		function initialisations()
		{
			document.form1.caseAfficherMdp.onchange = afficherMdp;
		}
		
		function afficherMdp()
		{	if (document.form1.caseAfficherMdp.checked == true)
				document.form1.txtMotDePasse.type="text";
			else
				document.form1.txtMotDePasse.type="password";
		}
	</script>
	
</head> 
<body>
	<div id="conteneur">
		<ul id="menu">
			<li><a href="index.php?action=DemanderCreationCompte">Création compte</a></li>
			<li><a href="index.php?action=DemanderMdp">Mot de passe oublié</a></li>
		</ul>
			
		<div id="contenu">

			<img src="images/Logo_DLS.gif" class="logo" alt="Lycée De La Salle (Rennes)" />&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="images/Intitules_bts_ig_sio.png" class="logo" alt="BTS Informatique" />
			<h2>Bienvenue sur l'annuaire des anciens élèves du lycée De La Salle</h2>
			<p>L'annuaire des anciens élèves du <b>BTS Informatique</b> du <b>Lycée De La Salles</b> (Rennes) vous propose les services suivants :</p>
			<ul>
				<li>Formulaire d'inscription à la soirée des anciens</li>
				<li>Consultation de la liste des anciens déjà inscrits à la soirée des anciens</li>
				<li>Outil de recherche d'anciens élèves inscrits à l'annuaire</li>
				<li>Consultation de galeries photos</li>
			</ul>
			
			<h2>Créer mon compte</h2>
			<p>Si vous n'avez pas encore de compte, commencez par le <a href="index.php?action=DemanderCreationCompte">créer</a>. 
			Après vérification de votre demande par les administrateurs de l'annuaire (cette opération peut prendre quelques jours éventuellement),
			 vous recevrez un mail de confirmation avec votre mot de passe (que vous pourrez ensuite modifier).</p>
			 		
			<h2>Accéder à mon compte</h2>
			<form name="form1" id="form1" action="index.php?action=Connecter" method="post">
				<table>
					<tr>
						<td><label for="txtAdrMail">Adresse mail :</label></td>
						<td><input type="email" name="txtAdrMail" id="txtAdrMail" size="50" maxlength="50" placeholder="Mon adresse mail" required value="<?php echo $adrMail; ?>" ></td>
					</tr>
					<tr>
						<td><label for="txtMotDePasse">Mot de passe :</label></td>
						<td><input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtMotDePasse" id="txtMotDePasse" 
							size="20" maxlength="20" placeholder="Mon mot de passe" required value="<?php echo $motDePasse; ?>" ></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
							<label for="caseAfficherMdp">Afficher le mot de passe en clair</label>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="btnConnecter" id="btnConnecter" value="Me connecter"></td>
					</tr>
				</table>
			</form>
			
			<h2>J'ai oublié mon mot de passe</h2>
			<p>Cette option permet de regénérer un nouveau mot de passe qui vous sera immédiatement envoyé par mail. Nous vous conseillons de le changer aussitôt.</p>
			<form name="form2" id="form2" action="index.php?action=DemanderMdp" method="post">
				<table>
					<tr>
						<td><label for="txtAdrMail2">Adresse mail :</label></td>
						<td><input type="email" name="txtAdrMail2" id="txtAdrMail2" size="50" maxlength="50" placeholder="Mon adresse mail" required value="<?php echo $adrMail; ?>" ></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="btnConnecter2" id="btnConnecter2" value="Obtenir un nouveau mot de passe"></td>
					</tr>
				</table>
			</form>
		</div>
		
		<p id="message"><?php echo $message; ?></p>
		
		<p id="footer">Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
	</div>
</body>
</html>