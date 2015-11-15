<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 15/11/2015 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
</head> 
<body>
	<div id=conteneur>
		<ul id=menu>
			<li><a href="index.php?action=DemanderCreationCompte">Création compte</a></li>
			<li><a href="index.php?action=DemanderMdp">Mot de passe oublié</a></li>
		</ul>
			
		<div id=contenu>

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
			<p>Si vous n'avez pas encore de compte, commencez par le <a href="index.php?action=DemanderCreationCompte">créer</a>. 
			Après vérification de votre demande par les administrateurs de l'annuaire (cette opération peut prendre quelques jours éventuellement),
			 vous recevrez un mail de confirmation avec votre mot de passe (que vous pourrez ensuite modifier).</p>
			<p>&nbsp;</p>
			 		
			<h2>Connexion</h2>
			<form name="form1" id="form1" action="index.php?action=Connecter" method="post">
				<table>
					<tr>
						<td><label for="txtAdrMail">Adresse mail :</label></td>
						<td><input type="text" name="txtAdrMail" id="txtAdrMail" size="50" maxlength="50" placeholder="Mon adresse mail" value="<?php echo $adrMail; ?>" ></td>
					</tr>
					<tr>
						<td><label for="txtMotDePasse">Mot de passe :</label></td>
						<td><input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtMotDePasse" id="txtMotDePasse" 
							size="20" maxlength="20" placeholder="Mon mot de passe" value="<?php echo $motDePasse; ?>" ></td>
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
		</div>
		
		<p id=message><?php echo $msgFooter; ?></p>
		<p id=footer>Annuaire des anciens élèves du BTS Informatique - Lycée De La Salle (Rennes)</p>
	</div>
</body>
</html>