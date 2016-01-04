<?php
	// Projet DLS - BTS Info - Anciens élèves
	// Fonction de la vue vues.html5/VueConnecter.php : visualiser la vue de connexion
	// Ecrit le 30/12/2015 par Jim
?>
<!doctype html>
<html>
<head>	
	<?php include_once ('head.php'); ?>
	<script>
		window.onload = initialisations;
		
		function initialisations() {
			document.form1.caseAfficherMdp.onchange = afficherMdp;
			
			<?php if ($typeMessage == 'avertissement') { ?>
				afficher_avertissement("<?php echo $message; ?>");
			<?php } ?>
			
			<?php if ($typeMessage == 'information') { ?>
				afficher_information("<?php echo $message; ?>");
			<?php } ?>
		}
		function afficherMdp()
		{	if (document.form1.caseAfficherMdp.checked == true)
				document.form1.txtMotDePasse.type="text";
			else
				document.form1.txtMotDePasse.type="password";
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
					<li><a href="index.php?action=DemanderCreationCompte">Création compte</a></li>
				</ul>
			</div>
			<div id="header-logos">
				<img src="images/Logo_DLS.gif" id="logo-gauche" alt="Lycée De La Salle (Rennes)" />
				<img src="images/Intitules_bts_ig_sio.png" id="logo-droite" alt="BTS Informatique" />
			</div>
		</div>
			
		<div id="content">

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
				<p>
					<label for="txtAdrMail">Adresse mail :</label>
					<input type="email" name="txtAdrMail" id="txtAdrMail" maxlength="50" placeholder="Mon adresse mail" required value="<?php echo $adrMail; ?>" >
				</p>
				<p>
					<label for="txtMotDePasse">Mot de passe :</label>
					<input type="<?php if ($afficherMdp == 'off') echo 'password'; else echo 'text'; ?>" name="txtMotDePasse" id="txtMotDePasse" 
						maxlength="20" placeholder="Mon mot de passe" required value="<?php echo $motDePasse; ?>" >
				</p>
				<p>
					<input type="checkbox" name="caseAfficherMdp" id="caseAfficherMdp" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
					<label for="caseAfficherMdp">Afficher en clair</label>
				</p>
				<p>
					<input type="submit" name="btnConnecter" id="btnConnecter" value="Me connecter">
				</p>
			</form>
			
			<h2>J'ai oublié mon mot de passe</h2>
			<p>Cette option permet de regénérer un nouveau mot de passe qui vous sera immédiatement envoyé par mail. Nous vous conseillons de le changer aussitôt.</p>
			<form name="form2" id="form2" action="index.php?action=DemanderMdp" method="post">
				<p>
					<label for="txtAdrMail2">Adresse mail :</label>
					<input type="email" name="txtAdrMail2" id="txtAdrMail2" maxlength="50" placeholder="Mon adresse mail" required value="<?php echo $adrMail; ?>" >
				</p>
				<p>
					
					<input type="submit" name="btnConnecter2" id="btnConnecter2" value="Obtenir un nouveau mot de passe">
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
			<a href="#close" title="Fermer">Fermer</a>
		</div>
	</aside>
	
</body>
</html>